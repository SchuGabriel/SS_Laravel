<?php

namespace App\Http\Controllers;

use App\Models\Grupo;
use App\Models\Modelo;
use App\Models\Motor;
use App\Models\Posicao;
use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use function PHPUnit\Framework\isNull;

class PesquisarController extends Controller
{
    public function index()
    {

        $modelos = Modelo::all();
        $grupos = Grupo::all();
        $motores = Motor::all();
        $posicoes = Posicao::all();

        return view('pesquisar', [
            'grupos' => $grupos,
            'motores' => $motores,
            'posicoes' => $posicoes,
            'modelos' => $modelos,
        ]);
    }

    public function search(Request $request)
    {
        $join_produto = false;
        $sql = null;

        $sql = DB::table('aplicacao')
            ->select('aplicacao.produto_id');

        if (!is_null($request->input('referencia'))) {
            $join_produto = true;
            $sql->join('produto', 'produto.id', '=', 'aplicacao.produto_id', 'inner')
                ->where(
                    'produto.referencia',
                    'like',
                    $request->input('referencia')
                );
        }

        if (!is_null($request->input('grupo_id'))) {

            if (!$join_produto) {
                $sql->join('produto', 'produto.id', '=', 'aplicacao.produto_id', 'inner');
            }

            $sql->join('grupo_produto', 'grupo_produto.produto_id', '=', 'produto.id', 'inner')
                ->where(
                    'grupo_produto.grupo_id',
                    '=',
                    $request->input('grupo_id')
                );
        }

        if (!is_null($request->input('modelo_id'))) {
            $sql->join('aplicacao_modelo', 'aplicacao_modelo.aplicacao_id', '=', 'aplicacao.id', 'inner')
                ->where(
                    'aplicacao_modelo.modelo_id',
                    '=',
                    $request->input('modelo_id')
                );
        }

        if (!is_null($request->input('motor_id'))) {
            $sql->join('aplicacao_motor', 'aplicacao_motor.aplicacao_id', '=', 'aplicacao.id', 'inner')
                ->where(
                    'aplicacao_motor.motor_id',
                    '=',
                    $request->input('motor_id')
                );
        }

        if (!is_null($request->input('ano'))) {
            $sql->whereRaw(
                '? between nvl(aplicacao.ano_inicial, 0) and nvl(aplicacao.ano_final, 9999)',
                $request->input('ano')
            );
        }

        if (!is_null($request->input('posicao_id'))) {
            $sql->where(
                'aplicacao.posicao_id',
                '=',
                $request->input('posicao.id')
            );
        }

        $sql->groupBy('aplicacao.produto_id');

        $produtos_id = $sql->pluck('aplicacao.produto_id'); #Nao retorna como json
        
        $produtos = Produto::whereIn('id', $produtos_id)->get();
        
        
        foreach($produtos as $produto){
            
            $aplicacoes = DB::table('aplicacao')
                             ->select('aplicacao.*')
                             ->where('produto_id', '=', $produto->id)
                             ->get();

            $produtos->aplicacoes = $aplicacoes;

            foreach($produto->aplicacoes as $aplicacao){
                $modelos = DB::table('aplicacao_modelo')
                                ->select('modelo.nome')
                                ->join('modelo', 'modelo.id', '=', 'aplicacao_modelo.modelo_id', 'inner')
                                ->where('aplicacao.id', '=', $produtos->aplicacoes->id)
                                ->get();

                # TERMINAR AQUI
            }
        }

        dd($produtos);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Grupo;
use App\Models\Modelo;
use App\Models\Motor;
use App\Models\Posicao;
use App\Models\Produto;
use DeepCopy\Filter\ReplaceFilter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

use function PHPUnit\Framework\isNull;

class PesquisarController extends Controller
{
    public function index()
    {

        $modelos = Modelo::all();
        $grupos = Grupo::all();
        $motores = Motor::all();
        $posicoes = Posicao::all();
        $produtos = [];

        return view('pesquisar', [
            'grupos' => $grupos,
            'motores' => $motores,
            'posicoes' => $posicoes,
            'modelos' => $modelos,
            'produtos' => $produtos,
        ]);
    }

    public function search(Request $request)
    {
        $modelos = Modelo::all();
        $grupos = Grupo::all();
        $motores = Motor::all();
        $posicoes = Posicao::all();

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

        #dd($sql->toSql());
        #$produtos_id = $sql->pluck('aplicacao.produto_id'); #Nao retorna como json

        $produtos = Produto::whereIn('id', $sql->pluck('aplicacao.produto_id'))->get();

        foreach ($produtos as $produto) {

            $produto->aplicacoes = DB::table('aplicacao')
                        ->select(
                            DB::raw("modelo.nome as modelo"),
                            DB::raw("posicao.nome as posicao"),
                            DB::raw("group_concat(distinct motor.nome order by motor.nome asc separator ', ') as motor"),
                            DB::raw("nvl(aplicacao.ano_inicial, '-') as ano_inicial"),
                            DB::raw("nvl(aplicacao.ano_final, '-') as ano_final"),
                            DB::raw("aplicacao.observacao as observacao"))
                        ->join('aplicacao_modelo', 'aplicacao_modelo.aplicacao_id', '=', 'aplicacao.id')
                        ->join('modelo', 'aplicacao_modelo.modelo_id', '=', 'modelo.id')
                        ->join('aplicacao_motor', 'aplicacao_motor.aplicacao_id', '=', 'aplicacao.id')
                        ->join('motor', 'aplicacao_motor.motor_id', '=', 'motor.id')
                        ->join('posicao', 'posicao.id', '=', 'aplicacao.posicao_id')
                        ->where('aplicacao.produto_id', '=', $produto->id)
                        ->groupBy('modelo.nome', 'posicao.nome', 'aplicacao.ano_inicial', 
                                   'aplicacao.ano_final', 'aplicacao.observacao')
                        ->orderBy('modelo.nome', 'asc')
                        ->orderBy('posicao.nome', 'asc')
                        ->get();
        }

        #"dd($produtos);

        return view('pesquisar', [
            'produtos' => $produtos,
            'grupos' => $grupos,
            'motores' => $motores,
            'posicoes' => $posicoes,
            'modelos' => $modelos,
        ]);
    }
}

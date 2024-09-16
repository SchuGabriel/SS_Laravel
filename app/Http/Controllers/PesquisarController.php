<?php

namespace App\Http\Controllers;

use App\Models\Grupo;
use App\Models\Modelo;
use App\Models\Motor;
use App\Models\Posicao;
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
            ->select('aplicacao.*');

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

        $aplicacoes = $sql->get();

        #dd($sql->toSql());
        #dd($aplicacao);

        foreach($aplicacoes as $aplicacao){
            
        }
    }
}

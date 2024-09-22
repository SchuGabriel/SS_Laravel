<?php

namespace App\Http\Controllers;

use App\Models\Aplicacao;
use App\Models\Modelo;
use App\Models\Motor;
use App\Models\Posicao;
use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use function Laravel\Prompts\alert;

class AplicacaoController extends Controller
{
    public function index()
    {

        $produto = null;
        $aplicacoes = null;

        return view('aplicacao', [
            'produto' => $produto,
            'aplicacoes' => $aplicacoes,
        ]);
    }

    public function search(Request $request)
    {

        $produto = Produto::where('referencia', $request->input('referencia'))->first();
        $posicoes = Posicao::all();
        $motores = Motor::all();
        $modelos = Modelo::all();
        #$aplicacoes = Aplicacao::with('modelos', 'motores')->get();
        $aplicacoes = $this->buscaAplicacao($produto->id);

        return view('aplicacao', [
            'produto' => $produto,
            'posicoes' => $posicoes,
            'motores' => $motores,
            'modelos' => $modelos,
            'aplicacoes' => $aplicacoes,
        ]);
    }

    public function store(Request $request)
    {

        $aplicacao = new Aplicacao();

        $aplicacao->produto_id = $request->input('produto_id');
        $aplicacao->posicao_id = $request->input('posicao_id');
        $aplicacao->ano_inicial = $request->input('ano_ini');
        $aplicacao->ano_final = $request->input('ano_fim');
        $aplicacao->observacao = $request->input('observacao');
        $aplicacao->save();

        $modelos = $request->input('modelo_id');
        if ($modelos && is_array($modelos)) {
            $aplicacao->modelos()->attach($modelos);
        }

        $motores = $request->input('motor_id');
        if ($motores && is_array($motores)) {
            $aplicacao->motores()->attach($motores);
        }

        $aplicacoes = $this->buscaAplicacao($request->input('produto_id'));
        $posicoes = Posicao::all();
        $motores = Motor::all();
        $modelos = Modelo::all();
        $produto = Produto::find($request->input('produto_id'));

        return view('aplicacao', [
            'aplicacoes' => $aplicacoes,
            'posicoes' => $posicoes,
            'motores' => $motores,
            'modelos' => $modelos,
            'produto' => $produto,
        ]);
    }

    public function buscaAplicacao($produto_id){
        $aplicacaoes = DB::table('aplicacao')
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
                        ->where('aplicacao.produto_id', '=', $produto_id)
                        ->groupBy('modelo.nome', 'posicao.nome', 'aplicacao.ano_inicial', 
                                   'aplicacao.ano_final', 'aplicacao.observacao')
                        ->orderBy('modelo.nome', 'asc')
                        ->orderBy('posicao.nome', 'asc')
                        ->get();

        return $aplicacaoes;
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Aplicacao;
use App\Models\Modelo;
use App\Models\Motor;
use App\Models\Posicao;
use App\Models\Produto;
use Illuminate\Http\Request;

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
        $aplicacoes = Aplicacao::with('modelos', 'motores')->get();

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

        $aplicacoes = Aplicacao::with('modelos', 'motores')->get();
        $posicoes = Posicao::all();
        $motores = Motor::all();
        $modelos = Modelo::all();

        return view('aplicacao', [
            'aplicacoes' => $aplicacoes,
            'posicoes' => $posicoes,
            'motores' => $motores,
            'modelos' => $modelos,
            'produto' => null,
        ]);
    }
}

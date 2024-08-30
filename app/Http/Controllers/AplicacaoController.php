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
    public function index(){

        $produto = null;

        return view('aplicacao', [
            'produto' => $produto,
        ]);
    }

    public function search(Request $request){

        $produto = Produto::where('referencia', $request->input('referencia'))->first();
        $posicoes = Posicao::all();
        $motores = Motor::all();
        $modelos = Modelo::all();

        return view('aplicacao', [
            'produto' => $produto,
            'posicoes' => $posicoes,
            'motores' => $motores,
            'modelos' => $modelos,
        ]);
    }

    public function store(Request $request){


    }
}

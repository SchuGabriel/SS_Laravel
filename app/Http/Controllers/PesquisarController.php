<?php

namespace App\Http\Controllers;

use App\Models\Grupo;
use App\Models\Modelo;
use App\Models\Motor;
use App\Models\Posicao;
use Illuminate\Http\Request;

class PesquisarController extends Controller
{
    public function index(){

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

    public function search(Request $request){

        

    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Modelo;
use App\Models\Montadora;
use Illuminate\Http\Request;

class ModeloContoller extends Controller
{
    public function index(){
        $modelos = Modelo::all();

        return view('modelos', [
            'modelos' => $modelos,
        ]);
    }

    public function create(){
        $modelo = new Modelo();
        $montadoras = Montadora::all();
        
        return view('modelo', [
            'modelo' => $modelo,
            'montadoras' => $montadoras,
        ]);
    }

    public function store(Request $request){
        $modelo = New Modelo();

        $modelo->nome = $request->input('nome');
        $modelo->montadora_id = $request->input('montadora_id');
        $modelo->save();

        return redirect()->route('modelo.index');
    }

    public function edit($id){
        $modelo = Modelo::find($id);
        $montadoras = Montadora::all();

        return view('modelo', [
            'modelo' => $modelo,
            'montadoras' => $montadoras,
        ]);
    }

    public function update($id, Request $request){
        
        $modelo = Modelo::find($id);
        $modelo->nome = $request->input('nome');
        $modelo->montadora_id = $request->input('montadora_id');
        $modelo->save();

        return redirect()->route('modelo.index');
    }

    public function destroy($id){
        $modelo = Modelo::find($id);
        $modelo->delete();
        return redirect()->route('modelo.index');
    }
}

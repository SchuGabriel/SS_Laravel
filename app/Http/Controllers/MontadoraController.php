<?php

namespace App\Http\Controllers;

use App\Models\Montadora;
use Illuminate\Http\Request;

class MontadoraController extends Controller
{
    public function index(){
        $montadoras = Montadora::all();

        return view('montadoras', [
            'montadoras' => $montadoras,
        ]);
    }

    public function create(){
        $montadora = new Montadora();

        return view('montadora', [
            'montadora' => $montadora,
        ]);
    }

    public function store(Request $request){
        $montadora = New Montadora();

        $montadora->nome = $request->input('nome');
        $montadora->save();

        return redirect()->route('montadora.index');
    }

    public function edit($id){
        $montadora = Montadora::find($id);

        return view('montadora', [
            'montadora' => $montadora,
        ]);
    }

    public function update($id, Request $request){
        
        $montadora = Montadora::find($id);
        $montadora->nome = $request->input('nome');
        $montadora->save();
        return redirect()->route('montadora.index');
    }

    public function destroy($id){
        $montadora = Montadora::find($id);
        $montadora->delete();
        return redirect()->route('montadora.index');
    }
}

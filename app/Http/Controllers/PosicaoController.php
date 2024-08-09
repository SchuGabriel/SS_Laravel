<?php

namespace App\Http\Controllers;

use App\Models\Posicao;
use Illuminate\Http\Request;

class PosicaoController extends Controller
{
    public function index(){
        $posicoes = Posicao::all();

        return view('posicoes', [
            'posicoes' => $posicoes,
        ]);
    }

    public function create(){
        $posicao = new Posicao();

        return view('posicao', [
            'posicao' => $posicao,
        ]);
    }

    public function store(Request $request){
        $posicao = New Posicao();

        $posicao->nome = $request->input('nome');
        $posicao->save();

        return redirect()->route('posicao.index');
    }

    public function edit($id){
        $posicao = Posicao::find($id);

        return view('posicao', [
            'posicao' => $posicao,
        ]);
    }

    public function update($id, Request $request){
        
        $posicao = Posicao::find($id);
        $posicao->nome = $request->input('nome');
        $posicao->save();
        return redirect()->route('posicao.index');
    }

    public function destroy($id){
        $posicao = Posicao::find($id);
        $posicao->delete();
        return redirect()->route('posicao.index');
    }
}

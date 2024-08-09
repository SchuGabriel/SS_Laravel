<?php

namespace App\Http\Controllers;

use App\Models\Grupo;
use Illuminate\Http\Request;

class GrupoController extends Controller
{
    public function index(){
        $grupos = Grupo::all();

        return view('grupos', [
            'grupos' => $grupos,
        ]);
    }

    public function create(){
        $grupo = new Grupo();

        return view('grupo', [
            'grupo' => $grupo,
        ]);
    }

    public function store(Request $request){
        $grupo = New Grupo();

        $grupo->nome = $request->input('nome');
        $grupo->save();

        return redirect()->route('grupo.index');
    }

    public function edit($id){
        $grupo = Grupo::find($id);

        return view('grupo', [
            'grupo' => $grupo,
        ]);
    }

    public function update($id, Request $request){
        
        $grupo = Grupo::find($id);
        $grupo->nome = $request->input('nome');
        $grupo->save();
        return redirect()->route('grupo.index');
    }

    public function destroy($id){
        $grupo = Grupo::find($id);
        $grupo->delete();
        return redirect()->route('grupo.index');
    }
}

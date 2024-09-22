<?php

namespace App\Http\Controllers;

use App\Models\Motor;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;

class MotorController extends Controller
{
    public function index(){
        $motores = Motor::all();

        return view('motores', [
            'motores' => $motores,
        ]);
    }

    public function create(){
        $motor = new Motor();

        return view('motor', [
            'motor' => $motor,
        ]);
    }

    public function store(Request $request){
        $motor = New Motor();

        $validator = Validator::make($request->all(), [
            'nome' => 'required|integer',
        ],[
            'nome.required' => "O nome deve ser preenchido",
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }        

        $motor->nome = $request->input('nome');
        $motor->save();

        return redirect()->route('motor.index');
    }

    public function edit($id){
        $motor = Motor::find($id);

        return view('motor', [
            'motor' => $motor,
        ]);
    }

    public function update($id, Request $request){
        
        $motor = Motor::find($id);
        $motor->nome = $request->input('nome');
        $motor->save();
        return redirect()->route('motor.index');
    }

    public function destroy($id){
        $motor = Motor::find($id);
        $motor->delete();
        return redirect()->route('motor.index');
    }
}

<?php

use App\Http\Controllers\GrupoController;
use App\Http\Controllers\ModeloContoller;
use App\Http\Controllers\MontadoraController;
use App\Http\Controllers\MotorController;
use App\Http\Controllers\PosicaoController;
use App\Http\Controllers\ProdutoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::prefix('montadora')->group(function(){

    Route::get('/', [MontadoraController::class, 'index'])->name('montadora.index');
    Route::get('/new', [MontadoraController::class, 'create'])->name('montadora.create');
    Route::post('', [MontadoraController::class, 'store'])->name('montadora.store');
    Route::get('{id}', [MontadoraController::class, 'edit'])->name('montadora.edit');
    Route::put('{id}', [MontadoraController::class, 'update'])->name('montadora.update');
    Route::delete('{id}', [MontadoraController::class, 'destroy'])->name('montadora.destroy');

});

Route::prefix('modelo')->group(function(){

    Route::get('/', [ModeloContoller::class, 'index'])->name('modelo.index');
    Route::get('/new', [ModeloContoller::class, 'create'])->name('modelo.create');
    Route::post('', [ModeloContoller::class, 'store'])->name('modelo.store');
    Route::get('{id}', [ModeloContoller::class, 'edit'])->name('modelo.edit');
    Route::put('{id}', [ModeloContoller::class, 'update'])->name('modelo.update');
    Route::delete('{id}', [ModeloContoller::class, 'destroy'])->name('modelo.destroy');

});

Route::prefix('posicao')->group(function(){

    Route::get('/', [PosicaoController::class, 'index'])->name('posicao.index');
    Route::get('/new', [PosicaoController::class, 'create'])->name('posicao.create');
    Route::post('', [PosicaoController::class, 'store'])->name('posicao.store');
    Route::get('{id}', [PosicaoController::class, 'edit'])->name('posicao.edit');
    Route::put('{id}', [PosicaoController::class, 'update'])->name('posicao.update');
    Route::delete('{id}', [PosicaoController::class, 'destroy'])->name('posicao.destroy');

});

Route::prefix('motor')->group(function(){

    Route::get('/', [MotorController::class, 'index'])->name('motor.index');
    Route::get('/new', [MotorController::class, 'create'])->name('motor.create');
    Route::post('', [MotorController::class, 'store'])->name('motor.store');
    Route::get('{id}', [MotorController::class, 'edit'])->name('motor.edit');
    Route::put('{id}', [MotorController::class, 'update'])->name('motor.update');
    Route::delete('{id}', [MotorController::class, 'destroy'])->name('motor.destroy');

});

Route::prefix('grupo')->group(function(){

    Route::get('/', [GrupoController::class, 'index'])->name('grupo.index');
    Route::get('/new', [GrupoController::class, 'create'])->name('grupo.create');
    Route::post('', [GrupoController::class, 'store'])->name('grupo.store');
    Route::get('{id}', [GrupoController::class, 'edit'])->name('grupo.edit');
    Route::put('{id}', [GrupoController::class, 'update'])->name('grupo.update');
    Route::delete('{id}', [GrupoController::class, 'destroy'])->name('grupo.destroy');

});

Route::prefix('produto')->group(function(){

    Route::get('/', [ProdutoController::class, 'index'])->name('produto.index');
    Route::get('/new', [ProdutoController::class, 'create'])->name('produto.create');
    Route::post('', [ProdutoController::class, 'store'])->name('produto.store');
    Route::get('{id}', [ProdutoController::class, 'edit'])->name('produto.edit');
    Route::put('{id}', [ProdutoController::class, 'update'])->name('produto.update');
    Route::delete('{id}', [ProdutoController::class, 'destroy'])->name('produto.destroy');

});
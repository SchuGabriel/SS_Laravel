<?php

use App\Http\Controllers\ModeloContoller;
use App\Http\Controllers\MontadoraController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
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
<?php

use App\Http\Controllers\MontadoraController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('montadora')->group(function(){

    Route::get('/', [MontadoraController::class, 'index'])->name('montadora.index');
    Route::get('/new', [MontadoraController::class, 'create'])->name('montadora.create');
    Route::post('', [MontadoraController::class, 'store'])->name('montadora.store');

});
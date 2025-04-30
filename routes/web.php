<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\DesafioAvelarController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/desafio-avelar', [DesafioAvelarController::class, 'index'])->name('desafio.avelar.index');
Route::post('/desafio-avelar/store', [DesafioAvelarController::class, 'store'])->name('desafio.avelar.store');

/* Route::middleware('web', 'auth')->group(function () {
    Route::get('/desafio-avelar', [Controller::class, 'index'])->name('desafio.avelar.index');
}); */

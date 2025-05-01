<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\DesafioAvelarController;
use Illuminate\Support\Facades\Route;

/* Route::get('/', function () {
    return view('welcome');
}); */

Route::get('/', [DesafioAvelarController::class, 'index'])->name('desafio.avelar.index');
Route::post('/desafio-avelar/store', [DesafioAvelarController::class, 'store'])->name('desafio.avelar.store');
Route::put('/desafio-avelar/update', [DesafioAvelarController::class, 'update'])->name('desafio.avelar.update');
Route::delete('desafio-avelar/delete', [DesafioAvelarController::class, 'destroy'])->name('desafio.avelar.delete');
Route::get('desafio-avelar/anexo/{id}', [DesafioAvelarController::class, 'pdf'])->name('desafio.avelar.pdf');

/* Route::middleware('web', 'auth')->group(function () {
    Route::get('/desafio-avelar', [Controller::class, 'index'])->name('desafio.avelar.index');
}); */

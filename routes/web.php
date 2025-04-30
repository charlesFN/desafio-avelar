<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/desafio-avelar', function() {
    return view('index');
});

/* Route::middleware('web', 'auth')->group(function () {
    Route::get('/desafio-avelar', [Controller::class, 'index'])->name('desafio.avelar.index');
}); */

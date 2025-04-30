<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DesafioAvelarController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function store(Request $request)
    {
        dd($request);
    }
}

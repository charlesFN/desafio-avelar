<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDesafioAvelarRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DesafioAvelarController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function store(StoreDesafioAvelarRequest $request)
    {
        $request->validated();

        if ($request->ensino_medio == null) {
            $ensino_medio = false;
        } else {
            $ensino_medio = true;
        }

        $caminho_arquivo = $request->file('anexo')->store('anexos');

        try {
            DB::beginTransaction();
                DB::table('dados')->insert([
                    'nome' => $request->nome,
                    'idade' => $request->idade,
                    'cep' => $request->cep,
                    'cidade' => $request->cidade,
                    'estado' => $request->estado,
                    'rua' => $request->rua,
                    'bairro' => $request->bairro,
                    'ensino_medio' => $ensino_medio,
                    'sexo' => $request->sexo,
                    'salario' => number_format($request->salario, 2, '.', ''),
                    'anexo' => $caminho_arquivo
                ]);
            DB::commit();

            return redirect()->back();
        } catch (\Throwable $e) {
            DB::rollBack();

            Log::warning('Não foi possível salvar o novo registro.', ['error' => $e->getMessage()]);

            return redirect()->back();
        }
    }
}

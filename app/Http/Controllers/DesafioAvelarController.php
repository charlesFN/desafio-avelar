<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDesafioAvelarRequest;
use App\Http\Requests\UpdateDesafioAvelarRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DesafioAvelarController extends Controller
{
    public function index()
    {
        $dados = DB::select('select * from dados order by id desc');

        return view('index', compact('dados'));
    }

    public function store(StoreDesafioAvelarRequest $request)
    {
        $request->validated();

        if ($request->ensino_medio == null) {
            $ensino_medio = false;
        } else {
            $ensino_medio = true;
        }

        $salario_formatado = number_format($request->salario, 2, '.', '');

        $caminho_arquivo = $request->file('anexo')->store('anexos');

        try {
            DB::beginTransaction();
                DB::insert(
                    'insert into dados (nome, idade, cep, cidade, estado, rua, bairro, ensino_medio, sexo, salario, anexo)
                            values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
                            [$request->nome, $request->idade, $request->cep, $request->cidade, $request->estado, $request->rua, $request->bairro, $ensino_medio, $request->sexo, $salario_formatado, $caminho_arquivo]);

            DB::commit();

            return redirect()->back();
        } catch (\Throwable $e) {
            DB::rollBack();

            Log::warning('Não foi possível salvar o novo registro.', ['error' => $e->getMessage()]);

            return redirect()->back();
        }
    }

    public function update(UpdateDesafioAvelarRequest $request)
    {
        $request->validated();

        if ($request->ensino_medio == null) {
            $ensino_medio = false;
        } else {
            $ensino_medio = true;
        }

        $salario_formatado = number_format($request->salario, 2, '.', '');

        /* if ($request->anexo != null) {
            $caminho_arquivo = $request->file('anexo')->store('anexos');
        } */

        try {
            DB::beginTransaction();
                DB::update('update dados set nome = ?, idade = ?, cep = ?, cidade = ?, estado = ?, rua = ?, bairro = ?, ensino_medio = ?, sexo = ?, salario = ? where id = ?',
                    [$request->nome, $request->idade, $request->cep, $request->cidade, $request->estado, $request->rua, $request->bairro, $ensino_medio, $request->sexo, $salario_formatado, $request->id]);

            DB::commit();

            return redirect()->back();
        } catch (\Throwable $e) {
            dd('erro');

            DB::rollback();

            Log::warning('Não foi possível atualizar o registro.', ['error' => $e->getMessage()]);

            return redirect()->back();
        }
    }
}

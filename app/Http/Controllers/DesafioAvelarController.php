<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreDesafioAvelarRequest;
use App\Http\Requests\UpdateDesafioAvelarRequest;

class DesafioAvelarController extends Controller
{
    public function index()
    {
        $dados = DB::select('select * from dados order by id desc');

        return view('index', compact('dados'));
    }

    public function store(StoreDesafioAvelarRequest $request)
    {
        if ($request->ensino_medio == null) {
            $ensino_medio = false;
        } else {
            $ensino_medio = true;
        }

        $salario_formatado = floatval(str_replace(',', '.', str_replace('.', '', $request->salario)));

        $anexo = $request->anexo->getClientOriginalname();
        $request->file('anexo')->storeAs('anexos', $anexo, 'public');

        try {
            DB::beginTransaction();
                DB::insert(
                    'insert into dados (nome, idade, cep, cidade, estado, rua, bairro, ensino_medio, sexo, salario, anexo)
                            values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
                            [$request->nome, $request->idade, $request->cep, $request->cidade, $request->estado, $request->rua, $request->bairro, $ensino_medio, $request->sexo, $salario_formatado, 'storage/anexos/'.$anexo]);

            DB::commit();

            return redirect()->back()->with('success', 'Registro criado!');
        } catch (\Throwable $e) {
            DB::rollBack();

            Log::warning('Não foi possível salvar o novo registro.', ['error' => $e->getMessage()]);

            return redirect()->back()->with('error', 'Infelizmente algo deu errado, por favor entre em contato com o nosso suporte.');
        }
    }

    public function update(UpdateDesafioAvelarRequest $request)
    {
        $request->validated();

        try {
            if ($request->ensino_medio == null) {
                $ensino_medio = false;
            } else {
                $ensino_medio = true;
            }

            $salario_formatado = floatval(str_replace(',', '.', str_replace('.', '', $request->salario)));

            if ($request->anexo != null) {
                $anexo_salvo = DB::select('select anexo from dados where id = ?', [$request->id]);
                Storage::delete([$anexo_salvo[0]->anexo]);

                $novo_anexo = $request->anexo->getClientOriginalname();
                $request->file('anexo')->storeAs('anexos', $novo_anexo, 'public');
            }

            DB::beginTransaction();
                DB::update('update dados set nome = ?, idade = ?, cep = ?, cidade = ?, estado = ?, rua = ?, bairro = ?, ensino_medio = ?, sexo = ?, salario = ?, anexo = ? where id = ?',
                    [$request->nome, $request->idade, $request->cep, $request->cidade, $request->estado, $request->rua, $request->bairro, $ensino_medio, $request->sexo, $salario_formatado, 'storage/anexos/'.$novo_anexo, $request->id]);

            DB::commit();

            return redirect()->back()->with('success', 'Registro atualizado!');
        } catch (\Throwable $e) {
            DB::rollback();

            Log::warning('Não foi possível atualizar o registro.', ['error' => $e->getMessage()]);

            return redirect()->back()->with('error', 'Infelizmente algo deu errado, por favor entre em contato com o nosso suporte.');
        }
    }

    public function destroy(Request $request)
    {
        try {
            $anexo = DB::select('select anexo from dados where id = ?', [$request->id]);

            Storage::delete([$anexo[0]->anexo]);

            DB::delete('delete from dados where id = ?', [$request->id]);

            return redirect()->back()->with('success', 'Registro excluído!');
        } catch (\Throwable $e) {
            Log::warning('Não foi possível excluir o registro.', ['error' => $e->getMessage()]);

            return redirect()->back()->with('error', 'Infelizmente algo deu errado, por favor entre em contato com o nosso suporte.');
        }
    }

    public function pdf($id)
    {
        $anexo = DB::select('select anexo from dados where id = ?', [$id]);

        return response()->file($anexo[0]->anexo);
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StoreDesafioAvelarRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nome' => 'required|max:150',
            'idade' => 'required|integer|min:0',
            'cep' => 'required|max:13',
            'cidade' => 'required|max:100',
            'estado' => 'required|max:2',
            'rua' => 'required|max:150',
            'bairro' => 'required|max:100',
            'ensino_medio' => 'nullable|in:on',
            'sexo' => ['required', Rule::in(['Masculino','Feminino','Outro'])],
            'salario' => 'required|min:0|max:999999999999.99',
            'anexo' => 'required|file|max:10240|mimes:pdf,jpg,pdf',
        ];
    }
}

<!DOCTYPE html>
<html lang="pt_br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Desafio Avelar</title>

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
</head>
<body style="background-color: #323539">
    <div class="container mt-3">
        <div class="card text-bg-dark">
            <div class="card-header d-flex justify-content-between">
                <h5 class="card-title">Registros</h5>
                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#cadastro">Criar</button>
            </div>
        </div>

        <table class="table table-dark table-striped table-hover mt-3" style="border-color: #6E12F5">
            <thead>
                <th>#</th>
                <th>Nome</th>
                <th>Idade</th>
                <th>Sexo</th>
                <th>Salário</th>
                <th>Anexo</th>
                <th>Opções</th>
            </thead>
            <tbody>
                @forelse ($dados as $dado)
                    <tr>
                        <td>{{ $dado->id }}</td>
                        <td>{{ $dado->nome }}</td>
                        <td>{{ $dado->idade }}</td>
                        <td>{{ $dado->sexo }}</td>
                        <td>R$ {{ number_format($dado->salario, 2, ',', '') }}</td>
                        <td></td>
                        <td>
                            <div class="d-flex justify-content-between">
                                <button type="button" class="btn btn-sm btn-info"><i class="fas fa-eye"></i></button>
                                <button type="button" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></button>
                                <button type="button" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td>Nenhum registro encontrado.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{-- Modal de Cadasto --}}
        <div class="modal fade" id="cadastro" data-bs-backdrop="static">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">Cadastrar</h3>
                        <button class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                    </div>
                    <div class="modal-body">
                        @include('components.form-cadastro')
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

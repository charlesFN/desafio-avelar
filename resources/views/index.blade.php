<!DOCTYPE html>
<html lang="pt_br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Desafio Avelar</title>

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div class="container mt-3">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h5 class="card-title">Registros</h5>
                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#cadastro">Criar</button>
            </div>
        </div>

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

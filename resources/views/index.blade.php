<!DOCTYPE html>
<html lang="pt_br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div class="container">
        <form action="{{ route('desafio.avelar.store') }}" method="post">
            @csrf

            <div class="mb-3">
                <label for="nome">Nome <span class="text-danger">*</span></label>
                <input required type="text" name="nome" id="nome" class="form-control" maxlength="150">
            </div>
            <div class="mb-3">
                <label for="idade">Idade <span class="text-danger">*</span></label>
                <div class="input-group">
                    <input required type="number" name="idade" class="form-control" id="idade" min="0" step="1">
                    <span class="input-group-text">Anos</span>
                </div>
            </div>
            <div class="mb-3">
                <label for="cep">CEP <span class="text-danger">*</span></label>
                <input required type="text" name="cep" id="cep" class="form-control" maxlength="13">
            </div>
            <div class="mb-3">
                <label for="cidade">Cidade <span class="text-danger">*</span></label>
                <input required type="text" name="cidade" id="cidade" class="form-control" maxlength="100">
            </div>
            <div class="mb-3">
                <label for="estado">Estado <span class="text-danger">*</span></label>
                <input required type="text" name="estado" id="estado" class="form-control" maxlength="2">
            </div>
            <div class="mb-3">
                <label for="rua">Rua <span class="text-danger">*</span></label>
                <input required type="text" name="rua" id="rua" class="form-control" maxlength="150">
            </div>
            <div class="mb-3">
                <label for="bairro">Bairro <span class="text-danger">*</span></label>
                <input required type="text" name="bairro" id="bairro" class="form-control" maxlength="100">
            </div>
            <div class="mb-3">
                <label for="sexo">Sexo <span class="text-danger">*</span></label>
                <select name="sexo" id="sexo" class="form-select">
                    <option selected value="{{ null }}">Selecione uma opção</option>
                    <option value="Masculino">Masculino</option>
                    <option value="Feminino">Feminino</option>
                    <option value="Outro">Outro</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="salario">Salário <span class="text-danger">*</span></label>
                <div class="input-group">
                    <span class="input-group-text">R$</span>
                    <input required type="number" name="salario" id="salario" class="form-control" min="0" max="999999999999.99" step="0.01">
                </div>
            </div>
            <div class="mb-3">
                <label for="anexo">Anexo (Máx. 10MB) <span class="text-danger">*</span></label>
                <input required type="file" name="anexo" id="anexo" class="form-control" accept=".pdf, .jpg, .png" size="">
            </div>
            <button class="btn btn-primary">Cadastrar</button>
        </form>
    </div>
</body>
</html>

<form action="{{ route('desafio.avelar.store') }}" method="post" enctype="multipart/form-data">
    @csrf

    <div class="mb-3">
        <label for="nome">Nome <span class="text-danger">*</span></label>
        <input required type="text" name="nome" id="nome" class="form-control" maxlength="150" value="{{ old('nome') }}">
        @error('nome')
            <p class="text-danger">{{ $message }}</p>
        @enderror
    </div>
    <div class="mb-3">
        <label for="idade">Idade <span class="text-danger">*</span></label>
        <div class="input-group">
            <input required type="number" name="idade" class="form-control" id="idade" min="0" step="1" value="{{ old('idade') }}">
            <span class="input-group-text">Anos</span>
        </div>
        @error('idade')
            <p class="text-danger">{{ $message }}</p>
        @enderror
    </div>
    <div class="mb-3">
        <label for="cep_cadastrar">CEP <span class="text-danger">*</span></label>
        <input required type="text" name="cep" id="cep_cadastrar" class="form-control cep" maxlength="13" value="{{ old('cep') }}">
        @error('cep')
            <p class="text-danger">{{ $message }}</p>
        @enderror
    </div>
    <div class="mb-3">
        <label for="cidade">Cidade <span class="text-danger">*</span></label>
        <input required type="text" name="cidade" id="cidade" class="form-control" maxlength="100" value="{{ old('cidade') }}">
        @error('cidade')
            <p class="text-danger">{{ $message }}</p>
        @enderror
    </div>
    <div class="mb-3">
        <label for="estado">Estado <span class="text-danger">*</span></label>
        <input required type="text" name="estado" id="estado" class="form-control" maxlength="2" value="{{ old('estado') }}">
        @error('estado')
            <p class="text-danger">{{ $message }}</p>
        @enderror
    </div>
    <div class="mb-3">
        <label for="rua">Rua <span class="text-danger">*</span></label>
        <input required type="text" name="rua" id="rua" class="form-control" maxlength="150" value="{{ old('rua') }}">
        @error('rua')
            <p class="text-danger">{{ $message }}</p>
        @enderror
    </div>
    <div class="mb-3">
        <label for="bairro">Bairro <span class="text-danger">*</span></label>
        <input required type="text" name="bairro" id="bairro" class="form-control" maxlength="100" value="{{ old('bairro') }}">
        @error('bairro')
            <p class="text-danger">{{ $message }}</p>
        @enderror
    </div>
    <div class="mb-3">
        <div class="form-check">
            <input type="checkbox" name="ensino_medio" id="ensinoMedio" class="form-check-input">
            <label for="ensinoMedio" class="form-check-label">
                Possui Ensino Médio
            </label>
        </div>
        @error('ensino_medio')
            <p class="text-danger">{{ $message }}</p>
        @enderror
    </div>
    <div class="mb-3">
        <label for="sexo">Sexo <span class="text-danger">*</span></label>
        <select name="sexo" id="sexo" class="form-select">
            <option value="{{ null }}">Selecione uma opção</option>
            <option value="Masculino" @if(old('sexo') == 'Masculino') selected @endif>Masculino</option>
            <option value="Feminino" @if(old('sexo') == 'Feminino') selected @endif>Feminino</option>
            <option value="Outro" @if(old('sexo') == 'Outro') selected @endif>Outro</option>
        </select>
        @error('sexo')
            <p class="text-danger">{{ $message }}</p>
        @enderror
    </div>
    <div class="mb-3">
        <label for="salario">Salário <span class="text-danger">*</span></label>
        <div class="input-group">
            <span class="input-group-text">R$</span>
            <input required type="text" name="salario" id="salario" class="form-control salario" value="{{ old('salario') }}">
        </div>
        @error('salario')
            <p class="text-danger">{{ $message }}</p>
        @enderror
    </div>
    <div class="mb-3">
        <label for="anexo">Anexo (Máx. 10MB) <span class="text-danger">*</span></label>
        <input required type="file" name="anexo" id="anexo" class="form-control" accept=".pdf, .jpg, .png">
        @error('anexo')
            <p class="text-danger">{{ $message }}</p>
        @enderror
    </div>
    <button class="btn btn-primary w-100">Cadastrar</button>
</form>

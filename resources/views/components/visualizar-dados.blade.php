<div class="mb-3">
    <label for="idade">Idade</label>
    <div class="input-group">
        <input readonly type="text" id="nome" class="form-control" value="{{ $dado->idade }}">
        <span class="input-group-text">Anos</span>
    </div>
</div>
<div class="mb-3">
    <label for="cep">CEP</label>
    <input readonly type="text" id="cep" class="form-control" value="{{ $dado->cep }}">
</div>
<div class="mb-3">
    <label for="cidade">Cidade</label>
    <input readonly type="text" id="cidade" class="form-control" value="{{ $dado->cidade }}">
</div>
<div class="mb-3">
    <label for="estado">Estado</label>
    <input readonly type="text" id="estado" class="form-control" value="{{ $dado->estado }}">
</div>
<div class="mb-3">
    <label for="rua">Rua</label>
    <input readonly type="text" id="rua" class="form-control" value="{{ $dado->rua }}">
</div>
<div class="mb-3">
    <label for="bairro">Bairro</label>
    <input readonly type="text" id="bairro" class="form-control" value="{{ $dado->bairro }}">
</div>
<div class="mb-3">
    <label for="ensino_medio">Ensino Médio</label>
    @if($dado->ensino_medio == true)
        <input readonly type="text" id="ensino_medio" class="form-control" value="Possui Ensino Médio">
    @else
        <input readonly type="text" id="ensino_medio" class="form-control" value="Não Possui Ensino Médio">
    @endif
</div>
<div class="mb-3">
    <label for="sexo">Sexo</label>
    <input readonly type="text" id="sexo" class="form-control" value="{{ $dado->sexo }}">
</div>
<div class="mb-3">
    <label for="salario">Salário</label>
    <div class="input-group">
        <span class="input-group-text">R$</span>
        <input readonly type="text" id="salario" class="form-control" value="{{ number_format($dado->salario, 2, ',', '.') }}">
    </div>
</div>

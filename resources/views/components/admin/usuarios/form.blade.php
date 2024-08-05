<div class="row">
    <div class="form-group">
        <div class="col-md-12">
            <label for="name">Nome de Usuário *</label>
            <input type="text" name="name" class="form-control" required value="{{ $usuario->name ?? '' }}"/>
        </div>
    </div>
</div>
<div class="row my-2">
    <div class="form-group">
        <div class="col-md-12">
            <label for="nome_completo">Nome Completo do Usuário *</label>
            <input type="text" name="nome_completo" class="form-control" required value="{{ $usuario->nome_completo ?? '' }}"/>
        </div>
    </div>
</div>
<div class="row my-2">
    <div class="form-group">
        <div class="col-md-12">
            <label for="cpf">CPF *</label>
            <input type="text" name="cpf" class="form-control" required value="{{ $usuario->CPF ?? '' }}"/>
        </div>
    </div>
</div>
<div class="row my-2">
    <div class="form-group">
        <div class="col-md-12">
            <label for="email">E-mail *</label>
            <input type="email" name="email" class="form-control" required value="{{ $usuario->email ?? '' }}"/>
        </div>
    </div>
</div>
<div class="row my-2">
    <div class="form-group">
        <div class="col-md-12">
            <label for="acesso_id">Tipo de Acesso *</label>
            <select name="acesso_id" class="form-select">
                <option selected disabled>Selecione</option>
                @foreach($tipos as $tipo)
                    <option value="{{ $tipo->id }}" {{ (isset($usuario) && $usuario->acesso_id == $tipo->id) ? 'selected' : '' }}>{{ $tipo->descricao }}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>
<div class="row my-2">
    <div class="form-group">
        <div class="col-md-12">
            <button class="btn btn-success w-100" type="submit">Salvar</button>
        </div>
    </div>
</div>

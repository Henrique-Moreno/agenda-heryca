@extends('layouts.layoutMaster')

@section('title', 'Cadastrar Servidor')

@section('content')
<div>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
        Cadastrar servidor
    </button>

    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Cadastrar novo servidor</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('servidores.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <label for="nome">Nome do servidor *</label>
                                    <input class="form-control" type="text" id="nome" name="nome" required />
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <label for="email">E-mail do servidor *</label>
                                    <input class="form-control" type="email" id="email" name="email" required />
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <label for="cpf">CPF do Servidor *</label>
                                    <input class="form-control" type="text" id="cpf" name="cpf" required />
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <label for="cargo_id">Cargo *</label>
                                    <select name="cargo_id" class="form-select" required>
                                        <option disabled selected>Selecione o cargo</option>
                                        @foreach($cargos as $cargo)
                                            <option value="{{ $cargo->id }}">{{ $cargo->descricao }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row mt-4">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-success w-100">Salvar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

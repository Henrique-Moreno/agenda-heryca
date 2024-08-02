@extends('layouts.layoutMaster')

@section('title', 'Horários e Dias Disponíveis')

@section('content')

    <div class="card">
        <div class="card-header">
            <h4>Horários e Dias Disponíveis</h4>
        </div>
        <div class="card-body d-flex">
            <div class="info mr-3" style="flex: 1;">
                <p>{{ $servidor->usuario->name }} ({{ $servidor->usuario->email }})</p>
                <p>Atendimento Psicológico IFNMG</p>
                <p>50 min</p>
                <p>Campus Almenara - NAE</p>
                <p>Prezada(o) aluna(o),</p>
                <p>Anote o horário do seu atendimento, pois não haverá lembrete no dia.</p>
                <p>É possível marcar apenas 1 atendimento por semana.</p>
                <p>Agende ou cancele o atendimento com pelo menos 2 horas de antecedência.</p>
                <p>Dúvidas ou sugestões, envie para o WhatsApp: (38) 99239-3460.</p>
            </div>

            <div id="calendar" class="calendar" style="flex: 1;">
                <h5>Escolha uma data e horário</h5>
                <form id="appointmentForm" action="{{ url('/home') }}" method="GET">
                    <input type="hidden" name="servidor_id" value="{{ $servidor->id }}">

                    <div class="form-group">
                        <label for="dia">Data Disponível:</label>
                        <select name="dia" id="dia" class="form-control">
                            <option value="" disabled selected>Escolha um dia</option>

                            @foreach($servidor->dias as $dia)
                                <option value="{{ $dia->data }}">
                                    {{ $dia->dia }} - {{ $dia->data }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="horario">Horário Disponível:</label>
                        <select name="horario" id="horario" class="form-control">
                            <option value="" disabled selected>Escolha um horário</option>

                            @foreach($servidor->horarios as $horario)
                                <option value="{{ $horario }}">{{ $horario }}</option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Confirmar consulta</button>
                </form>
            </div>
        </div>
    </div>

@endsection



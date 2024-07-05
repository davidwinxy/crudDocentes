@extends('layouts.app')

@section('content')
    <h1>Editar Asistencia</h1>
    <form action="{{ route('asistencias.update', $asistencia->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-4">
                <label for="fecha" class="form-label">Fecha</label>
                <input type="date" class="form-control" id="fecha" name="fecha" value="{{ $asistencia->fecha }}" required>
            </div>
            <div class="col-md-4">
                <label for="hora_entrada" class="form-label">Hora de Entrada</label>
                <input type="time" class="form-control" id="hora_entrada" name="hora_entrada" value="{{ $asistencia->hora_entrada }}" required>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <label for="estudiante_id" class="form-label">Estudiante</label>
                <select class="form-control" id="estudiante_id" name="estudiante_id" required>
                    @foreach ($estudiantes as $estudiante)
                        <option value="{{ $estudiante->id }}" {{ $asistencia->estudiante_id == $estudiante->id ? 'selected' : '' }}>{{ $estudiante->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label for="grupo_id" class="form-label">Grupo</label>
                <select class="form-control" id="grupo_id" name="grupo_id" required>
                    @foreach ($grupos as $grupo)
                        <option value="{{ $grupo->id }}" {{ $asistencia->grupo_id == $grupo->id ? 'selected' : '' }}>{{ $grupo->nombre }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-12">
                <button type="submit" class="btn btn-primary">Modificar</button>
                <a href="{{ route('asistencias.index') }}" class="btn btn-secondary">Cancelar</a>
            </div>
        </div>
    </form>
@endsection

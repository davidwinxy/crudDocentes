@extends('layouts.app')

@section('content')
    <h1>Añadir Asistencia</h1>
    <form action="{{ route('asistencias.store') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-4">
                <label for="fecha" class="form-label">Fecha</label>
                <input type="date" class="form-control" id="fecha" name="fecha" required>
            </div>
            <div class="col-md-4">
                <label for="hora_entrada" class="form-label">Hora de Entrada</label>
                <input type="time" class="form-control" id="hora_entrada" name="hora_entrada" required>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <label for="estudiante_id" class="form-label">Estudiante</label>
                <select class="form-control" id="estudiante_id" name="estudiante_id" required>
                    @foreach($estudiantes as $estudiante)
                        <option value="{{ $estudiante->id }}">{{ $estudiante->nombre }} {{ $estudiante->apellido }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label for="grupo_id" class="form-label">Grupo</label>
                <select class="form-control" id="grupo_id" name="grupo_id" required>
                    @foreach($grupos as $grupo)
                        <option value="{{ $grupo->id }}">{{ $grupo->nombre }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <button type="submit" class="btn btn-primary">Crear</button>
                <a href="{{ route('asistencias.index') }}" class="btn btn-secondary">Cancelar</a>
            </div>
        </div>
    </form>
@endsection



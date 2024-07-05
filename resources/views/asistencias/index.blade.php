@extends('layouts.app')

@section('content')

<div class="alert alert-success fade show" id="success-message" data-bs-dismiss="alert" role="alert">
    {{ session('success') }}
</div>

<h1>Lista de Asistencias</h1>

<form action="{{ route('asistencias.index') }}" method="GET">
    @csrf
    <div class="row">
        <div class="col-sm-4">
            <input type="date" class="form-control" name="fecha" placeholder="Fecha">
        </div>
        <div class="col-sm-4">
            <input type="text" class="form-control" name="estudiante_id" placeholder="ID del Estudiante">
        </div>
        <div class="col-sm-4">
            <input type="text" class="form-control" name="grupo_id" placeholder="ID del Grupo">
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-sm-4">
            <button type="submit" class="btn btn-primary">Buscar</button>
            <a href="{{ route('asistencias.create') }}" class="btn btn-secondary">Ir a crear</a>
        </div>
    </div>
</form>

<table class="table table-striped">
    <thead>
        <tr>
            <th>Fecha</th>
            <th>Hora de Entrada</th>
            <th>Estudiante</th>
            <th>Grupo</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($asistencias as $asistencia)
            <tr>
                <td>{{ $asistencia->fecha }}</td>
                <td>{{ $asistencia->hora_entrada }}</td>
                <td>{{ $asistencia->estudiante->nombre }}</td>
                <td>{{ $asistencia->grupo->nombre }}</td>
                <td>
                    <table>
                        <td>
                            <a href="{{ route('asistencias.edit', $asistencia->id) }}" class="btn btn-warning">Editar</a>
                        </td>
                        <td>
                            <a href="{{ route('asistencias.show', $asistencia->id) }}" class="btn btn-info">Ver</a>
                        </td>
                        <td>
                            <form action="{{ route('asistencias.destroy', $asistencia->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                            </form>
                        </td>
                    </table>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<div class="row">
    <div class="col-sm-12">
        {{ $asistencias->links() }}
    </div>
</div>
@endsection


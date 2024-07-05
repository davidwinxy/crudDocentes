@extends('layouts.app')

@section('content')
    <h1>ver docente</h1>
    <div class="row">
        <div class="col-md-4">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombre" value="{{ $docente->nombre }}" disabled>
        </div>
        <div class="col-md-4">
            <label for="apellido" class="form-label">Apellido</label>
            <input type="text" class="form-control" id="apellido" value="{{ $docente->apellido }}" disabled>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <label for="correo" class="form-label">Correo electrónico</label>
            <input type="correo" class="form-control" id="correo" name="email" value="{{ $docente->correo }}" disabled>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-12">
            <a href="{{ route('docentes.index') }}" class="btn btn-primary">Retornar</a>
        </div>
    </div>
@endsection

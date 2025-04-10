@extends('adminlte::page')

@section('title', 'Editar Usuario')

@section('content_header')
    <h1>Editar Usuario</h1>
@endsection

@section('content')
    <form action="{{ route('users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="nrodocumento">Número de Documento</label>
            <input type="text" class="form-control" name="nrodocumento" value="{{ $user->nrodocumento }}" required>
        </div>
        <div class="form-group">
            <label for="nombrecompleto">Nombre Completo</label>
            <input type="text" class="form-control" name="nombrecompleto" value="{{ $user->nombrecompleto }}" required>
        </div>
        <div class="form-group">
            <label for="fechadenacimiento">Fecha de Nacimiento</label>
            <input type="date" class="form-control" name="fechadenacimiento" value="{{ $user->fechadenacimiento }}"
                required>
        </div>
        <div class="form-group">
            <label for="residencia">Residencia</label>
            <select class="form-control" name="residencia" required>
                <option value="nacional" {{ $user->residencia == 'nacional' ? 'selected' : '' }}>Nacional</option>
                <option value="residente" {{ $user->residencia == 'residente' ? 'selected' : '' }}>Residente</option>
            </select>
        </div>
        <div class="form-group">
            <label for="tipo_membresia">Tipo de Membresía</label>
            <select class="form-control" name="tipo_membresia" required>
                <option value="por_dia" {{ $user->tipo_membresia == 'por_dia' ? 'selected' : '' }}>Por Día</option>
                <option value="por_meses" {{ $user->tipo_membresia == 'por_meses' ? 'selected' : '' }}>Por Meses</option>
            </select>
        </div>
        <div class="form-group">
            <label for="fecha_inicio_membresia">Fecha de Inicio de Membresía</label>
            <input type="date" class="form-control" name="fecha_inicio_membresia"
                value="{{ $user->fecha_inicio_membresia }}" required>
        </div>
        <div class="form-group">
            <label for="fecha_fin_membresia">Fecha de Fin de Membresía</label>
            <input type="date" class="form-control" name="fecha_fin_membresia" value="{{ $user->fecha_fin_membresia }}"
                required>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar Usuario</button>
    </form>
@endsection
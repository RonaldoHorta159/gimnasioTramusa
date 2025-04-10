@extends('adminlte::page')

@section('title', 'Editar Locker')

@section('content_header')
    <h1>Editar Locker</h1>
@endsection

@section('content')
    <form action="{{ route('lockers.update', $locker->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="locker_id">ID del Locker</label>
            <input type="text" id="locker_id" class="form-control" value="{{ $locker->id }}" disabled>
        </div>

        <!-- Mostrar el nombre del usuario asignado al locker y permitir su edición -->
        <div class="form-group">
            <label for="user_name">Nombre del Usuario (Si es necesario cambiar)</label>
            <input type="text" id="user_name" class="form-control" name="user_name"
                value="{{ $locker->user ? $locker->user->nombrecompleto : 'No asignado' }}" required>
        </div>

        <div class="form-group">
            <label for="fecha_inicio_membresia">Fecha de Inicio de Membresía</label>
            <input type="date" name="fecha_inicio_membresia" id="fecha_inicio_membresia" class="form-control"
                value="{{ $locker->fecha_inicio_membresia }}" required>
        </div>

        <div class="form-group">
            <label for="fecha_fin_membresia">Fecha de Fin de Membresía</label>
            <input type="date" name="fecha_fin_membresia" id="fecha_fin_membresia" class="form-control"
                value="{{ $locker->fecha_fin_membresia }}" required>
        </div>

        <button type="submit" class="btn btn-success">Guardar Cambios</button>
    </form>
@endsection
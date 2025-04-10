@extends('adminlte::page')

@section('title', 'Crear usuario')

@section('content_header')
    <h1>Registrar Nuevo Usuario</h1>
@endsection

@section('content')
    <form action="{{ route('users.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nrodocumento">Número de Documento</label>
            <input type="text" class="form-control" name="nrodocumento" id="nrodocumento" required>
        </div>
        <div class="form-group">
            <label for="nombrecompleto">Nombre Completo</label>
            <input type="text" class="form-control" name="nombrecompleto" id="nombrecompleto" required>
        </div>
        <div class="form-group">
            <label for="fechadenacimiento">Fecha de Nacimiento</label>
            <input type="date" class="form-control" name="fechadenacimiento" id="fechadenacimiento" required>
        </div>
        <div class="form-group">
            <label for="residencia">Residencia</label>
            <select class="form-control" name="residencia" id="residencia" required>
                <option value="nacional">Nacional</option>
                <option value="residente">Residente</option>
            </select>
        </div>
        <div class="form-group">
            <label for="tipo_membresia">Tipo de Membresía</label>
            <select class="form-control" name="tipo_membresia" id="tipo_membresia" required>
                <option value="por_dia">Por Día</option>
                <option value="por_meses">Por Meses</option>
            </select>
        </div>
        <div class="form-group">
            <label for="fecha_inicio_membresia">Fecha de Inicio de Membresía</label>
            <input type="date" class="form-control" name="fecha_inicio_membresia" id="fecha_inicio_membresia" required>
        </div>
        <div class="form-group">
            <label for="fecha_fin_membresia">Fecha de Fin de Membresía</label>
            <input type="date" class="form-control" name="fecha_fin_membresia" id="fecha_fin_membresia" required>
        </div>
        <div class="form-group">
            <label for="locker_id">Elegir Locker (Opcional)</label>
            <select class="form-control" name="locker_id" id="locker_id">
                <option value="">Ninguno</option>
                @foreach($lockers as $locker)
                    <option value="{{ $locker->id }}">{{ $locker->locker_number }} -
                        {{ $locker->is_assigned ? 'Asignado' : 'Libre' }}
                    </option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Registrar Usuario</button>
    </form>
@endsection
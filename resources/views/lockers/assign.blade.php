@extends('adminlte::page')

@section('title', 'Asignar Locker')

@section('content_header')
    <h1>Asignar Locker</h1>
@endsection

@section('content')
    <form action="{{ route('lockers.assign', $locker->id) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="user_id">Usuario</label>
            <select name="user_id" id="user_id" class="form-control" required>
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->nombrecompleto }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="fecha_inicio_membresia">Fecha de Inicio</label>
            <input type="date" name="fecha_inicio_membresia" id="fecha_inicio_membresia" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="fecha_fin_membresia">Fecha de Fin</label>
            <input type="date" name="fecha_fin_membresia" id="fecha_fin_membresia" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Asignar</button>
    </form>
@endsection
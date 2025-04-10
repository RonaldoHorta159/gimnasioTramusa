@extends('adminlte::page')

@section('title', 'Agregar Locker')

@section('content_header')
    <h1>Agregar Nuevo Locker</h1>
@endsection

@section('content')
    <form action="{{ route('lockers.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="locker_number">Número de Locker</label>
            <input type="text" name="locker_number" id="locker_number" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Guardar</button>
    </form>
@endsection
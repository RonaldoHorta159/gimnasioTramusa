@extends('adminlte::page')

@section('title', 'Lockers Disponibles')

@section('content_header')
    <h1>Lista de Lockers</h1>
@endsection

@section('content')


    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Numero de Locker</th>
                <th>Usuario Asignado</th>
                <th>Fecha de Inicio Membresía</th>
                <th>Fecha de Fin Membresía</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($lockers as $locker)
                <tr>
                    <td>{{ $locker->locker_number }}</td>
                    <td>
                        @if($locker->user)
                            {{ $locker->user->nombrecompleto }}
                        @else
                            Libre
                        @endif
                    </td>
                    <td>
                        @if($locker->fecha_inicio_membresia)
                            {{ $locker->fecha_inicio_membresia }}
                        @else
                            N/A
                        @endif
                    </td>
                    <td>
                        @if($locker->fecha_fin_membresia)
                            {{ $locker->fecha_fin_membresia }}
                        @else
                            N/A
                        @endif
                    </td>
                    <td>
                        @if(!$locker->user)
                            <a href="{{ route('lockers.assign.show', $locker->id) }}" class="btn btn-info">Asignar Locker</a>
                        @else
                            <a href="{{ route('lockers.edit', $locker->id) }}" class="btn btn-warning">Editar</a>
                            <form action="{{ route('lockers.remove', $locker->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Eliminar Membresía</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
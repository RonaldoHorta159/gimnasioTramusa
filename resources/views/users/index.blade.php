@extends('adminlte::page')

@section('title', 'Usuarios Registrados')

@section('content_header')
    <h1>Lista de Usuarios Registrados</h1>
    <a href="{{ route('users.create') }}" class="btn btn-success">Agregar Nuevo Usuario</a>
@endsection

@section('content')
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nombre Completo</th>
                <th>Número de Documento</th>
                <th>Tipo de Membresía</th>
                <th>Locker Asignado</th>
                <th>Fecha de Inicio Membresía</th>
                <th>Fecha de Fin Membresía</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->nombrecompleto }}</td>
                    <td>{{ $user->nrodocumento }}</td>
                    <td>{{ ucfirst(str_replace('_', ' ', $user->tipo_membresia)) }}</td>
                    <td>
                        @if($user->locker)
                            {{ $user->locker->locker_number }} (Asignado)
                        @else
                            Sin asignar
                        @endif
                    </td>
                    <td>{{ $user->fecha_inicio_membresia }}</td>
                    <td>{{ $user->fecha_fin_membresia }}</td>
                    <td>
                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning">Editar</a>
                        <!-- Botón para abrir el modal -->
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#confirmDeleteModal"
                            data-id="{{ $user->id }}">
                            Eliminar
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Modal de confirmación -->
    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmDeleteModalLabel">Confirmar eliminación</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ¿Estás seguro de que quieres eliminar este usuario y liberar su locker?
                </div>
                <div class="modal-footer">
                    <form id="deleteForm" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        // Configurar el formulario de eliminación dinámicamente
        $('#confirmDeleteModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Botón que activó el modal
            var userId = button.data('id'); // Extraer el ID del usuario
            var action = "{{ route('users.destroy', ':id') }}".replace(':id', userId);
            $('#deleteForm').attr('action', action); // Actualizar la acción del formulario
        });
    </script>
@endsection
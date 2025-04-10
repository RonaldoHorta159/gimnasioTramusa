<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Locker;

class LockerController extends Controller
{
    // Mostrar todos los lockers
    public function index()
    {
        $lockers = Locker::all();  // Traemos todos los lockers
        return view('lockers.index', compact('lockers'));
    }

    // Mostrar el formulario de edición del locker
    public function edit($id)
    {
        $locker = Locker::findOrFail($id);  // Buscar el locker por ID
        $users = User::all();  // Obtener todos los usuarios disponibles
        return view('lockers.edit', compact('locker', 'users'));  // Pasar datos a la vista
    }

    // Actualizar el locker
    public function update(Request $request, $id)
    {
        // Validación de los datos
        $request->validate([
            'user_name' => 'nullable|string|max:255',  // Validar el nombre del usuario
            'fecha_inicio_membresia' => 'required|date',
            'fecha_fin_membresia' => 'required|date|after_or_equal:fecha_inicio_membresia',  // Validación de fecha de fin
        ]);

        // Buscar el locker
        $locker = Locker::findOrFail($id);

        // Si el locker tiene un usuario asignado, actualizamos el nombre del usuario
        if ($locker->user && $request->user_name) {
            $user = $locker->user;  // Obtener el usuario asignado
            $user->nombrecompleto = $request->user_name;  // Actualizamos el nombre del usuario
            $user->save();  // Guardamos los cambios
        }

        // Actualizar las fechas del locker
        $locker->fecha_inicio_membresia = $request->fecha_inicio_membresia;
        $locker->fecha_fin_membresia = $request->fecha_fin_membresia;
        $locker->save();  // Guardamos los cambios en el locker

        return redirect()->route('lockers.index')->with('success', 'Locker y nombre del usuario actualizados correctamente.');
    }

    // Mostrar la vista para asignar un locker a un usuario
    public function showAssignLocker($lockerId)
    {
        $locker = Locker::findOrFail($lockerId);
        $users = User::all();  // Traemos todos los usuarios para elegir uno
        return view('lockers.assign', compact('locker', 'users'));
    }

    // Asignar un locker a un usuario
    public function assignLocker(Request $request, $lockerId)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'fecha_inicio_membresia' => 'required|date',
            'fecha_fin_membresia' => 'required|date|after_or_equal:fecha_inicio_membresia',
        ]);

        // Buscar el locker y el usuario
        $locker = Locker::findOrFail($lockerId);
        $user = User::findOrFail($request->user_id);

        // Asignar el locker al usuario
        $locker->user_id = $user->id;
        $locker->is_assigned = true;
        $locker->fecha_inicio_membresia = $request->fecha_inicio_membresia;
        $locker->fecha_fin_membresia = $request->fecha_fin_membresia;
        $locker->save();

        return redirect()->route('lockers.index')->with('success', 'Locker asignado correctamente.');
    }

    // Eliminar la membresía de un locker
    public function removeMembership($lockerId)
    {
        $locker = Locker::findOrFail($lockerId);

        // Liberar el locker
        $locker->user_id = null;
        $locker->is_assigned = false;
        $locker->fecha_inicio_membresia = null;
        $locker->fecha_fin_membresia = null;
        $locker->save();

        return redirect()->route('lockers.index')->with('success', 'Membresía de locker eliminada correctamente.');
    }

    // Mostrar la vista para crear un nuevo locker
    public function create()
    {
        return view('lockers.create');
    }
}

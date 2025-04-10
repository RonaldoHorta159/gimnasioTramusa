<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Locker;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $lockers = Locker::where('is_assigned', false)->get();  // Solo lockers disponibles
        return view('users.create', compact('lockers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nrodocumento' => 'required|unique:users',
            'nombrecompleto' => 'required',
            'fechadenacimiento' => 'required|date',
            'residencia' => 'required',
            'tipo_membresia' => 'required',
            'fecha_inicio_membresia' => 'required|date',
            'fecha_fin_membresia' => 'required|date',
        ]);

        // Crear el usuario
        $user = User::create([
            'nrodocumento' => $request->nrodocumento,
            'nombrecompleto' => $request->nombrecompleto,
            'fechadenacimiento' => $request->fechadenacimiento,
            'residencia' => $request->residencia,
            'tipo_membresia' => $request->tipo_membresia,
            'fecha_inicio_membresia' => $request->fecha_inicio_membresia,
            'fecha_fin_membresia' => $request->fecha_fin_membresia,
        ]);

        // Si se eligió un locker, lo asignamos
        if ($request->locker_id) {
            $locker = Locker::find($request->locker_id);
            if ($locker) {
                $locker->is_assigned = true;
                $locker->user_id = $user->id;  // Asignar el ID del usuario al locker
                $locker->fecha_inicio_membresia = $request->fecha_inicio_membresia;  // Asignar la fecha de inicio de la membresía del locker
                $locker->fecha_fin_membresia = $request->fecha_fin_membresia;  // Asignar la fecha de fin de la membresía del locker
                $locker->save();
            }
        }

        return redirect()->route('users.index')->with('success', 'Usuario registrado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $lockers = Locker::all();
        return view('users.edit', compact('user', 'lockers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'nrodocumento' => 'required|unique:users,nrodocumento,' . $user->id,
            'nombrecompleto' => 'required',
            'fechadenacimiento' => 'required|date',
            'residencia' => 'required',
            'tipo_membresia' => 'required',
            'fecha_inicio_membresia' => 'required|date',
            'fecha_fin_membresia' => 'required|date',
        ]);

        $user->update([
            'nrodocumento' => $request->nrodocumento,
            'nombrecompleto' => $request->nombrecompleto,
            'fechadenacimiento' => $request->fechadenacimiento,
            'residencia' => $request->residencia,
            'tipo_membresia' => $request->tipo_membresia,
            'fecha_inicio_membresia' => $request->fecha_inicio_membresia,
            'fecha_fin_membresia' => $request->fecha_fin_membresia,
            'locker_id' => $request->locker_id,
        ]);

        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Buscar el usuario
        $user = User::findOrFail($id);

        // Si el usuario tiene un locker asignado, liberamos el locker
        if ($user->locker) {
            $locker = $user->locker;
            $locker->is_assigned = false;  // Liberar el locker
            $locker->user_id = null;  // Eliminar la relación con el usuario
            $locker->fecha_inicio_membresia = null;  // Limpiar las fechas de membresía
            $locker->fecha_fin_membresia = null;  // Limpiar las fechas de membresía
            $locker->save();
        }

        // Eliminar el usuario
        $user->delete();

        return redirect()->route('users.index');
    }
}

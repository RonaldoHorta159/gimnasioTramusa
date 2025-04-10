<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LockerController;
use App\Http\Controllers\Auth\LoginController;

Auth::routes();

Route::get('/', function () {
    return view('welcome');
});

Route::resource('users', UserController::class);

Route::resource('lockers', LockerController::class);

Route::delete('lockers/{locker}/remove', [LockerController::class, 'removeMembership'])->name('lockers.remove');

Route::get('lockers/{locker}/assign', [LockerController::class, 'showAssignLocker'])->name('lockers.assign.show');

Route::post('lockers/{locker}/assign', [LockerController::class, 'assignLocker'])->name('lockers.assign');

// Rutas para el login
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);



<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\People\EmployeeController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function (): void {
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('login.store');
});

Route::middleware('auth')->group(function (): void {
    Route::get('/', fn () => view('dashboard'))->name('dashboard');
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
    Route::get('/people', [EmployeeController::class, 'index'])->name('people.index');
    Route::get('/people/employees/create', [EmployeeController::class, 'create'])->name('people.employees.create');
    Route::post('/people/employees', [EmployeeController::class, 'store'])->name('people.employees.store');

    Route::get('/modules/{module}', function (string $module) {
        $modules = config('bems.modules');
        abort_unless(isset($modules[$module]), 404);
        abort_unless(auth()->user()->hasPermissionTo($module.'.view'), 403);

        return view('modules.show', ['module' => $modules[$module]]);
    })->name('modules.show');
});

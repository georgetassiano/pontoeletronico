<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TimesheetController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use Inertia\Inertia;

// Rota principal - redireciona para login se não autenticado
Route::get('/', function () {
    if (auth()->check()) {
        return redirect('/user/dashboard');
    }
    if (auth('admin')->check()) {
        return redirect('/admin/dashboard');
    }
    return redirect('/login');
});

// Rotas de autenticação
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Rotas para usuários (funcionários)
Route::middleware('auth:web')->prefix('user')->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('User/Dashboard', [
            'user' => auth()->user()
        ]);
    })->name('user.dashboard');
    
    Route::post('/timesheet', [TimesheetController::class, 'store']);
    Route::get('/timesheet', [TimesheetController::class, 'getUserTimesheets']);
});

// Rotas para administradores
Route::middleware('auth:admin')->prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        // Estatísticas básicas para o dashboard
        $adminId = auth('admin')->id();
        $stats = [
            'total_users' => \App\Models\User::count(),
            'today_timesheets' => \App\Models\Timesheet::whereDate('created_at', today())->count(),
            'total_employees' => \App\Models\User::where('admin_id', $adminId)->count(),
            'total_timesheets' => \App\Models\Timesheet::count(),
        ];
        
        return Inertia::render('Admin/Dashboard', [
            'admin' => auth('admin')->user(),
            'stats' => $stats
        ]);
    })->name('admin.dashboard');
    
    Route::get('/users', [UserController::class, 'index'])->name('admin.users.index');
    Route::get('/user', [UserController::class, 'getAllUsers']);
    Route::post('/user', [UserController::class, 'store']);
    Route::put('/user/{user}', [UserController::class, 'update']);
    Route::delete('/user/{user}', [UserController::class, 'destroy']);
    Route::get('/cep', [\App\Http\Controllers\CEPController::class, 'getCEP']);
    Route::get('/timesheet', [TimesheetController::class, 'getAllTimesheets']);
    
    Route::get('/timesheets', function () {
        return Inertia::render('Admin/Timesheets', [
            'admin' => Auth::user()
        ]);
    })->name('admin.timesheets');
});

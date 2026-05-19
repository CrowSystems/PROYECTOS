<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Client\ApprovalController;
use App\Http\Controllers\Content\BrandController;
use App\Http\Controllers\Content\MachineController;
use App\Http\Controllers\Content\ProductController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Public\HomeController;
use App\Http\Controllers\Supervisor\ReportController as SupervisorReportController;
use App\Http\Controllers\Supervisor\TechnicianController as SupervisorTechnicianController;
use App\Http\Controllers\Technician\ReportController as TechnicianReportController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Página pública
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('public.home');

/*
|--------------------------------------------------------------------------
| Aprobación del cliente (acceso por token, sin login)
|--------------------------------------------------------------------------
*/
Route::get('/cliente/aprobar/{token}',  [ApprovalController::class, 'show'])->name('client.approval.show');
Route::post('/cliente/aprobar/{token}', [ApprovalController::class, 'approve'])->name('client.approval.approve');

/*
|--------------------------------------------------------------------------
| Auth
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/login',  [LoginController::class, 'showLogin'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // -------- Admin: gestión total de usuarios --------
    Route::middleware('role:'.User::ROLE_ADMIN)->prefix('admin')->name('admin.')->group(function () {
        Route::resource('users', AdminUserController::class)->except(['show']);
    });

    // -------- Editor de contenido (admin + content_editor) --------
    Route::middleware('role:'.User::ROLE_CONTENT_EDITOR)
        ->prefix('contenido')->name('content.')->group(function () {
            Route::resource('brands',   BrandController::class)->except(['show']);
            Route::resource('machines', MachineController::class)->except(['show']);
            Route::resource('products', ProductController::class)->except(['show']);
        });

    // -------- Supervisor de reportes --------
    Route::middleware('role:'.User::ROLE_SUPERVISOR)
        ->prefix('supervisor')->name('supervisor.')->group(function () {
            Route::get('reports',                  [SupervisorReportController::class, 'index'])->name('reports.index');
            Route::get('reports/{report}',         [SupervisorReportController::class, 'show'])->name('reports.show');
            Route::post('reports/{report}/approve',[SupervisorReportController::class, 'approve'])->name('reports.approve');
            Route::post('reports/{report}/reject', [SupervisorReportController::class, 'reject'])->name('reports.reject');

            Route::resource('technicians', SupervisorTechnicianController::class)->except(['show']);
        });

    // -------- Técnico (genera reportes) --------
    Route::middleware('role:'.User::ROLE_TECHNICIAN)
        ->prefix('tecnico')->name('technician.')->group(function () {
            Route::get('reports',                    [TechnicianReportController::class, 'index'])->name('reports.index');
            Route::get('reports/create',             [TechnicianReportController::class, 'create'])->name('reports.create');
            Route::post('reports',                   [TechnicianReportController::class, 'store'])->name('reports.store');
            Route::get('reports/{report}',           [TechnicianReportController::class, 'show'])->name('reports.show');
            Route::post('reports/{report}/signature',[TechnicianReportController::class, 'storeSignature'])->name('reports.signature');
        });
});

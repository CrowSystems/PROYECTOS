<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProgramAdminController;
use App\Http\Controllers\Admin\MessageAdminController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Rutas públicas
|--------------------------------------------------------------------------
*/
Route::get('/',           [HomeController::class, 'index'])->name('home');
Route::get('/nosotros',   [AboutController::class, 'index'])->name('about');
Route::get('/programas',  [ProgramController::class, 'index'])->name('programs.index');
Route::get('/programas/{program:slug}', [ProgramController::class, 'show'])->name('programs.show');

Route::get('/contacto',   [ContactController::class, 'show'])->name('contact');
Route::post('/contacto',  [ContactController::class, 'store'])->name('contact.store');

/*
|--------------------------------------------------------------------------
| Autenticación administrativa
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/admin/login',  [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/admin/login', [LoginController::class, 'login'])->name('login.attempt');
});

Route::post('/admin/logout', [LoginController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

/*
|--------------------------------------------------------------------------
| Panel administrativo
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('programs', ProgramAdminController::class)->except(['show']);

    Route::get('/messages',                [MessageAdminController::class, 'index'])->name('messages.index');
    Route::get('/messages/{message}',      [MessageAdminController::class, 'show'])->name('messages.show');
    Route::delete('/messages/{message}',   [MessageAdminController::class, 'destroy'])->name('messages.destroy');
    Route::patch('/messages/{message}/toggle', [MessageAdminController::class, 'toggleRead'])->name('messages.toggle');
});

<?php
use App\Http\Controllers\TareaController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

# ------------------ Rutas protegidas por autenticación ------------------
Route::middleware(['auth', 'verified'])->group(function () {

    // Dashboard personalizado
    Route::get('/dashboard', [TareaController::class, 'vista'])->name('dashboard');

    // CRUD completo para tareas
    Route::resource('tareas', TareaController::class);

    // Perfil de usuario
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

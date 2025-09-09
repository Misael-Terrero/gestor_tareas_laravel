<?php
use App\Http\Controllers\TareaController;
use App\Models\Tarea;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

# ------------------------------------------------------------
# Rutas para las vistas de tareas
Route::get('/tareas', [TareaController::class, 'index'])->name('tareas.index');

Route::get('/tareas/create', [TareaController::class, 'create'])->name('tareas.create');

Route::post('/tareas', [TareaController::class, 'store'])->name('tareas.store');

Route::get('/tareas/{id}/edit', [TareaController::class, 'edit'])->name('tareas.edit');
Route::put('/tareas/{id}', [TareaController::class, 'update'])->name('tareas.update');
Route::delete('/tareas/{id}', [TareaController::class, 'destroy'])->name('tareas.destroy');



Route::get('/dashboard', function () {
    $tareas = Tarea::latest()->take(5)->get(); // Las 5 tareas más recientes
    return view('dashboard', compact('tareas'));
})->middleware(['auth', 'verified'])->name('dashboard');

# ------------------------------------------------------------


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

<?php

namespace App\Http\Controllers;

use App\Models\Tarea;
use Illuminate\Http\Request;

class TareaController extends Controller
{
    public function vista()
    {
        $tareas = auth()->user()->tareas()->orderByDesc('created_at')->get();
        return view('dashboard', compact('tareas'));
    }

    // 🔍 Listar todas las tareas
    public function index()
    {
        return response()->json(auth()->user()->tareas()->orderByDesc('created_at')->get());
    }

    // 📝 Mostrar el formulario para crear una nueva tarea
    public function create()
    {
        return view('tareas.create');
    }

    // 📝 Mostrar el formulario para editar una tarea existente
    public function edit($id)
    {
        $tarea = auth()->user()->tareas()->findOrFail($id);
        return view('tareas.edit', compact('tarea'));
    }

    //--------------------------------------------------------------

    // 📥 Crear una nueva tarea
    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
        ]);

        auth()->user()->tareas()->create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'completada' => false,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Tarea creada correctamente.'
        ]);
    }

    // 🔎 Mostrar una tarea específica
    public function show($id)
    {
        $tarea = auth()->user()->tareas()->findOrFail($id);
        return response()->json($tarea);
    }

    // ✏️ Actualizar una tarea
    public function update(Request $request, $id)
    {
        $tarea = auth()->user()->tareas()->findOrFail($id);

        $validated = $request->validate([
            'titulo' => 'sometimes|required|string|max:255',
            'descripcion' => 'nullable|string',
            'completada' => 'boolean',
        ]);

        $tarea->update($validated);

        return redirect()->route('dashboard')->with('success', 'Tarea actualizada correctamente.');
    }

    // 🗑️ Eliminar una tarea
    public function destroy($id)
    {
        $tarea = auth()->user()->tareas()->findOrFail($id);
        $tarea->delete();

        return redirect()->route('dashboard')->with('success', 'Tarea eliminada correctamente.');
    }
}

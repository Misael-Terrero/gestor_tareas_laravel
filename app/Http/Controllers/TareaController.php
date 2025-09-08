<?php

namespace App\Http\Controllers;

use App\Models\Tarea;
use Illuminate\Http\Request;

class TareaController extends Controller
{
    public function vista()
    {
        $tareas = Tarea::orderByDesc('created_at')->get();
        return view('dashboard', compact('tareas'));
    }


    // 🔍 Listar todas las tareas
    public function index()
    {
        return response()->json(Tarea::orderByDesc('created_at')->get());
    }

    // 📥 Crear una nueva tarea
    public function store(Request $request)
    {
        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'completada' => 'boolean',
        ]);

        $tarea = Tarea::create($validated);
        return response()->json($tarea, 201);
    }

    // 🔎 Mostrar una tarea específica
    public function show($id)
    {
        $tarea = Tarea::findOrFail($id);
        return response()->json($tarea);
    }

    // ✏️ Actualizar una tarea
    public function update(Request $request, $id)
    {
        $tarea = Tarea::findOrFail($id);

        $validated = $request->validate([
            'titulo' => 'sometimes|required|string|max:255',
            'descripcion' => 'nullable|string',
            'completada' => 'boolean',
        ]);

        $tarea->update($validated);
        return response()->json($tarea);
    }

    // 🗑️ Eliminar una tarea
    public function destroy($id)
    {
        $tarea = Tarea::findOrFail($id);
        $tarea->delete();

        return response()->json(['mensaje' => 'Tarea eliminada correctamente']);
    }
}
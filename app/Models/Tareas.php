<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tarea extends Model
{
    protected $table = 'tareas';

    protected $fillable = [
        'titulo',
        'descripcion',
        'completada',
    ];

    protected $casts = [
        'completada' => 'boolean',
    ];

    // Scope para tareas completadas
    public function scopeCompletadas($query)
    {
        return $query->where('completada', true);
    }

    // Scope para tareas pendientes
    public function scopePendientes($query)
    {
        return $query->where('completada', false);
    }
}
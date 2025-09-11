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
        'user_id', // 👈 necesario para asignar el usuario
    ];

    protected $casts = [
        'completada' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

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
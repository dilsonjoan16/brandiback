<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    use HasFactory;

    protected $fillable = [
        "area_id", "nombre", "estado", "descripcion", "duracion", "UsuarioCreacion", "UsuarioModificacion"
    ];

    public function UsuarioCreador()
    {
        return $this->belongsTo(User::class, 'UsuarioCreacion');
    }

    public function UsuarioModificador()
    {
        return $this->belongsTo(User::class, 'UsuarioModificacion');
    }

    public function AreaDeCurso()
    {
        return $this->belongsTo(AreaCurso::class, 'area_id');
    }

}

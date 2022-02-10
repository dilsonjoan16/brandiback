<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoCurso extends Model
{
    use HasFactory;

    protected $fillable = [
        "modalidad_id", "nombre", "estado", "UsuarioCreacion", "UsuarioModificacion"
    ];

    public function UsuarioCreador()
    {
        return $this->belongsTo(User::class, 'UsuarioCreacion');
    }

    public function UsuarioModificador()
    {
        return $this->belongsTo(User::class, 'UsuarioModificacion');
    }

    public function ModalidadDeCurso()
    {
        return $this->belongsTo(ModalidadCurso::class, 'modalidad_id');
    }

    public function AreaDeCurso()
    {
        return $this->hasMany(AreaCurso::class, 'tipo_id');
    }
}

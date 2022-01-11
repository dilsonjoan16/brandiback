<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AreaCurso extends Model
{
    use HasFactory;

    protected $fillable = [
        "tipo_id", "nombre", "estado", "UsuarioCreacion", "UsuarioModificacion"
    ];

    public function UsuarioCreador()
    {
        return $this->belongsTo(User::class, 'UsuarioCreacion');
    }

    public function UsuarioModificador()
    {
        return $this->belongsTo(User::class, 'UsuarioModificacion');
    }

    public function TipoDeCurso()
    {
        return $this->belongsTo(TipoCurso::class, 'tipo_id');
    }

    public function Curso()
    {
        return $this->hasMany(Curso::class);
    }
}

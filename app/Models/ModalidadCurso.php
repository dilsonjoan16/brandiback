<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModalidadCurso extends Model
{
    use HasFactory;

    protected $fillable = [
        "nombre", "estado", "UsuarioCreacion", "UsuarioModificacion"
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
        return $this->hasMany(TipoCurso::class);
    }
}

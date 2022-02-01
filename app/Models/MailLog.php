<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MailLog extends Model
{
    use HasFactory;

    protected $fillable = [
        "UsuarioCreacion", "asunto"
    ];

    public function UsuarioCreador()
    {
        return $this->belongsTo(User::class, 'UsuarioCreacion');
    }
}

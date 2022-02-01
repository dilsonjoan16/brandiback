<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'rol', 'estado', 'UsuarioCreacion', 'UsuarioModificacion'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function tieneUsuarios()
    {
        return $this->hasMany(User::class);
    }

    public function UsuarioCreador()
    {
        return $this->belongsTo(User::class, 'UsuarioCreacion');
    }

    public function UsuarioModificador()
    {
        return $this->belongsTo(User::class, 'UsuarioModificacion');
    }

    public function tieneModalidadDeCurso()
    {
        return $this->hasMany(ModalidadCurso::class);
    }

    public function tieneTipoDeCurso()
    {
        return $this->hasMany(TipoCurso::class);
    }

    public function tieneAreaDeCurso()
    {
        return $this->hasMany(AreaCurso::class);
    }

    public function tieneCurso()
    {
        return $this->hasMany(Curso::class);
    }

    public function tieneLogs()
    {
        return $this->hasMany(MailLog::class);
    }
}

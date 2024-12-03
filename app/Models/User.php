<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'sobrenome',
        'email',
        'password',
        'identificacao',
        'curso',
        'semestre',
        'profile_photo',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',


        ];
    }

    public function getFilamentName(): string
    {
        return trim("{$this->name} {$this->sobrenome}") ?: 'Usuário Desconhecido';
    }
    public function inscricoes()
    {
        return $this->hasMany(Inscricao::class);
    }


    public function eventos()
    {
        return $this->belongsToMany(Evento::class, 'inscricoes', 'user_id', 'evento_id');
    }

    // public function isAdmin()
    // {
    //     return $this->is_admin; // Verifica se o campo is_admin é true
    // }

    public function getProfilePhotoUrlAttribute()
    {
        return $this->profile_photo ? asset('storage/' . $this->profile_photo) : asset('images/default-profile.png');
    }

}

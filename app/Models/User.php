<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Enumérations\Role;
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
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'theme_id' 
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
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
            'role' => Role::class,
        ];
    }

    public function isEditeur(): bool
    {
        return $this->role === Role::Editeur;
    }

    public function isResponsable(): bool
    {
        return $this->role === Role::Responsable;
    }

    public function isAbonne(): bool
    {
        return $this->role === Role::Abonne;
    }

    public function themes()
    {
        return $this->belongsToMany(Theme::class, 'abonnements');
    }

    public function browsingHistories()
    {
        return $this->hasMany(Historique::class);
    }

    public function theme()
    {
        return $this->belongsTo(Theme::class);
    }
}

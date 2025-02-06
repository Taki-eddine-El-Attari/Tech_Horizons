<?php

namespace App\Models;
use App\Enumérations\Role;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;
 
    // Champs autorisés pour la créeation et la mise à jour
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'theme_id' 
    ];
   
    // Champs cachés pour la créeation et la mise à jour
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Conversion automatique des types de données
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'role' => Role::class,
        ];
    }

    // Vérifie si l'utilisateur est un éditeur
    public function isEditeur(): bool
    {
        return $this->role === Role::Editeur;
    }

    // Vérifie si l'utilisateur est un responsable
    public function isResponsable(): bool
    {
        return $this->role === Role::Responsable;
    }

    // Vérifie si l'utilisateur est un abonné
    public function isAbonne(): bool
    {
        return $this->role === Role::Abonne;
    }

    // Relation many-to-many (n,m) avec les thèmes via la table abonnements
    public function themes()
    {
        return $this->belongsToMany(Theme::class, 'abonnements');
    }

    // Relation one-to-many (1,n) avec l'historique de navigation
    public function browsingHistories()
    {
        return $this->hasMany(Historique::class);
    }

    // Relation one-to-one (1,1) avec le thème de l'utilisateur
    public function theme()
    {
        return $this->belongsTo(Theme::class);
    }
}

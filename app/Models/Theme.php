<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Theme extends Model
{
    // Champs autorisés pour la créeation et la mise à jour
    protected $fillable = [
        'name',
        'slug'
    ];

    // Utilise le slug comme identifiant dans les URLs
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    // Relation one-to-many (1,n) avec les articles
    public function articles(): HasMany
    {
        return $this->hasMany(Article::class);
    }

    // Relation many-to-many (n,m) avec les utilisateurs
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

}

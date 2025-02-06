<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Statut extends Model
{
    // Nom de la table
    protected $table = 'statuts';

    // Champs autorisés pour la créeation et la mise à jour
    protected $fillable = ['name'];

    // Relation one-to-many (1,n) avec les articles
    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    // Utilise le slug comme identifiant dans les URLs
    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}

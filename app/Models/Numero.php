<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Numero extends Model
{
    // Champs autorisés pour la créeation et la mise à jour
    protected $fillable = ['numero'];

    // Relation one-to-many (1,n) avec les articles
    public function articles(): HasMany
    {
        return $this->hasMany(Article::class);
    }
}

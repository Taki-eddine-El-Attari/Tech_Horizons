<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Commentaire extends Model
{
    // Charge automatiquement l'utilisateur associé
    protected $with =['user'];

    // Champs autorisés pour la création et la mise à jour
    protected $fillable = ['contenu','note', 'article_id', 'user_id'];

    // Relation one-to-one (1,1) avec l'auteur
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Relation one-to-one (1,1) avec l'article
    public function article(): BelongsTo
    {
        return $this->belongsTo(Article::class);
    }
}

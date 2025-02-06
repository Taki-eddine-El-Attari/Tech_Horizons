<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Historique extends Model
{
    // Champs autorisés pour la créeation et la mise à jour
    protected $fillable = ['user_id', 'article_id', 'viewed_at'];

    // Conversion automatique des types de données
    protected $casts = [
        'viewed_at' => 'datetime'
    ];

    // Relation one-to-one (1,1) avec l'utilisateur
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Relation one-to-one (1,1) avec l'article consulté
    public function article(): BelongsTo
    {
        return $this->belongsTo(Article::class);
    }

    // Filtre les historiques selon différents critères
    public function scopeFilter($query, array $filters)
    {

    return $query
    // Filtre par recherche textuelle (titre ou contenu)
    ->when($filters['search'] ?? false, function($query, $search) {
        $query->whereHas('article', function($query) use ($search) {
            $query->where('titre', 'like', '%'.$search.'%')
                  ->orWhere('contenu', 'like', '%'.$search.'%');
        });
    })
    // Filtre par thème d'article
    ->when($filters['theme'] ?? false, function($query, $theme) {
        $query->whereHas('article.theme', function($query) use ($theme) {
            $query->where('id', $theme);
        });
    })
    // Filtre par date
    ->when($filters['date'] ?? false, function($query, $date) {
        $query->whereDate('viewed_at', $date);
    });
   }
}

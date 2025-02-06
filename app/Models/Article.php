<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Commentaire;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class Article extends Model
{
    // Champs non modifiables et protégé
    protected $guarded = ['id' , 'created_at', 'updated_at'];

    // Relations chargées automatiquement avec l'article
    protected $with = [
        'theme',
        'statut',
        'numero',
    ];
    
    // Utilise le slug comme identifiant dans les URLs
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    // Filtre les articles selon différents critères
    public function scopeFilters(Builder $query, array $filters): void
    {
        // Filtre par recherche textuelle
        if(isset($filters['search'])){
            $query->where(fn (Builder $query) => $query
            ->where('titre', 'like', '%'.$filters['search'].'%')
            ->orWhereHas('theme', fn (Builder $query) => $query->where('name', 'like', '%'.$filters['search'].'%'))
            ->orWhereHas('numero', fn (Builder $query) => $query->where('numero', 'like', '%'.$filters['search'].'%'))
            ->orWhereHas('statut', fn (Builder $query) => $query->where('name', 'like', '%'.$filters['search'].'%'))
            ->orWhereHas('commentaire', fn (Builder $query) => $query->where('contenu', 'like', '%'.$filters['search'].'%'))
            ->orWhere('contenu', 'like', '%'.$filters['search'].'%')
            );
        }

        // Filtre par thème spécifique
        if(isset($filters['theme'])){
            $query->where('theme_id', $filters['theme']->id ?? $filters['theme']);
        } 

    }

    // Relation one-to-one (1,1) avec le thème associé
    public function theme() : BelongsTo {
        return $this->belongsTo(Theme::class);

    }

    // Relation one-to-one (1,1) avec le numéro de publication associé
    public function numero() : BelongsTo {
        return $this->belongsTo(Numero::class);

    }

    // Relation one-to-one (1,1) avec le statut de l'article
    public function statut(): BelongsTo
    {
        return $this->belongsTo(Statut::class);
    }

    // Relation one-to-many (1,n) avec les commentaires associés
    public function commentaire(): HasMany
    {
        return $this->hasMany(Commentaire::class)->orderByDesc('created_at');
    }

    // Vérifie si l'article existe
    public function exists(): bool
    {
        return (bool) $this->id;
    }

    // Enregistre un nouveau commentaire
    public function addCommentaire(Article $article, Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'commentaire' => ['required', 'string', 'min:2', 'max:255'],
            'rating' => ['nullable', 'integer', 'min:0', 'max:5'], // le rating optionnel
        ]);

        $commentaire = new Commentaire();
        $commentaire->contenu = $validated['commentaire'];
        $commentaire->note = $validated['rating'] ?? 0; 
        $commentaire->article_id = $article->id; 
        $commentaire->user_id = Auth::id();
        $commentaire->save();

        return back()->with('status', 'Commentaire publié !');
    }

    // Calcule la note moyenne
    public function calculateAverageRating()
    {
        $comments = $this->commentaire;
        $sumRatings = $comments->sum('note');
        $totalComments = $comments->count();

        return round($sumRatings / $totalComments,1);
    }

}
 
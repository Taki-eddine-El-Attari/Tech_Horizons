<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Commentaire;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class Article extends Model
{
    use HasFactory;

    protected $guarded = ['id' , 'created_at', 'updated_at'];

    protected $with = [
        'theme',
        'statut',
        'numero',
    ];
    
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function scopeFilters(Builder $query, array $filters): void
    {
        if(isset($filters['search'])){
            $query->where(fn (Builder $query) => $query
            ->where('titre', 'like', '%'.$filters['search'].'%')
            ->orWhere('contenu', 'like', '%'.$filters['search'].'%')
            );
        }

        if(isset($filters['theme'])){
            $query->where('theme_id', $filters['theme']->id ?? $filters['theme']);
        } 

    }

    public function theme() : BelongsTo {
        return $this->belongsTo(Theme::class);

    }

    public function numero() : BelongsTo {
        return $this->belongsTo(Numero::class);

    }

    public function statut(): BelongsTo
    {
        return $this->belongsTo(Statut::class);
    }

    public function commentaire():HasMany
    {
        return $this->hasMany(Commentaire::class)->orderByDesc('created_at');
    }

    public function exists(): bool
    {
        return (bool) $this->id;
    }

    public function commentaires(Article $article, Request $request): RedirectResponse
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

    public function calculateAverageRating()
    {
        // Utiliser la relation directement sans ()
        $comments = $this->commentaire;
        
        if ($comments->isEmpty()) {
            return 0;
        }
        
        $sumRatings = $comments->sum('note');
        $totalComments = $comments->count();
        
        return round($sumRatings / $totalComments, 1);
    }

}

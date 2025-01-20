<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Commentaire;

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

}

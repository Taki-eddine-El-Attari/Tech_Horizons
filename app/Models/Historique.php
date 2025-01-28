<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Historique extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'article_id', 'viewed_at'];

    // Add proper date casting
    protected $casts = [
        'viewed_at' => 'datetime'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function article(): BelongsTo
    {
        return $this->belongsTo(Article::class);
    }

    public function scopeFilter($query, array $filters)
    {

    return $query->when($filters['search'] ?? false, function($query, $search) {
        $query->whereHas('article', function($query) use ($search) {
            $query->where('titre', 'like', '%'.$search.'%')
                  ->orWhere('contenu', 'like', '%'.$search.'%');
        });
    })
    ->when($filters['theme'] ?? false, function($query, $theme) {
        $query->whereHas('article.theme', function($query) use ($theme) {
            $query->where('id', $theme);
        });
    })
    ->when($filters['date'] ?? false, function($query, $date) {
        $query->whereDate('viewed_at', $date);
    });
   }
}

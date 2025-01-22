<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Statut extends Model
{
    use HasFactory;

    protected $table = 'statuts';
    protected $fillable = ['name'];

    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}

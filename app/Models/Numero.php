<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Numero extends Model
{
    protected $fillable = ['numero'];

    public function articles(): HasMany
    {
        return $this->hasMany(Article::class);
    }
}

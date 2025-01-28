<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Abonnements extends Model
{
    protected $table = 'abonnements';
    
    public $timestamps = true;  
    
    protected $fillable = [
        'user_id',
        'theme_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function theme()
    {
        return $this->belongsTo(Theme::class);
    }
}

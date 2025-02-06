<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Abonnements extends Model
{
    // Nom personnalisé de la table
    protected $table = 'abonnements';
    
    // Active les timestamps created_at/updated_at
    public $timestamps = true;  
    
    // Champs autorisés pour la créeation et la mise à jour
    protected $fillable = [
        'user_id',
        'theme_id'
    ];

    // Relation one-to-one (1,1) avec le modèle User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relation one-to-one (1,1) avec le modèle Theme
    public function theme()
    {
        return $this->belongsTo(Theme::class);
    }
}

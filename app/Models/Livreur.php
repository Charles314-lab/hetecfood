<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Livreur extends Model
{
    use HasFactory;
   protected $fillable = ['nom', 'prenom', 'email', 'tel', 'statut'];

    public $timestamps = true;


    public function commandes()
    {
        return $this->hasMany(Commande::class);
    }



    // Si vous souhaitez utiliser des noms de colonnes personnalisés pour les timestamps, vous pouvez les définir comme suit :
    // public const CREATED_AT = 'created_at';
    // public const UPDATED_AT = 'updated_at';
}


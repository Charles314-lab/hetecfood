<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = ['nom', 'prenom', 'email', 'tel', 'adr', 'pwd'];

    public function commandes()
    {
        return $this->hasMany(Commande::class);
    }
    public $timestamps = true; // Utilise les timestamps par défaut (created_at, updated_at)
    // Si vous souhaitez utiliser des noms de colonnes personnalisés pour les timestamps, vous pouvez les définir comme suit :
    // public const CREATED_AT = 'created_at';
    // public const UPDATED_AT = 'updated_at';



}

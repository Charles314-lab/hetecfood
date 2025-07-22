<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommandePub extends Model
{
    use HasFactory;

      protected $table = 'commandepubs';

    public $timestamps = false;

    protected $fillable = [
        'nom', 'prenom', 'plat_id', 'quantite', 'tel',
        'prix_total', 'statut', 'date_commande', 'date_livraison',
        'adr', 'livreur_id', 'vu'
    ];

     public function plat()
    {
        return $this->belongsTo(Plat::class);
    }

    public function livreur()
    {
        return $this->belongsTo(Livreur::class);
    }
}

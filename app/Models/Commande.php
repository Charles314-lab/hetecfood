<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    protected $fillable = [
        'client_id',
        'plat_id',
        'livreur_id',
        'quantite',
        'prix_total',
        'statut',
        'adr_livraison',
        'date_commande',
        'date_livraison',
        'notes',
        'vu'
    ];

    public $timestamps = false;

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function plat()
    {
        return $this->belongsTo(Plat::class);
    }

    public function livreur()
    {
        return $this->belongsTo(Livreur::class);
    }
}

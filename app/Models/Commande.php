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
    'vu',
    'is_public',
    'customer_phone',
    'customer_name'
];


    // Activer les timestamps et utiliser les colonnes personnalisées
    public $timestamps = true;
    const CREATED_AT = 'date_commande';
    const UPDATED_AT = 'date_livraison';



// Ajoutez ces méthodes à votre modèle Commande
public function getClientNameAttribute()
{
    return $this->client_id
        ? ($this->client->nom ?? 'Client supprimé')
        : $this->customer_name;
}

public function getClientPhoneAttribute()
{
    return $this->client_id
        ? ($this->client->tel ?? 'N/A')
        : $this->customer_phone;
}

public function getOriginAttribute()
{
    return $this->is_public ? 'Publique' : 'Admin';
}

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

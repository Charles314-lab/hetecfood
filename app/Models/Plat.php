<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Plat extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'nom',
        'origine',
        'tps_cuisson',
        'prix',
        'image',
        'menu_id',
        'categorie_id'
    ];

    public $timestamps = false;

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

    public function categorie()
    {
        return $this->belongsTo(Categorie::class);
    }

    public function commandes()
    {
        return $this->hasMany(Commande::class);
    }

    public function ingredients()
    {
        return $this->belongsToMany(Ingredient::class, 'ingredient_plat', 'plat_id', 'ingredient_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plat extends Model
{
    use HasFactory;

    public function menu() {
        return $this->belongsTo(Menu::class);
    }

    public function categorie() {
        return $this->belongsTo(Categorie::class);
    }

     public function ingredients() {
        return $this->belongsToMany(Ingredient::class);
    }
}


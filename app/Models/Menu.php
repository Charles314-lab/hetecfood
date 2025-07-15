<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    public function boissons() {
        return $this->hasMany(Boisson::class);
    }

        public function plats() {
        return $this->hasMany(Plat::class);
    }
}

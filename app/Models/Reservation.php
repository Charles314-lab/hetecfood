<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
    'nom', 'email', 'telephone', 'reservation_date',
    'reservation_time', 'nb_personnes', 'message', 'vu'
];
    public $timestamps = false;
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = [
        'nom',
        'email',
        'telephone',
        'nb_personnes',
        'reservation_date',
        'reservation_time',
        'message',
    ];

    public $timestamps = false; // Set to true if you want to use timestamps
}

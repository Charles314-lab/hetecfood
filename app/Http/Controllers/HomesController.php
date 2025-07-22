<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Categorie;
use App\Models\Boisson;
use App\Models\Plat;
use App\Models\Ingredient;


class HomesController extends Controller
{
     public function index () {

    $categories=Categorie::get() ;
   // dd($categories);

    $boissons = Boisson::get();
    //dd($boissons);

    $plats = Plat::get()->map(function ($plat) {
        $imagePath = public_path('assets/img/plats/' . $plat->image);
        $plat->image_url = (isset($plat->image) && file_exists($imagePath)) ? $plat->image : 'logo.jpg';
        return $plat;
    });
    //dd($plats);

    $ingredientsParPlat = [];
    foreach ($plats as $plat) {
        $ingredientsParPlat[$plat->id] = $plat->ingredients->pluck('nom')->toArray();
    }

    $ingredients = Ingredient::get();
    //dd($ingredients);

    return view('index', compact('categories','boissons', 'plats', 'ingredients', 'ingredientsParPlat'));
}

      public function plats () {
        return view ('plats');
    }
}

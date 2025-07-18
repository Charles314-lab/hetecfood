<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Ajout des champs à la table 'livreurs'
    Schema::table('livreurs', function (Blueprint $table) {


        $table->updated_at();


    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Suppression des champs de la table 'livreurs'
    Schema::table('livreurs', function (Blueprint $table) {
        $table->dropColumn(['nom', 'prenom', 'email', 'tel', 'statut']);
    });
}

};

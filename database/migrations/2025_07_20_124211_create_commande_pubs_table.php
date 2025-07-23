<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('commandepubs', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('prenom')->nullable();
            $table->foreignId('plat_id')->constrained('plats');
            $table->integer('quantite');
            $table->string('tel');
            $table->decimal('prix_total', 10, 2);
            $table->text('adr');
            $table->enum('statut', ['en attente', 'en préparation', 'en livraison', 'livrée', 'annulée'])->default('en attente');
            $table->foreignId('livreur_id')->nullable()->constrained('livreurs');
            $table->boolean('vu')->default(false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('commandepubs');
    }
};

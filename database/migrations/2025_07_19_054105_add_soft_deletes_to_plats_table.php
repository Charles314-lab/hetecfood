<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   public function up()
{
    Schema::table('plats', function (Blueprint $table) {
        $table->softDeletes();
        $table->timestamps(); // Si les colonnes n'existent pas
    });
}

};

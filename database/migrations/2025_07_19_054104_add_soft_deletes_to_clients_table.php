<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
public function up()
{
    Schema::table('plats', function (Blueprint $table) {
        $table->softDeletes(); // Ajoute deleted_at
        if (!Schema::hasColumn('plats', 'created_at')) {
            $table->timestamps(); // Ajoute created_at et updated_at si inexistants
        }
    });
}

public function down()
{
    Schema::table('plats', function (Blueprint $table) {
        $table->dropSoftDeletes();
    });
}
};

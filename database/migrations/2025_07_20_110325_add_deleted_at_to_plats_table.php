<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{public function up()
{
    Schema::table('plats', function (Blueprint $table) {
        if (!Schema::hasColumn('plats', 'deleted_at')) {
            $table->softDeletes(); // Ajoute deleted_at
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

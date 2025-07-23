<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('commandes', function (Blueprint $table) {
            $table->boolean('is_public')->default(false)->after('vu');
            $table->string('customer_phone')->nullable()->after('is_public');
            $table->string('customer_name')->nullable()->after('customer_phone');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('commandes', function (Blueprint $table) {
            $table->dropColumn(['is_public', 'customer_phone', 'customer_name']);
        });
    }
};

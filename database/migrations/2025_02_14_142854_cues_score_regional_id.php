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
        Schema::create('cuescore_regional', function (Blueprint $table) {
            //
            $table->bigInteger('handi_fauteuil');
            $table->bigInteger('handi_debout');
            $table->bigInteger('benjamin');
            $table->bigInteger('junior');
            $table->bigInteger('espoirs');
            $table->bigInteger('feminin');
            $table->bigInteger('veteran');
            $table->bigInteger('mixte');
            $table->bigInteger('ligue');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cuescore_regional', function (Blueprint $table) {
            //
        });
    }
};

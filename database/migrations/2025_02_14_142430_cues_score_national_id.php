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
        Schema::create('cuescore_national', function (Blueprint $table) {
            //
            $table->bigInteger('master');
            $table->bigInteger('mixte');
            $table->bigInteger('feminin');
            $table->bigInteger('juniors');
            $table->bigInteger('espoirs');
            $table->bigInteger('veterans');
            $table->bigInteger('handi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cuescore_national', function (Blueprint $table) {
            //
        });
    }
};

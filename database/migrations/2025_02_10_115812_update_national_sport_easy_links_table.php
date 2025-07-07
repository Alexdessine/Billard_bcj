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
        Schema::table('national_sport_easy', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('national_id')->change();
            $table->foreign('national_id')->references('id')->on('calendrier_national')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('national_sport_easy', function (Blueprint $table) {
            //
        });
    }
};

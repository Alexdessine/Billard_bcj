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
        Schema::table('regional_links', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('calendrier_id')->change();
            $table->foreign('calendrier_id')->references('id')->on('calendrier_regional')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('regional_links', function (Blueprint $table) {
            //
        });
    }
};

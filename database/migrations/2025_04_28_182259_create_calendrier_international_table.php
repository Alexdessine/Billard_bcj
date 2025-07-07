<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCalendrierInternationalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calendrier_international', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date_debut')->nullable();
            $table->date('date_fin')->nullable();
            $table->string('titre')->nullable();
            $table->string('lieu')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('calendrier_international');
    }
}

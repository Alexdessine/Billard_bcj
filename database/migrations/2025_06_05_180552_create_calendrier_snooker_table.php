<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCalendrierSnookerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calendrier_snooker', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date_debut')->nullable();
            $table->date('date_fin')->nullable();
            $table->date('date_limite')->nullable();
            $table->string('titre')->nullable();
            $table->string('lieu')->nullable();
            $table->string('club')->nullable();
            $table->string('url')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('calendrier_snooker');
    }
}

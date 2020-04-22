<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePointagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pointages', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('user_id')->unsigned();
            $table->string('user_name');
            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->integer('semaine');
            $table->date('debut');
            $table->date('fin');
            $table->text('chantier_lundi')->nullable(true);
            $table->text('chantier_mardi')->nullable(true);
            $table->text('chantier_mercredi')->nullable(true);
            $table->text('chantier_jeudi')->nullable(true);
            $table->text('chantier_vendredi')->nullable(true);
            $table->time('arrivee_lundi')->nullable(true);
            $table->time('arrivee_mardi')->nullable(true);
            $table->time('arrivee_mercredi')->nullable(true);
            $table->time('arrivee_jeudi')->nullable(true);
            $table->time('arrivee_vendredi')->nullable(true);
            $table->time('depart_lundi')->nullable(true);
            $table->time('depart_mardi')->nullable(true);
            $table->time('depart_mercredi')->nullable(true);
            $table->time('depart_jeudi')->nullable(true);
            $table->time('depart_vendredi')->nullable(true);
            $table->time('repas_lundi')->nullable(true);
            $table->time('repas_mardi')->nullable(true);
            $table->time('repas_mercredi')->nullable(true);
            $table->time('repas_jeudi')->nullable(true);
            $table->time('repas_vendredi')->nullable(true);
            $table->time('trajet_lundi')->nullable(true);
            $table->time('trajet_mardi')->nullable(true);
            $table->time('trajet_mercredi')->nullable(true);
            $table->time('trajet_jeudi')->nullable(true);
            $table->time('trajet_vendredi')->nullable(true);
            $table->time('totalTravail_lundi')->nullable(true);
            $table->time('totalTravail_mardi')->nullable(true);
            $table->time('totalTravail_mercredi')->nullable(true);
            $table->time('totalTravail_jeudi')->nullable(true);
            $table->time('totalTravail_vendredi')->nullable(true);
            $table->text('totalHeure');
            $table->text('observation')->nullable(true);
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
        Schema::dropIfExists('pointages');
    }
}

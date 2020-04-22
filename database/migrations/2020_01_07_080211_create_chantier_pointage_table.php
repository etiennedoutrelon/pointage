<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChantierPointageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chantier_pointage', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('chantier_id')->unsigned();
            $table->integer('pointage_id')->unsigned();
            $table->foreign('chantier_id')->references('id')->on('chantiers')
                ->onDelete('restrict')
                ->onUpdate('restrict');
            $table->foreign('pointage_id')->references('id')->on('pointages')
                ->onDelete('restrict')
                ->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('chantier_pointage', function (Blueprint $table){
            $table->dropForeign('chantier_pointage_chantier_id_foreign');
            $table->dropForeign('chantier_pointage_pointage_id_foreign');
        });
        Schema::dropIfExists('chantier_pointage');
    }
}

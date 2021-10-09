<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTipoVehiculosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipo_vehiculos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('tipo');
            $table->unsignedBigInteger('idVehiculo'); //Relación con vehiculos
            $table->unsignedBigInteger('idConductor');//Relación con conductor
            //claves foraneas
            //$table->foreign('idVehiculo')->references('id')->on('vehiculos');
            //$table->foreign('idConductor')->references('id')->on('conductores');

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
        Schema::dropIfExists('tipo_vehiculos');
    }
}

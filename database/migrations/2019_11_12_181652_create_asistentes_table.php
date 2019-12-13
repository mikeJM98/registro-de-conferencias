<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAsistentesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asistentes', function (Blueprint $table) {
            $table->bigIncrements('id_asistente');
            $table->bigInteger('id_conferencia')->foreign('id_conferencia')->references('id_conferencia')->on('conferencias')->default('1');
            $table->string('dni');
            $table->string('nombre');
            $table->string('apellidos');
            $table->string('correo')->nullable();;
            $table->string('celular')->nullable();
            $table->bigInteger('id_empresa')->foreign('id_empresa')->references('id_empresa')->on('empresas')->default('1');
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
        Schema::dropIfExists('asistentes');
    }
}

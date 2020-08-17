<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->integer('id_documento')->unsigned();
            $table->primary('id_documento');
            
            $table->integer('id_tipo_documento')->nullable();
            $table->foreign('id_tipo_documento')
            ->references('id_tipo_documento')->on('tipo_documentos');
            $table->string('nombres',80)->nullable(); 
            $table->string('apellidos',80)->nullable();
            $table->string('correo',90)->nullable();
            $table->string('direccion',90)->nullable();
            $table->string('telefono', 15)->nullable();
            $table->string('celular', 15)->nullable();
            $table->date('fecha_nacimiento')->nullable();
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
        Schema::dropIfExists('clientes');
    }
}

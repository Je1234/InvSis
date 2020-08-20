<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComprasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compras', function (Blueprint $table) {
            $table->increments('id_compra');
            $table->bigInteger('id_user')->nullable()->unsigned();
            $table->foreign('id_user')->references('id')->on('users')->onDelete('no action')->onUpdate('no action');
            $table->integer('id_proveedor')->nullable();
            $table->foreign('id_proveedor')->references('id_proveedor')->on('proveedores');
            $table->timestampTz('fecha_factura');
            $table->integer('id_metodo_pago')->nullable();
            $table->foreign('id_metodo_pago')->references('id_metodo_pago')->on('metodo_pagos');
            $table->float('precio_total',15,2)->nullable();
            $table->float('subtotal',15,2)->nullable();
            $table->float('pagado',15,2)->nullable();
            $table->integer('descuento')->nullable();
            $table->integer('devuelto')->nullable();
            $table->integer('total_sin_descuento')->nullable();
            $table->integer('iva')->nullable();
            $table->float('valor_iva',15,2)->nullable();
            $table->text('descripcion')->nullable();
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
        Schema::dropIfExists('compras');
    }
}

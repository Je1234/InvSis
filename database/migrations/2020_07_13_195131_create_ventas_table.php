<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVentasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ventas', function (Blueprint $table) {
            $table->BigIncrements('id_venta');
            $table->bigInteger('id_user')->nullable()->unsigned();
            $table->foreign('id_user')->references('id')->on('users')->onDelete('no action')->onUpdate('no action');
            $table->bigInteger('id_documento')->unsigned()->nullable();
            $table->foreign('id_documento')->references('id_documento')->on('clientes');
            $table->timestampTz('fecha_factura');
            $table->integer('id_metodo_pago')->nullable();
            $table->foreign('id_metodo_pago')->references('id_metodo_pago')->on('metodo_pagos');
            $table->float('precio_total',15,2)->nullable();
            $table->float('subtotal',15,2)->nullable();
            $table->float('pagado',15,2)->nullable();
            $table->bigInteger('descuento')->nullable();
            $table->bigInteger('devuelto')->nullable();
            $table->bigInteger('total_sin_descuento')->nullable();
            $table->bigInteger('iva')->nullable();
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
        Schema::table('ventas', function (Blueprint $table) {
            $table->dropPrimary('id_metodo_pago');
        });
        Schema::dropIfExists('ventas');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->integer('id_producto',true)->unsigned();
            $table->integer('id_proveedor')->nullable();
            $table->bigInteger('id_user')->nullable()->unsigned();
            $table->foreign('id_user')->references('id')->on('users')->onDelete('no action')->onUpdate('no action');
            $table->foreign('id_proveedor')->references('id_proveedor')->on('proveedores')->onDelete('no action')->onUpdate('no action');
            $table->integer('id_ubicacion')->nullable();
            $table->foreign('id_ubicacion')->references('id_ubicacion')->on('ubicaciones')->onDelete('no action')->onUpdate('no action');
            $table->integer('id_categoria')->nullable();
            $table->foreign('id_categoria')->references('id_categoria')->on('categorias')->onDelete('no action')->onUpdate('no action');
            $table->string('codigo_de_barras', 80)->nullable();
            $table->string('ruta_imagen')->nullable()->default('default.png');
            $table->string('nombre',80)->nullable();
            $table->string('marca',60)->nullable();
            $table->float('precio_venta',10,2)->nullable();
            $table->float('precio_compra',10,2)->nullable();
            $table->integer('stock')->length(20)->nullable();
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
        Schema::dropIfExists('productos');
    }
}

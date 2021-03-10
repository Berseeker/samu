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
            $table->id();
            $table->string('SKU')->nullable();
            $table->string('nombre');
            $table->longtext('descripcion');
            $table->integer('stock');
            $table->double('precio_unitario');
            $table->string('material')->nullable();
            $table->string('peso_producto')->nullable();
            $table->unsignedBigInteger('tienda_id');
            $table->foreign('tienda_id')->references('id')->on('tiendas');
            $table->unsignedBigInteger('atributo_id');
            $table->foreign('atributo_id')->references('id')->on('atributos_x_producto');
            $table->timestamps();
            $table->softDeletes();
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

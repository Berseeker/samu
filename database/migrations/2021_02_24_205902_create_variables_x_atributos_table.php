<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVariablesXAtributosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('variables_x_atributos', function (Blueprint $table) {
            $table->id();
            $table->string('valor');
            $table->boolean('default_value')->default(FALSE);
            $table->string('plus_minus',2)->nullable();
            $table->double('cargo_extra')->nullable();
            $table->string('modificador_precio')->nullable();
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
        Schema::dropIfExists('variables_x_atributos');
    }
}

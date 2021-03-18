<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaisesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paises', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('alpha_code');
            $table->string('alpha_code_2')->nullable();
            $table->json('callingCodes')->nullable();
            $table->string('capital')->nullable();
            $table->string('region')->nullable();
            $table->json('latlng')->nullable();
            $table->json('monedas');
            $table->longText('bandera')->nullable();
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
        Schema::dropIfExists('paises');
    }
}

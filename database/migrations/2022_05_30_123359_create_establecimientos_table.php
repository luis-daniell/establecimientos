<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstablecimientosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // AL CREAR UNA O MAS TABLA DENTRO DE UNA MOGRACION EVITAMOS EL ERROR DE QUE BUSQUE UNA
        // REFERENCIA QUE NO EXISTE


        Schema::create('categorias', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('slug');

            $table->timestamps();
        });


        Schema::create('establecimientos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->foreignId('categoria_id')->constrained();
            $table->string('imagen_principal');

            $table->string('direccion');
            $table->string('colonia');
            $table->string('lat');
            $table->string('lng');
            $table->string('telefono');
            $table->text('descripcion');
            $table->time('apertura');
            $table->time('cierre');
            $table->uuid('uuid');

            $table->foreignId('user_id')->constrained();


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
        Schema::dropIfExists('establecimientos');
        Schema::dropIfExists('categorias');
    }
}

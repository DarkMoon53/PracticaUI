<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reserva', function (Blueprint $table) {
            $table->id();
            $table->string("fecha",50)->nullable(false);
            $table->string("servicio",50)->nullable(false);
            $table->integer("num_personas")->nullable(false);
            $table->string("estado",15)->nullable(false);
            $table->unsignedBigInteger("id_cliente");
            $table->unsignedBigInteger("id_restaurante");
            $table->foreign("id_cliente")->references("id")->on("cliente");
            $table->foreign("id_restaurante")->references("id")->on("restaurante");
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
        Schema::dropIfExists('reserva');
    }
};

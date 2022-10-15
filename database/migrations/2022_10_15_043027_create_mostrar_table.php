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
        Schema::create('mostrar', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("id_reserva");
            $table->unsignedBigInteger("id_mesa");
            $table->foreign("id_reserva")->references("id")->on("reserva");
            $table->foreign("id_mesa")->references("id")->on("mesa");
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
        Schema::dropIfExists('mostrar');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMeniuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meniu', function (Blueprint $table) {
            $table->id();
            $table->string('pavadinimas');
            $table->unsignedBigInteger('maitinimo_istaigos_id');
            $table->foreign('maitinimo_istaigos_id')->references('id')->on('istaigos')->onDelete('cascade');
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
        Schema::dropIfExists('meniu');
    }
}

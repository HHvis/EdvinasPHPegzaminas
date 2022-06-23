<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateknygosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('knygos', function (Blueprint $table) {
            $table->id();
            $table->string('knygos_pavadinimas');
            $table->float('knygos_kaina');
            $table->string('knygos_aprasymas');
            $table->unsignedBigInteger('kategorija_id');
            $table->foreign('kategorija_id')->references('id')->on('kategorija')->onDelete('cascade');
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
        Schema::dropIfExists('knygos');
    }
}

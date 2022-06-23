<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatekategorijaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kategorija', function (Blueprint $table) {
            $table->id();
            $table->string('pavadinimas');
            $table->unsignedBigInteger('knygu_istaigos_id');
            $table->foreign('knygu_istaigos_id')->references('id')->on('istaigos')->onDelete('cascade');
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
        Schema::dropIfExists('kategorija');
    }
}

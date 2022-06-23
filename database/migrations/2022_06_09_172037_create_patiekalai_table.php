<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatiekalaiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patiekalai', function (Blueprint $table) {
            $table->id();
            $table->string('patiekalo_pavadinimas');
            $table->float('patiekalo_kaina');
            $table->string('patiekalo_aprasymas');
            $table->unsignedBigInteger('meniu_id');
            $table->foreign('meniu_id')->references('id')->on('meniu')->onDelete('cascade');
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
        Schema::dropIfExists('patiekalai');
    }
}

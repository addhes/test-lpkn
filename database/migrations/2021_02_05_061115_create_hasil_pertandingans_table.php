<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHasilPertandingansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hasil_pertandingans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('match_id')->default(0);
            $table->string('arsenal');
            $table->string('point_a');
            $table->string('chelsea');
            $table->string('point_c');
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
        Schema::dropIfExists('hasil_pertandingans');
    }
}

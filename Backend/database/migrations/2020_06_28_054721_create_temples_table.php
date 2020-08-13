<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTemplesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('temples', function (Blueprint $table) {
            $table->id();
            $table->string('temple_name',256);
            $table->string('temple_location',2500);
            $table->string('temple_address',2500);
            $table->string('temple_destrict',50);
            $table->string('temple_des',2500);
            $table->string('img1',256);
            $table->string('img2',256);
            $table->string('img3',256);
            $table->string('img4',256);
            $table->string('img5',256);
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
        Schema::dropIfExists('temples');
    }


}

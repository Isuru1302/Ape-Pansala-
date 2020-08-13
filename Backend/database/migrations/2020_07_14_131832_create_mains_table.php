<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMainsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mains', function (Blueprint $table) {
            $table->id();
            $table->text('img1');
            $table->text('img2');
            $table->text('img3');
            $table->text('img4');
            $table->text('img5');
            $table->Integer('art1');
            $table->Integer('art2');
            $table->Integer('art3');
            $table->Integer('art4');
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
        Schema::dropIfExists('mains');
    }
}

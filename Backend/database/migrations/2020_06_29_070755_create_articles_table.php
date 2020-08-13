<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('article_title',256);
            $table->string('article_title_sinhala',256);
            $table->string('article_content',2500);
            $table->string('article_content_sinhala',2500);
            $table->string('img1',256);
            $table->string('img2',256);
            $table->string('img3',256);
            $table->string('img4',256);
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
        Schema::dropIfExists('articles');
    }
}

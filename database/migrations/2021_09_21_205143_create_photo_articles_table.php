<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhotoArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('photo_articles', function (Blueprint $table) {
            $table->id();
            $table->foreignId("article_id")->constrained()->onDelete("cascade");
            $table->string("slugPhotoArticle")->unique();
            $table->string("path");
            $table->boolean("isCouverture");
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
        Schema::dropIfExists('photo_articles');
    }
}

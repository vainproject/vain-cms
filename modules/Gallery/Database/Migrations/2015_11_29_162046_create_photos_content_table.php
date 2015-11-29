<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhotosContentTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gallery_photos_content', function(Blueprint $table)
        {
            $table->increments('id');

            $table->integer('photo_id')->unsigned();
            $table->string('locale', 2);
            $table->string('title', 50);
            $table->string('keywords');
            $table->string('description');

            $table->timestamps();

            $table->foreign('photo_id')->references('id')->on('gallery_photos')->onDelete('cascade');
            $table->unique(['photo_id', 'locale']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('gallery_photos_content');
    }

}

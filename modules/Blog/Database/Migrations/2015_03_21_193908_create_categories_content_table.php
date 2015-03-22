<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesContentTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_categories_content', function(Blueprint $table)
        {
            $table->increments('id');

            $table->integer('category_id')->unsigned();
            $table->string('locale', 2);

            $table->string('name');

            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('post_categories')->onDelete('cascade');
            $table->unique(['category_id', 'locale']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('post_categories_content');
    }

}

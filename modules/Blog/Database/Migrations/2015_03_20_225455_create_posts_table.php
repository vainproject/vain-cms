<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function(Blueprint $table)
        {
            $table->increments('id');

            $table->integer('user_id')->unsigned();
            $table->string('slug');
            $table->integer('category_id')->unsigned()->nullable();     // mainly nullable for the set-null constraint

            $table->string('role');

            $table->dateTime('published_at')->nullable();
            $table->dateTime('concealed_at')->nullable();

            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('category_id')->references('id')->on('post_categories')->onDelete('set null');
            $table->unique(['slug', 'category_id']);    // eloquent boss power :o
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('posts');
    }

}

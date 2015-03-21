<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsContentTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('posts_content', function(Blueprint $table)
		{
            $table->increments('id');

            $table->integer('post_id')->unsigned();
            $table->string('locale', 2);
            $table->string('title', 50);
            $table->string('keywords');
            $table->string('description');
            $table->text('text');

            $table->timestamps();

            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
            $table->unique(['post_id', 'locale']);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('posts_content');
	}

}

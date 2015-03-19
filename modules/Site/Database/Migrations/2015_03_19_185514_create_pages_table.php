<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pages', function(Blueprint $table)
		{
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('slug')->unique();
            $table->string('role');
            $table->boolean('active');
            $table->dateTime('published_at')->nullable();
            $table->dateTime('concealed_at')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('pages');
	}

}

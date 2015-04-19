<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubscriptionPlansTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('subscription_plans', function(Blueprint $table)
		{
            $table->increments('id');
            $table->string('name');
		    $table->float('amount');
            $table->integer('duration');
            $table->integer('role_id')->unsigned();
            $table->timestamp('valid_from');
            $table->timestamp('valid_to');
            $table->timestamps();

            $table->foreign('role_id')->references('id')->on('roles')->onUpdate('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('subscription_plans');
	}

}

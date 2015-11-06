<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlansTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('premium_plans', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('name');
            $table->float('amount');
            $table->integer('duration');
            $table->integer('role_id')->unsigned();
            $table->timestamp('valid_from')->nullable();
            $table->timestamp('valid_to')->nullable();
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
        Schema::drop('premium_plans');
    }

}

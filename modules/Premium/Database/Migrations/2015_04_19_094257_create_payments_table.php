<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('transaction');
            $table->string('status');
            $table->string('provider');
            $table->float('value');
            $table->string('currency');
            $table->float('amount');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('payments');
    }

}

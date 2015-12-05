<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenuTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu', function(Blueprint $table)
        {
            $table->increments('id');

            $table->integer('type');
            $table->string('target');
            $table->string('parameters');
            $table->boolean('visible');

            // nested set conf
            $table->integer('parent_id')->nullable();
            $table->integer('lft')->nullable();
            $table->integer('rgt')->nullable();
            $table->integer('depth')->nullable();

            // timestamps
            $table->dateTime('published_at')->nullable();
            $table->dateTime('concealed_at')->nullable();

            $table->timestamps();

            $table->unique(['type', 'target', 'parameters']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('menu');
    }

}

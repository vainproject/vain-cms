<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLastMessageToParticipants extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('message_participants', function (Blueprint $table) {

            $table->timestamp('last_message');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('message_participants', function (Blueprint $table) {

            $table->dropColumn('last_message');
        });
    }

}

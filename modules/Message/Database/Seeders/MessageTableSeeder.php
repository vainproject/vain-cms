<?php namespace Modules\Message\Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Modules\Message\Entities\Message;
use Modules\Message\Entities\Participant;
use Modules\Message\Entities\Thread;
use Modules\User\Entities\User;

class MessageTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @throws Exception
     */
    public function run()
    {
        Model::unguard();

        if (!User::whereId(1)->exists())
            throw new Exception("Run user seeds first");

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        $this->call('Modules\Message\Database\Seeders\MessageThreadsTableSeeder');
        $this->call('Modules\Message\Database\Seeders\MessageParticipantsTableSeeder');
        $this->call('Modules\Message\Database\Seeders\MessageMessagesTableSeeder');

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }

}

class MessageThreadsTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('message_threads')->delete();

        /*
         * Thread 1
         */
        Thread::create(['id' => 1, 'subject' => 'Random subject right here',]);

        /**
         * Thread 2
         */
        Thread::create(['subject' => 'I can haz cheezburger',]);
    }
}

class MessageParticipantsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('message_participants')->delete();

        /*
         * Thread 1
         */
        Participant::create([
            'thread_id'    => 1,
            'user_id'      => 2,
            'last_read'    => Carbon::now(),
            'last_message' => new Carbon("last week"),
        ]);

        Participant::create([
            'thread_id'    => 1,
            'user_id'      => 2,
            'last_read'    => Carbon::now(),
            'last_message' => new Carbon("yesterday"),
        ]);

        Participant::create([
            'thread_id'    => 1,
            'user_id'      => 4,
            'last_read'    => Carbon::now(),
            'last_message' => Carbon::now(),
        ]);

        /**
         * Thread 2
         */
        Participant::create([
            'thread_id'    => 2,
            'user_id'      => 2,
            'last_read'    => Carbon::now(),
            'last_message' => new Carbon("last monday"),
        ]);

        Participant::create([
            'thread_id'    => 2,
            'user_id'      => 3,
            'last_read'    => Carbon::now(),
            'last_message' => new Carbon("yesterday"),
        ]);
    }
}

class MessageMessagesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('message_messages')->delete();

        /*
         * Thread 1
         */
        Message::create([
            'thread_id'  => 1,
            'user_id'    => 2,
            'body'       => 'HotS sucks',
            'created_at' => new Carbon("last week"),
        ]);

        Message::create([
            'thread_id'  => 1,
            'user_id'    => 3,
            'body'       => 'Aber derbe',
            'created_at' => new Carbon("yesterday"),
        ]);

        Message::create([
            'thread_id'  => 1,
            'user_id'    => 4,
            'body'       => 'Läuft bei euch :+1:',
            'created_at' => Carbon::now(),
        ]);

        /**
         * Thread 2
         */
        Message::create([
            'thread_id'  => 2,
            'user_id'    => 2,
            'body'       => 'I can haz cheezburger plx',
            'created_at' => new Carbon("last monday"),
        ]);

        Message::create([
            'thread_id'  => 2,
            'user_id'    => 3,
            'body'       => 'Nope, I only haz :hamburger:',
            'created_at' => new Carbon("yesterday"),
        ]);
    }
}

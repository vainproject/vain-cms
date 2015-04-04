<?php namespace Modules\Message\Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Modules\Message\Entities\Message;
use Modules\Message\Entities\Participant;
use Modules\Message\Entities\Thread;
use Modules\User\Entities\User;

class MessageDatabaseSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        $this->call('Modules\Message\Database\Seeders\MessageTableSeeder');

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }

}

class MessageTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('threads')->delete();
        DB::table('messages')->delete();
        DB::table('participants')->delete();

        $user1 = User::skip(1)->first();
        $user2 = User::skip(2)->first();
        $user3 = User::skip(3)->first();

        /*
         * Thread 1
         */
        $thread1 = Thread::create(['subject' => 'Random subject right here']);
        Message::create([
            'thread_id'  => $thread1->id,
            'user_id'    => $user1->id,
            'body'       => 'HotS sucks',
            'created_at' => new Carbon("last week"),
        ]);
        Participant::create([
            'thread_id' => $thread1->id,
            'user_id'   => $user1->id,
            'last_read' => new Carbon
        ]);

        Message::create([
            'thread_id'  => $thread1->id,
            'user_id'    => $user2->id,
            'body'       => 'Aber derbe',
            'created_at' => new Carbon("yesterday"),
        ]);
        Participant::create([
            'thread_id' => $thread1->id,
            'user_id'   => $user2->id,
            'last_read' => new Carbon
        ]);

        Message::create([
            'thread_id'  => $thread1->id,
            'user_id'    => $user3->id,
            'body'       => 'Läuft bei euch :+1:',
            'created_at' => Carbon::now(),
        ]);
        Participant::create([
            'thread_id' => $thread1->id,
            'user_id'   => $user3->id,
            'last_read' => new Carbon
        ]);

        /**
         * Thread 2
         */
        $thread2 = Thread::create(['subject' => 'I can haz cheezburger']);
        Message::create([
            'thread_id'  => $thread2->id,
            'user_id'    => $user1->id,
            'body'       => 'I can haz cheezburger plx',
            'created_at' => new Carbon("last monday"),
        ]);
        Participant::create([
            'thread_id' => $thread2->id,
            'user_id'   => $user1->id,
            'last_read' => new Carbon,
        ]);

        Message::create([
            'thread_id'  => $thread2->id,
            'user_id'    => $user2->id,
            'body'       => 'Nope, I only haz :hamburger:',
            'created_at' => new Carbon("yesterday"),
        ]);
        Participant::create([
            'thread_id' => $thread2->id,
            'user_id'   => $user2->id,
            'last_read' => new Carbon,
        ]);
    }
}

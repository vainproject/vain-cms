<?php namespace Modules\User\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Modules\User\Entities\User;

class UserDatabaseSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        DB::table('users')->delete();

        User::create([
            'id' => 1,
            'name' => 'Test Admin',
            'alias' => 'Admin',
            'email' => 'admin@vain.app',
            'password' => bcrypt('123456'),
            'locale' => 'en'
        ]);

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }

}
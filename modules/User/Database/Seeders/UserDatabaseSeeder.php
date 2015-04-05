<?php namespace Modules\User\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Modules\User\Entities\Permission;
use Modules\User\Entities\Role;
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

        $this->call('Modules\User\Database\Seeders\UserTableSeeder');

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}

class UserTableSeeder extends Seeder {

    public function run()
    {
        DB::table('users')->delete();

        $user = User::create([
            'id' => 1,
            'name' => 'Admin',
            'email' => 'admin@vain.app',
            'password' => bcrypt('123456'),
            'locale' => 'en',
            'birthday_at' => '2000-01-01',
        ]);

        // add user to admin roles
        $adminRoles = Role::where('name', 'administrator')->get();
        $user->saveRoles($adminRoles);

        // add all permissions to admin roles
        $permissions = Permission::all();
        foreach ($adminRoles as $role)
        {
            $role->savePermissions($permissions);
        }
    }
}
<?php namespace Modules\User\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\User\Entities\Permission;
use Modules\User\Entities\Role;

class MandatoryDatabaseSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call('Modules\User\Database\Seeders\PermissionPermissionTableSeeder');
        $this->call('Modules\User\Database\Seeders\RolePermissionTableSeeder');
        $this->call('Modules\User\Database\Seeders\UserPermissionTableSeeder');

        $this->call('Modules\User\Database\Seeders\RoleTableSeeder');
    }

}

class PermissionPermissionTableSeeder extends Seeder {

    public function run()
    {
        // general admin view permission, though the user component
        // delivers permission management we seed it from here
        Permission::where('name', 'app.admin.show')->delete();
        Permission::create([
            'name' => 'app.admin.show',
            'display_name' => 'Show admin panel',
            'description' => 'Permission to generally view the admin control panel.'
        ]);

        Permission::where('name', 'user.permission.show')->delete();
        Permission::create([
            'name' => 'user.permission.show',
            'display_name' => 'Show permission',
            'description' => 'Permission to show a list of or a single permission.'
        ]);

        Permission::where('name', 'user.permission.create')->delete();
        Permission::create([
            'name' => 'user.permission.create',
            'display_name' => 'Create permission',
            'description' => 'Permission to create a new permission.'
        ]);

        Permission::where('name', 'user.permission.edit')->delete();
        Permission::create([
            'name' => 'user.permission.edit',
            'display_name' => 'Edit permission',
            'description' => 'Permission to modify an existing permission.'
        ]);

        Permission::where('name', 'user.permission.destroy')->delete();
        Permission::create([
            'name' => 'user.permission.destroy',
            'display_name' => 'Delete permission',
            'description' => 'Permission to delete an existing permission.'
        ]);
    }
}

class RolePermissionTableSeeder extends Seeder {

    public function run()
    {
        Permission::where('name', 'user.role.show')->delete();
        Permission::create([
            'name' => 'user.role.show',
            'display_name' => 'Show role',
            'description' => 'Permission to show a list of or a single role.'
        ]);

        Permission::where('name', 'user.role.create')->delete();
        Permission::create([
            'name' => 'user.role.create',
            'display_name' => 'Create role',
            'description' => 'Permission to create a new role.'
        ]);

        Permission::where('name', 'user.role.edit')->delete();
        Permission::create([
            'name' => 'user.role.edit',
            'display_name' => 'Edit role',
            'description' => 'Permission to modify an existing role.'
        ]);

        Permission::where('name', 'user.role.destroy')->delete();
        Permission::create([
            'name' => 'user.role.destroy',
            'display_name' => 'Delete role',
            'description' => 'Permission to delete an existing role.'
        ]);
    }
}

class UserPermissionTableSeeder extends Seeder {

    public function run()
    {
        Permission::where('name', 'user.user.show')->delete();
        Permission::create([
            'name' => 'user.user.show',
            'display_name' => 'Show user',
            'description' => 'Permission to show a list of or a single user.'
        ]);

        Permission::where('name', 'user.user.create')->delete();
        Permission::create([
            'name' => 'user.user.create',
            'display_name' => 'Create user',
            'description' => 'Permission to create a new user.'
        ]);

        Permission::where('name', 'user.user.edit')->delete();
        Permission::create([
            'name' => 'user.user.edit',
            'display_name' => 'Edit user',
            'description' => 'Permission to modify an existing user.'
        ]);

        Permission::where('name', 'user.user.destroy')->delete();
        Permission::create([
            'name' => 'user.user.destroy',
            'display_name' => 'Delete user',
            'description' => 'Permission to delete an existing user.'
        ]);
    }
}

class RoleTableSeeder extends Seeder {

    public function run()
    {
        Role::where('name', 'admin')->delete();
        Role::create([
            'name' => 'admin',
            'display_name' => 'Administrator',
            'description' => 'User has full access to everything in the system.'
        ]);

        Role::where('name', 'manager')->delete();
        Role::create([
            'name' => 'manager',
            'display_name' => 'Manager',
            'description' => 'User is able to manage content and community.'
        ]);

        Role::where('name', 'team')->delete();
        Role::create([
            'name' => 'team',
            'display_name' => 'Team',
            'description' => 'User is a member of the staff.'
        ]);

        Role::where('name', 'registered')->delete();
        Role::create([
            'name' => 'registered',
            'display_name' => 'Registered',
            'description' => 'A registered member of the community.'
        ]);

        Role::where('name', 'unconfirmed')->delete();
        Role::create([
            'name' => 'unconfirmed',
            'display_name' => 'Unconfirmed',
            'description' => 'User has registered but did not finish the process yet.'
        ]);
    }
}
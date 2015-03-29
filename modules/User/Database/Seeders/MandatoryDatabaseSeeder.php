<?php namespace Modules\User\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\User\Entities\Permission;

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
    }

}

class PermissionPermissionTableSeeder extends Seeder {

    public function run()
    {
        Permission::where('name', 'user.permission.show')->delete();
        Permission::create([
            'name' => 'user.permission.show',
            'display_name' => 'Show page',
            'description' => 'Permission to show a list of or a single permission.'
        ]);

        Permission::where('name', 'user.permission.create')->delete();
        Permission::create([
            'name' => 'user.permission.create',
            'display_name' => 'Create page',
            'description' => 'Permission to create a new permission.'
        ]);

        Permission::where('name', 'user.permission.edit')->delete();
        Permission::create([
            'name' => 'user.permission.edit',
            'display_name' => 'Edit page',
            'description' => 'Permission to modify an existing permission.'
        ]);

        Permission::where('name', 'user.permission.destroy')->delete();
        Permission::create([
            'name' => 'user.permission.destroy',
            'display_name' => 'Delete page',
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
            'display_name' => 'Show page',
            'description' => 'Permission to show a list of or a single role.'
        ]);

        Permission::where('name', 'user.role.create')->delete();
        Permission::create([
            'name' => 'user.role.create',
            'display_name' => 'Create page',
            'description' => 'Permission to create a new role.'
        ]);

        Permission::where('name', 'user.role.edit')->delete();
        Permission::create([
            'name' => 'user.role.edit',
            'display_name' => 'Edit page',
            'description' => 'Permission to modify an existing role.'
        ]);

        Permission::where('name', 'user.role.destroy')->delete();
        Permission::create([
            'name' => 'user.role.destroy',
            'display_name' => 'Delete page',
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
            'display_name' => 'Show page',
            'description' => 'Permission to show a list of or a single user.'
        ]);

        Permission::where('name', 'user.user.create')->delete();
        Permission::create([
            'name' => 'user.user.create',
            'display_name' => 'Create page',
            'description' => 'Permission to create a new user.'
        ]);

        Permission::where('name', 'user.user.edit')->delete();
        Permission::create([
            'name' => 'user.user.edit',
            'display_name' => 'Edit page',
            'description' => 'Permission to modify an existing user.'
        ]);

        Permission::where('name', 'user.user.destroy')->delete();
        Permission::create([
            'name' => 'user.user.destroy',
            'display_name' => 'Delete page',
            'description' => 'Permission to delete an existing user.'
        ]);
    }
}
<?php

namespace Modules\Menu\Database\Seeders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Modules\User\Entities\Permission;

class MandatoryDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        Permission::where('name', 'LIKE', 'menu.item.%')->delete();

        Permission::create([
            'name'         => 'menu.item.show',
            'display_name' => 'Show menu',
            'description'  => 'Permission to access the menu component.',
        ]);

        Permission::create([
            'name'         => 'menu.item.create',
            'display_name' => 'Create menu item',
            'description'  => 'Permission to create a new menu item.',
        ]);

        Permission::create([
            'name'         => 'menu.item.edit',
            'display_name' => 'Edit menu item',
            'description'  => 'Permission to modify an existing menu item.',
        ]);

        Permission::create([
            'name'         => 'menu.item.destroy',
            'display_name' => 'Delete menu item',
            'description'  => 'Permission to delete an existing menu item.',
        ]);
    }
}

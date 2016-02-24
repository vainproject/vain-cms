<?php

namespace Modules\Gallery\Database\Seeders;

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

        $this->call('Modules\Gallery\Database\Seeders\CategoryPermissionTableSeeder');
    }
}

class CategoryPermissionTableSeeder extends Seeder
{
    public function run()
    {
        Permission::where('name', 'LIKE', 'gallery.category.%')->delete();

        Permission::create([
            'name'         => 'gallery.category.show',
            'display_name' => 'Show gallery category',
            'description'  => 'Permission to show a list of or a single category.',
        ]);

        Permission::create([
            'name'         => 'gallery.category.create',
            'display_name' => 'Create gallery category',
            'description'  => 'Permission to create a new category.',
        ]);

        Permission::create([
            'name'         => 'gallery.category.edit',
            'display_name' => 'Edit gallery category',
            'description'  => 'Permission to modify an existing category.',
        ]);

        Permission::create([
            'name'         => 'gallery.category.destroy',
            'display_name' => 'Delete gallery category',
            'description'  => 'Permission to delete an existing category.',
        ]);
    }
}

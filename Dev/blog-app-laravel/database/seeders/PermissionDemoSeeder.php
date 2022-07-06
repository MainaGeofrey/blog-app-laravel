<?php

namespace Database\Seeders;


use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\PermissionRegistrar;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class PermissionDemoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //reset cached roles and permissions

        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        Permission::create(['name' => 'create-blog']);
        Permission::create(['name' => 'read-blog']);
        Permission::create(['name' => 'update-blog']);
        Permission::create(['name' => 'delete-blog']);

        Permission::create(['name' => 'create-user']);
        Permission::create(['name' => 'read-user']);
        Permission::create(['name' => 'update-user']);
        Permission::create(['name' => 'delete-user']);

        Permission::create(['name' => 'create-comment']);
        Permission::create(['name' => 'read-comment']);

        $roleAdmin = Role::create(['name' => 'admin']);
        $roleEditor = Role::create(['name' => 'editor']);
        $roleUser = Role::create(['name' => 'user']);


        $roleAdmin->givePermissionTo(Permission::all());
        $roleEditor->givePermissionTo(['create-blog','read-blog', 'update-blog', 'delete-blog', 'read-comment']);
        $roleUser->givePermissionTo(['read-blog', 'create-comment']);

        $user = User::find(1);
        $user->assignRole('admin');

        $user = User::find(2);
        $user->assignRole('editor');

        $user = User::find(3);
        $user->assignRole('user');

    }
}

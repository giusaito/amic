<?php

use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role1 = Role::create(['name' => 'admin']);

        $user = Factory(App\User::class)->create([
            'name' => 'Editor',
            'email' => 'edt@bewweb.com.br',
            'password' => Hash::make('admin5151'),
        ]);
        $user2 = Factory(App\User::class)->create([
            'name' => 'ADMIN',
            'email' => 'oi@bewweb.com.br',
            'password' => Hash::make('admin5151'),
        ]);
        $user2->assignRole($role1);
    }
}

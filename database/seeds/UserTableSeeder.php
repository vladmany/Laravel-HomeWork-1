<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_user = Role::where('name', 'User')->first();
        $user = new User();
        $user->name = 'Vladislav';
        $user->email = 'vdasdasd@gmail.com';
        $user->password = 'dsagsdgfw3r32resf53432edafd';
        $user->save();
        $user->roles()->attach($role_user);

        $role_admin = Role::where('name', 'Admin')->first();
        $admin = new User();
        $admin->name = 'Administrator';
        $admin->email = 'admin@gmail.com';
        $admin->password = '23423rsfwet3reqwasdadqee1q2eqdadsfDASDQ@reqerd';
        $admin->save();
        $admin->roles()->attach($role_admin);
    }
}

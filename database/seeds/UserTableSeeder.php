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
        $user = new User();
        $user->name = 'qwerty';
        $user->email = 'vladmany2000@gmail.com';
        $user->role_id = 1;
        $user->password = '$2y$10$lnRZEJj8bmMiOHLAb78l7elY4ubk9k67XgxP5kqXGZBrteV3WO2lq';

        $user->save();

        $admin = new User();
        $admin->name = 'admin';
        $admin->email = 'vladmany99999@gmail.com';
        $admin->role_id = 2;
        $admin->password = '$2y$10$lnRZEJj8bmMiOHLAb78l7elY4ubk9k67XgxP5kqXGZBrteV3WO2lq';

        $admin->save();
    }
}

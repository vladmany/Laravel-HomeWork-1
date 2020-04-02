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
        foreach (Role::all() as $role) {
            factory(User::class, 1)->create([
                'role_id' => $role->id
            ]);
        }
    }
}

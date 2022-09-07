<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $admin = User::create(
        //     [
        //         'id' => 1,
        //         'name' => 'Admin',
        //         'email' => 'admin@gmail.com',
        //         'password' => bcrypt(1),
        //     ]
        // );

        // $user = User::create(
        //     [
        //         'id' => 2,
        //         'name' => 'Student',
        //         'email' => 'student@gmail.com',
        //         'password' => bcrypt(1),
        //     ]
        // );

        // $user->givePermissionTo(['list']);
        // $admin->givePermissionTo(['update', 'delete', 'list', 'create']);
    }
}

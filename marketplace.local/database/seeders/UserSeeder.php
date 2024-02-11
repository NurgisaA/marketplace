<?php

namespace Database\Seeders;

use App\Constants\UserRoles;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        $user = User::query();

        $user->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('admin'),
            'role' => UserRoles::ADMIN->value
        ]);


        $user->create([
            'name' => 'Moderator',
            'email' => 'moderator@example.com',
            'password' => bcrypt('moderator'),
            'role' => UserRoles::MODERATOR->value
        ]);


        $user->create([
            'name' => 'User',
            'email' => 'user@example.com',
            'password' => bcrypt('user'),
            'role' => UserRoles::USER->value
        ]);


    }
}

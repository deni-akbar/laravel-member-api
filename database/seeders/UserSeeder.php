<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        $user = User::create([
            'name' => 'user1',
            'email' => 'user1@example.com',
            'password' => Hash::make('password123'),
        ]);

        $user->hobbies()->createMany([
            ['name' => 'Reading'],
            ['name' => 'Gaming'],
            ['name' => 'Coding'],
        ]);

        // User::factory()->count(5)->create()->each(function ($u) {
        //     $u->hobbies()->createMany([
        //         ['name' => 'Hiking'],
        //         ['name' => 'Music'],
        //     ]);
        // });
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $users = [
            [
                'name' => 'user1',
                'email' =>  'user1@gmail.com',
                'password' => Hash::make('12345678'),
                'email_verified_at' => now(),
            ],
            [
                'name' => 'user2',
                'email' =>  'user2@gmail.com',
                'password' => Hash::make('12345678'),
                'email_verified_at' => now(),
            ],
            [
                'name' => 'user3',
                'email' =>  'user3@gmail.com',
                'password' => Hash::make('12345678'),
                'email_verified_at' => now(),
            ],
            [
                'name' => 'user4',
                'email' =>  'user4@gmail.com',
                'password' => Hash::make('12345678'),
                'email_verified_at' => now(),
            ],
            [
                'name' => 'user5',
                'email' =>  'user5@gmail.com',
                'password' => Hash::make('12345678'),
                'email_verified_at' => now(),
            ],
        ];

        foreach ($users as $key => $user){
                 User::create($user);       
        }
    }
}

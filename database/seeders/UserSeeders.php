<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeders extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::insert([
            [
                'name'=>'Admin',
                'email'=>'admin@gmail.com',
                'is_admin'=>'admin',
                'password'=>Hash::make('123456'),
            ],
<<<<<<< Updated upstream
            // [
            //     'name'=>'User',
            //     'email'=>'user@gmail.com',
            //     'is_admin'=>'user',
            //     'password'=>Hash::make('123456'),
            // ],
=======
            [
                'name'=>'User',
                'email'=>'user@gmail.com',
                'is_admin'=>'user',
                'password'=>Hash::make('123456'),
            ],
>>>>>>> Stashed changes
        ]);
    }
}

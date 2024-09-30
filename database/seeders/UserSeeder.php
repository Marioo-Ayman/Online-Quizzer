<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
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
                'phone'=>'01550668031',
                'password'=>Hash::make('123456'),
            ],

        ]);

}
}

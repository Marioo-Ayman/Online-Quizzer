<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users=[
            [
            'name'=>'Admin',
            'email'=>'admin@gmail.com',
            'role'=>'admin',
            'phone'=>'01550668031',
            'password'=>Hash::make('12345678'),
            ],
            [ 
                'name'=>'student1',
                'email'=>'student1@gmail.com',
                'role'=>'user',
                'phone'=>'01550888031',
                'password'=>Hash::make('12345678'),
            ],
            [ 
                'name'=>'student2',
                'email'=>'student2@gmail.com',
                'role'=>'user',
                'phone'=>'01550888031',
                'password'=>Hash::make('12345678'),
            ],
            ];

        User::insert($users);
        
        $exams=
        [
            [],[],[]
        ];

     
    }
}

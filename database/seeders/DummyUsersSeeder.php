<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DummyUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userData = [
            
            [
            'name'=> 'Indah Elisa Sihombing',
            'email'=>'iss22041@del.ac.id',
            'role'=>'user',
            'password'=>Hash::make('22041'),
            ],
            [
            'name'=> 'Chandro Pardede',
            'email'=>'chandro.pardede@del.ac.id',
            'role'=>'user',
            'password'=>Hash::make('dosen'),
            ],
            [
            'name'=> 'Staff',
            'email'=>'staff@del.ac.id',
            'role'=>'user',
            'password'=>Hash::make('staff'),
            ]
        ];

        foreach ($userData as $user) {
            User::create($user);

        }
    }
}

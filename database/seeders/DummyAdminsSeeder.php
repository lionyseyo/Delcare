<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DummyAdminsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminData = [
            [
            'name'=> 'Duktek',
            'email'=>'duktek@del.ac.id',
            'role'=>'duktek',
            'password'=>Hash::make('duktek'),
            ],
            [
            'name'=> 'Maintenance',
            'email'=>'maintenance@del.ac.id',
            'role'=>'maintenance',
            'password'=>Hash::make('main'),
            ],


        ];

        foreach($adminData as $key => $admin){
            Admin::create($admin);

        }
    }
}

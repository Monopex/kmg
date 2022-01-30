<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'admin_1',
            'email' => 'admin_1',
            'powers' => ['save', 'remove', 'read'],
            'password' => Hash::make('123'),
        ]);
        User::create([
            'name' => 'admin_2',
            'email' => 'admin_2',
            'powers' => ['read'],
            'password' => Hash::make('123'),
        ]);
        User::create([
            'name' => 'admin_3',
            'email' => 'admin_3',
            'powers' => ['save', 'read'],
            'password' => Hash::make('123'),
        ]);
        User::create([
            'name' => 'admin_4',
            'email' => 'admin_4',
            'powers' => ['remove', 'read'],
            'password' => Hash::make('123'),
        ]);
    }
}

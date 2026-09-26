<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        User::create([
            'name'     => 'Administrator',
            'username' => 'admin',
            'password' => bcrypt('123456'),
            'role' => 'Admin',
        ]);

        User::create([
            'name'     => 'Operators',
            'username' => 'operator',
            'password' => bcrypt('123456'),
            'role' => 'Operator',
        ]);
    }
}

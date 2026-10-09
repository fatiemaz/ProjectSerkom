<?php

// namespace Database\Seeders;
// use App\Models\User;
// use Illuminate\Database\Seeder;
// use Illuminate\Support\Facades\Hash;
// use Illuminate\Support\Str;

// class DatabaseSeeder extends Seeder
// {
//     /**
//      * Seed the application's database.
//      */
//     public function run(): void
//     {
//         User::create([
//             'id_user'    => (string) Str::uuid(),
//             'name'       => 'Administrator',
//             'username'   => 'admin',
//             'password'   => Hash::make('123456'),
//             'role'       => 'Admin',
//             'status'     => 'Aktif',
//             'created_at' => now(),
//             'updated_at' => now(),
//         ]);
//     }
// }



namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('user')->insert([
            [
                'id_user' => '11111111-1111-1111-1111-111111111111',
                'name' => 'Administrator',
                'username' => 'admin',
                'password' => Hash::make('password123'),
                'role' => 'Admin',
                'status' => 'Aktif',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_user' => '22222222-2222-2222-2222-222222222222',
                'name' => 'Operator Sekolah',
                'username' => 'operator',
                'password' => Hash::make('password123'),
                'role' => 'Operator',
                'status' => 'Aktif',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

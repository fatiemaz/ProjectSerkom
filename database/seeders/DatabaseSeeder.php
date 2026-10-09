<?php

// namespace Database\Seeders;

// use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
// use Illuminate\Database\Seeder;

// class DatabaseSeeder extends Seeder
// {
//     use WithoutModelEvents;

//     public function run(): void
//     {
//         User::create([
//             'name'     => 'Administrator',
//             'username' => 'admin',
//             'password' => bcrypt('123456'),
//             'role' => 'Admin',
//         ]);

//         User::create([
//             'name'     => 'Operators',
//             'username' => 'operator',
//             'password' => bcrypt('123456'),
//             'role' => 'Operator',
//         ]);
//     }
// }

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\UserSeeder; // <-- Tambahkan baris ini

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            ProfileUserSeeder::class,
            ProfileSeeder::class,
            GuruSeeder::class,
            SiswaSeeder::class,
            BeritaSeeder::class,
            PengumumanSeeder::class,
            GaleriSeeder::class,
            EkstrakurikulerSeeder::class,
            PrestasiSeeder::class,
        ]);
    }
}

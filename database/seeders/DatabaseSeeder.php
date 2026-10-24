<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // firstOrCreate mencegah error email duplikat saat db:seed dijalankan ulang.
        User::firstOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test User',
                'password' => Hash::make('password'),
            ]
        );

        // Seeder dijalankan berurutan: 10 data tetap, lalu 25 data acak.
        $this->call([
            ProjectTableSeeder::class,
            RandomProjectSeeder::class,
        ]);
    } 
}

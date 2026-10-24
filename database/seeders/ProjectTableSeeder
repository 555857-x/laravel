<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;

class ProjectTableSeeder extends Seeder
{
    /**
     * Mengisi 10 project contoh.
     */
    public function run(): void
    {
        // Kosongkan tabel dulu agar data tidak dobel saat seeder dijalankan ulang.
        Project::truncate();

        for ($i = 1; $i <= 10; $i++) {
            Project::create([
                'title' => 'Project Judul Ke-' . $i,
                'description' => 'Deskripsi untuk project judul ke-' . $i,
                'status' => $i % 2 === 0 ? 'published' : 'draft',
                'started_at' => now()->subDays($i * 7),
                'budget' => $i * 250000,
            ]); 
        }
    }
}

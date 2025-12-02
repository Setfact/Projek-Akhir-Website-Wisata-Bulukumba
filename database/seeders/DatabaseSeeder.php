<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Destination;
use App\Models\Hotel;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Buat User Admin
        User::create([
            'name' => 'Admin Dinas',
            'email' => 'admin@bulukumba.go.id',
            'password' => bcrypt('password'),
            // Pastikan tambah kolom role di migration users jika belum, atau gunakan logika admin panel filament
        ]);

        // 2. Data Destinasi
        $destinasi = [
            ['name' => 'Pantai Bara', 'price' => 15000, 'location' => 'Bira'],
            ['name' => 'Tebing Apparallang', 'price' => 20000, 'location' => 'Ara'],
            ['name' => 'Bukit Donggia', 'price' => 10000, 'location' => 'Kahayya'],
            ['name' => 'Pantai Mandalaria', 'price' => 10000, 'location' => 'Lembanna'],
            ['name' => 'Pulau Kambing', 'price' => 50000, 'location' => 'Bira'],
            ['name' => 'Pantai Bira', 'price' => 20000, 'location' => 'Bira'],
        ];

        foreach ($destinasi as $d) {
            Destination::create([
                'name' => $d['name'],
                'slug' => Str::slug($d['name']),
                'description' => 'Nikmati keindahan alam ' . $d['name'] . ' yang mempesona di Bulukumba.',
                'location' => $d['location'],
                'price' => $d['price'],
                'image_url' => 'https://via.placeholder.com/640x480.png/0066cc?text=' . str_replace(' ', '+', $d['name']), // Gambar dummy
                'promoted' => true,
            ]);
        }
        
        // Silahkan tambahkan logic serupa untuk Hotel...
    }
}

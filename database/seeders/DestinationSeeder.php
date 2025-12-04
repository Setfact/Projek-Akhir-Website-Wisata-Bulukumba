<?php

namespace Database\Seeders;

use App\Models\Destination;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DestinationSeeder extends Seeder
{
    public function run(): void
    {
        $destinations = [
            [
                'name' => 'Pantai Bara',
                'location' => 'Bira',
                'price' => 15000,
                'image_url' => 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80',
                'description' => 'Pantai Bara dikenal sebagai saudara kembar Pantai Bira namun dengan suasana yang lebih tenang dan privat. Pasir putihnya yang lembut dan air laut yang jernih menjadikannya tempat sempurna untuk bersantai.',
            ],
            [
                'name' => 'Tebing Apparallang',
                'location' => 'Ara',
                'price' => 20000,
                'image_url' => 'https://images.unsplash.com/photo-1518509562904-e7ef99cdcc86?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80',
                'description' => 'Tebing karang memanjang yang menghadap langsung ke laut lepas. Air laut di bawahnya berwarna biru tosca yang memukau. Cocok untuk pecinta fotografi dan adrenalin.',
            ],
            [
                'name' => 'Bukit Donggia',
                'location' => 'Kahayya',
                'price' => 10000,
                'image_url' => 'https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80',
                'description' => 'Menawarkan pemandangan perbukitan hijau dari ketinggian. Udara sejuk dan panorama alam yang asri membuat Bukit Donggia menjadi destinasi favorit untuk camping.',
            ],
            [
                'name' => 'Pantai Mandalaria',
                'location' => 'Lembanna',
                'price' => 10000,
                'image_url' => 'https://images.unsplash.com/photo-1590523277543-a94d2e4eb00b?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80',
                'description' => 'Pantai dengan hamparan pasir putih yang luas dan air laut yang tenang. Sangat cocok untuk berenang dan bermain air bersama keluarga.',
            ],
            [
                'name' => 'Pulau Kambing',
                'location' => 'Bira',
                'price' => 50000,
                'image_url' => 'https://images.unsplash.com/photo-1544551763-46a013bb70d5?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80',
                'description' => 'Surga bagi para penyelam dan pecinta snorkeling. Terumbu karang yang masih alami dan ikan-ikan hias yang beragam dapat ditemukan di sini.',
            ],
            [
                'name' => 'Pantai Bira',
                'location' => 'Bira',
                'price' => 20000,
                'image_url' => 'https://images.unsplash.com/photo-1596423736768-4545b7294436?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80',
                'description' => 'Ikon wisata Bulukumba dengan pasir putih sehalus tepung. Fasilitas lengkap mulai dari penginapan, restoran, hingga penyewaan alat snorkeling tersedia di sini.',
            ],
        ];

        foreach ($destinations as $d) {
            Destination::create([
                'name' => $d['name'],
                'slug' => Str::slug($d['name']),
                'description' => $d['description'],
                'location' => $d['location'],
                'price' => $d['price'],
                'image_url' => $d['image_url'],
                'promoted' => true,
                'map_url' => 'https://maps.google.com/?q=' . urlencode($d['name'] . ' ' . $d['location']),
            ]);
        }
    }
}

<?php

namespace Database\Seeders;

use App\Models\Hotel;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class HotelSeeder extends Seeder
{
    public function run(): void
    {
        $hotels = [
            [
                'name' => 'Akasha Beach Club',
                'location' => 'Ara',
                'price_per_night' => 200000,
                'image_url' => 'https://images.unsplash.com/photo-1520250497591-112f2f40a3f4?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80',
            ],
            [
                'name' => 'Bara Beach Bungalows',
                'location' => 'Bara',
                'price_per_night' => 3800000,
                'image_url' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80',
            ],
            [
                'name' => 'Phinisi Hostel Bira',
                'location' => 'Pantai Tanjung Bira',
                'price_per_night' => 200000,
                'image_url' => 'https://images.unsplash.com/photo-1555854743-e3c2f6a58e63?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80',
            ],
            [
                'name' => 'Cosmos Bungalows',
                'location' => 'Pantai Tanjung Bira',
                'price_per_night' => 500000,
                'image_url' => 'https://images.unsplash.com/photo-1582719508461-905c673771fd?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80',
            ],
            [
                'name' => 'SAME Resort Bira Beach',
                'location' => 'Tanjung Bira',
                'price_per_night' => 800000,
                'image_url' => 'https://images.unsplash.com/photo-1563911302283-d2bc129e7c1f?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80',
            ],
            [
                'name' => 'Padduppa',
                'location' => 'Pantai Tanjung Bira',
                'price_per_night' => 2981683,
                'image_url' => 'https://images.unsplash.com/photo-1571896349842-6e5a513e610a?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80',
            ],
        ];

        foreach ($hotels as $h) {
            Hotel::create([
                'name' => $h['name'],
                'slug' => Str::slug($h['name']),
                'description' => 'Penginapan nyaman di ' . $h['location'] . ' dengan fasilitas lengkap dan pemandangan indah.',
                'location' => $h['location'],
                'price_per_night' => $h['price_per_night'],
                'image_url' => $h['image_url'],
                'facilities' => 'WiFi, AC, Sarapan, Parkir, Kolam Renang',
                'map_url' => 'https://maps.google.com/?q=' . urlencode($h['name'] . ' ' . $h['location']),
            ]);
        }
    }
}

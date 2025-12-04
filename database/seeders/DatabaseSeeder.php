<?php

namespace Database\Seeders;

use App\Models\User;
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
            'role' => 'admin',
        ]);

        // 2. Data Destinasi
        $this->call(DestinationSeeder::class);
        
        // 3. Data Hotel
        $this->call(HotelSeeder::class);
    }
}

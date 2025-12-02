<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory;

    // Kita daftarkan kolom apa saja yang boleh diisi
    protected $fillable = [
        'name',
        'slug',
        'description',
        'location',
        'price_per_night',
        'image_url',
    ];
}
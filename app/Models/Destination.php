<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany; // Pakai HasMany

class Destination extends Model
{
    protected $fillable = ['name', 'slug', 'description', 'location', 'price', 'image_url', 'promoted'];

    // Gunakan hasMany karena di tabel reviews kita pakai 'destination_id'
    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class)->latest();
    }
}
<?php

namespace App\Http\Controllers;

// --- PERBAIKAN: TAMBAHKAN BARIS INI ---
use App\Models\Hotel; 
// --------------------------------------

use Illuminate\Http\Request;

class HotelController extends Controller
{
    public function index()
    {
        // Sekarang Laravel sudah kenal siapa itu 'Hotel'
        $hotels = Hotel::latest()->get();
        return view('hotels.index', compact('hotels'));
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use App\Models\Destination;
use App\Models\Hotel;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $destinations = Destination::where('promoted', true)->take(6)->get();
        if ($destinations->isEmpty()) {
            $destinations = Destination::latest()->take(6)->get();
        }
        
        $hotels = Hotel::latest()->take(3)->get();
        $articles = Artikel::latest()->take(3)->get();

        return view('welcome', compact('destinations', 'hotels', 'articles'));
    }

    public function destinations()
    {
        $destinations = Destination::latest()->paginate(9);
        return view('destinations.index', compact('destinations'));
    }

    public function destinationDetail($slug)
    {
        $destination = Destination::where('slug', $slug)->with('reviews.user')->firstOrFail();
        return view('destinations.show', compact('destination'));
    }

    public function accommodations()
    {
        $hotels = Hotel::latest()->paginate(9);
        return view('accommodations.index', compact('hotels'));
    }

    public function accommodationDetail($slug)
    {
        $hotel = Hotel::where('slug', $slug)->firstOrFail();
        return view('accommodations.show', compact('hotel'));
    }

    public function blogs()
    {
        $articles = Artikel::latest()->paginate(9);
        return view('blogs.index', compact('articles'));
    }

    public function blogDetail($slug)
    {
        $article = Artikel::where('slug', $slug)->with('user')->firstOrFail();
        return view('blogs.show', compact('article'));
    }
}

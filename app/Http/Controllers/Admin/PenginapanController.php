<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hotel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class PenginapanController extends Controller
{
    public function index()
    {
        $hotels = Hotel::latest()->paginate(10);
        return view('admin.penginapan.index', compact('hotels'));
    }

    public function create()
    {
        return view('admin.penginapan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string',
            'price_per_night' => 'required|numeric|min:0',
            'facilities' => 'nullable|string',
            'image' => 'required|image|max:2048',
            'map_url' => 'nullable|url',
        ]);

        $path = $request->file('image')->store('hotels', 'public');

        Hotel::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'location' => $request->location,
            'price_per_night' => $request->price_per_night,
            'facilities' => $request->facilities,
            'image_url' => $path,
            'map_url' => $request->map_url,
        ]);

        return redirect()->route('admin.penginapan.index')->with('success', 'Penginapan berhasil ditambahkan.');
    }

    public function edit(Hotel $penginapan)
    {
        return view('admin.penginapan.edit', compact('penginapan'));
    }

    public function update(Request $request, Hotel $penginapan)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string',
            'price_per_night' => 'required|numeric|min:0',
            'facilities' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'map_url' => 'nullable|url',
        ]);

        $data = [
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'location' => $request->location,
            'price_per_night' => $request->price_per_night,
            'facilities' => $request->facilities,
            'map_url' => $request->map_url,
        ];

        if ($request->hasFile('image')) {
            if ($penginapan->image_url) {
                Storage::disk('public')->delete($penginapan->image_url);
            }
            $data['image_url'] = $request->file('image')->store('hotels', 'public');
        }

        $penginapan->update($data);

        return redirect()->route('admin.penginapan.index')->with('success', 'Penginapan berhasil diperbarui.');
    }

    public function destroy(Hotel $penginapan)
    {
        if ($penginapan->image_url) {
            Storage::disk('public')->delete($penginapan->image_url);
        }
        $penginapan->delete();
        return redirect()->route('admin.penginapan.index')->with('success', 'Penginapan berhasil dihapus.');
    }
}

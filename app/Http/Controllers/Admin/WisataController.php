<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class WisataController extends Controller
{
    public function index()
    {
        $destinations = Destination::latest()->paginate(10);
        return view('admin.wisata.index', compact('destinations'));
    }

    public function create()
    {
        return view('admin.wisata.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string',
            'price' => 'required|numeric|min:0',
            'image' => 'required|image|max:2048',
            'map_url' => 'nullable|url',
        ]);

        $path = $request->file('image')->store('destinations', 'public');

        Destination::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'location' => $request->location,
            'price' => $request->price,
            'image_url' => $path,
            'map_url' => $request->map_url,
            'promoted' => $request->has('promoted'),
        ]);

        return redirect()->route('admin.wisata.index')->with('success', 'Destinasi berhasil ditambahkan.');
    }

    public function edit(Destination $wisatum)
    {
        return view('admin.wisata.edit', compact('wisatum'));
    }

    public function update(Request $request, Destination $wisatum)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|max:2048',
            'map_url' => 'nullable|url',
        ]);

        $data = [
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'location' => $request->location,
            'price' => $request->price,
            'map_url' => $request->map_url,
            'promoted' => $request->has('promoted'),
        ];

        if ($request->hasFile('image')) {
            if ($wisatum->image_url) {
                Storage::disk('public')->delete($wisatum->image_url);
            }
            $data['image_url'] = $request->file('image')->store('destinations', 'public');
        }

        $wisatum->update($data);

        return redirect()->route('admin.wisata.index')->with('success', 'Destinasi berhasil diperbarui.');
    }

    public function destroy(Destination $wisatum)
    {
        if ($wisatum->image_url) {
            Storage::disk('public')->delete($wisatum->image_url);
        }
        $wisatum->delete();
        return redirect()->route('admin.wisata.index')->with('success', 'Destinasi berhasil dihapus.');
    }
}

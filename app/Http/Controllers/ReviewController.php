<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    // Simpan Review Baru
    public function store(Request $request)
    {
        $request->validate([
            'destination_id' => 'required|exists:destinations,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:500',
        ]);

        Review::create([
            'user_id' => Auth::id(),
            'destination_id' => $request->destination_id,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return back()->with('success', 'Ulasan berhasil dikirim!');
    }

    // Update Review (Edit)
    public function update(Request $request, $id)
    {
        $review = Review::findOrFail($id);

        // Pastikan yang edit adalah pemilik review
        if (Auth::id() !== $review->user_id) {
            return back()->with('error', 'Anda tidak berhak mengedit ulasan ini.');
        }

        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:500',
        ]);

        $review->update([
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return back()->with('success', 'Ulasan berhasil diperbarui!');
    }

    // Hapus Review
    public function destroy($id)
    {
        $review = Review::findOrFail($id);

        // Pastikan yang hapus adalah pemilik review
        if (Auth::id() !== $review->user_id) {
            return back()->with('error', 'Anda tidak berhak menghapus ulasan ini.');
        }

        $review->delete();

        return back()->with('success', 'Ulasan berhasil dihapus.');
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'destination_id' => 'required|exists:destinations,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:500',
        ]);

        // Check if user has purchased a ticket for this destination
        $hasPurchased = Auth::user()->orders()
            ->where('destination_id', $request->destination_id)
            ->where('status', 'paid')
            ->exists();

        if (!$hasPurchased) {
            return back()->with('error', 'Anda harus membeli tiket terlebih dahulu untuk memberikan review.');
        }

        Review::create([
            'user_id' => Auth::id(),
            'destination_id' => $request->destination_id,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return back()->with('success', 'Review berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $review = Review::where('user_id', Auth::id())->findOrFail($id);

        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:500',
        ]);

        $review->update($request->only('rating', 'comment'));

        return back()->with('success', 'Review berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $review = Review::where('user_id', Auth::id())->findOrFail($id);
        $review->delete();

        return back()->with('success', 'Review berhasil dihapus.');
    }
}
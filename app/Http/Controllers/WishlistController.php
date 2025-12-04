<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function index()
    {
        $wishlists = Wishlist::with('destination')
            ->where('user_id', Auth::id())
            ->latest()
            ->paginate(12);

        return view('wishlist.index', compact('wishlists'));
    }

    public function toggle(Request $request)
    {
        $request->validate([
            'destination_id' => 'required|exists:destinations,id',
        ]);

        $wishlist = Wishlist::where('user_id', Auth::id())
            ->where('destination_id', $request->destination_id)
            ->first();

        if ($wishlist) {
            $wishlist->delete();
            return back()->with('success', 'Dihapus dari wishlist.');
        } else {
            Wishlist::create([
                'user_id' => Auth::id(),
                'destination_id' => $request->destination_id,
            ]);
            return back()->with('success', 'Ditambahkan ke wishlist.');
        }
    }
}

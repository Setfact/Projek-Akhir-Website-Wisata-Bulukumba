<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    // Menampilkan daftar tiket user
    public function index()
    {
        $orders = Order::where('user_id', Auth::id())->with('destination')->latest()->get();
        return view('my-tickets', compact('orders'));
    }

    // Proses beli tiket
    public function store(Request $request)
    {
        $request->validate([
            'destination_id' => 'required|exists:destinations,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $destination = Destination::findOrFail($request->destination_id);
        $total = $destination->price * $request->quantity;

        Order::create([
            'user_id' => Auth::id(),
            'destination_id' => $destination->id,
            'quantity' => $request->quantity,
            'total_price' => $total,
            'status' => 'pending',
        ]);

        return redirect()->route('my-tickets')->with('success', 'Pesanan berhasil dibuat! Silahkan lakukan pembayaran.');
    }
}

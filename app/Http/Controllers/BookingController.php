<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class BookingController extends Controller
{
    public function create($slug)
    {
        $destination = Destination::where('slug', $slug)->firstOrFail();
        return view('booking.create', compact('destination'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'destination_id' => 'required|exists:destinations,id',
            'quantity' => 'required|integer|min:1',
            'payment_proof' => 'required|image|max:2048',
        ]);

        $destination = Destination::findOrFail($request->destination_id);
        $totalPrice = $destination->price * $request->quantity;

        $path = $request->file('payment_proof')->store('payment_proofs', 'public');

        $order = Order::create([
            'user_id' => Auth::id(),
            'destination_id' => $destination->id,
            'quantity' => $request->quantity,
            'total_price' => $totalPrice,
            'status' => 'pending',
            'payment_proof' => $path,
        ]);

        \Illuminate\Support\Facades\Mail::to(Auth::user())->send(new \App\Mail\OrderPlaced($order));

        return redirect()->route('booking.success', $order->id);
    }

    public function success($id)
    {
        $order = Order::where('user_id', Auth::id())->findOrFail($id);
        return view('booking.success', compact('order'));
    }
}

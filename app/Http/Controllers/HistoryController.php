<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HistoryController extends Controller
{
    public function index()
    {
        $orders = Order::where('user_id', Auth::id())
            ->with('destination')
            ->latest()
            ->paginate(10);
            
        return view('history.index', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::where('user_id', Auth::id())
            ->with('destination')
            ->findOrFail($id);
            
        return view('history.show', compact('order'));
    }

    public function invoice($id)
    {
        $order = Order::where('user_id', Auth::id())
            ->with('destination', 'user')
            ->findOrFail($id);

        if ($order->status !== 'paid') {
            abort(403, 'Invoice only available for paid orders.');
        }

        $pdf = Pdf::loadView('pdf.invoice', compact('order'));
        return $pdf->download('invoice-' . $order->id . '.pdf');
    }
}

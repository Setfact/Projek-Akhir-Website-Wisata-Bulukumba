<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function index()
    {
        $orders = Order::with(['user', 'destination'])->latest()->paginate(10);
        return view('admin.transaksi.index', compact('orders'));
    }

    public function export()
    {
        $orders = Order::with(['user', 'destination'])->get();

        return (new \Rap2hpoutre\FastExcel\FastExcel($orders))->download('transaksi_phinisi_point.xlsx', function ($order) {
            return [
                'ID Transaksi' => $order->id,
                'Nama Pemesan' => $order->user->name,
                'Email Pemesan' => $order->user->email,
                'Destinasi' => $order->destination->name,
                'Jumlah Tiket' => $order->quantity,
                'Total Harga' => $order->total_price,
                'Status' => ucfirst($order->status),
                'Tanggal Pemesanan' => $order->created_at->format('d-m-Y H:i'),
            ];
        });
    }

    public function show($id)
    {
        $order = Order::with(['user', 'destination'])->findOrFail($id);
        return view('admin.transaksi.show', compact('order'));
    }

    public function verify($id)
    {
        $order = Order::findOrFail($id);
        $order->update(['status' => 'paid']);
        
        // TODO: Send email notification
        $order->save();

        \Illuminate\Support\Facades\Mail::to($order->user)->send(new \App\Mail\PaymentVerified($order));

        return redirect()->back()->with('success', 'Pembayaran berhasil diverifikasi.');
    }

    public function reject(Request $request, $id)
    {
        $request->validate([
            'refund_note' => 'required|string',
        ]);

        $order = Order::findOrFail($id);
        $order->update([
            'status' => 'cancelled',
            'refund_note' => $request->refund_note,
        ]);

        // TODO: Send email notification

        return back()->with('success', 'Pembayaran ditolak.');
    }
}

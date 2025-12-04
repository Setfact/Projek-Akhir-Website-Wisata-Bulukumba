<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChartController extends Controller
{
    public function index()
    {
        // Aggregate sales by destination
        $salesData = Order::select('destination_id', DB::raw('SUM(quantity) as total_sold'))
            ->where('status', 'paid')
            ->with('destination')
            ->groupBy('destination_id')
            ->orderByDesc('total_sold')
            ->get();

        // Prepare data for Chart.js
        $labels = $salesData->map(function ($item) {
            return $item->destination->name;
        });

        $data = $salesData->map(function ($item) {
            return $item->total_sold;
        });

        return view('admin.charts.index', compact('labels', 'data'));
    }
}

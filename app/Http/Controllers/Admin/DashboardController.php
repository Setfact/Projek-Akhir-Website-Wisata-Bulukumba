<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalRevenue = Order::where('status', 'paid')->sum('total_price');
        $totalOrders = Order::count();
        $totalUsers = User::where('role', 'user')->count();
        $totalDestinations = Destination::count();
        
        // Simple chart data (last 7 days revenue)
        // This is a placeholder, real implementation would group by date
        $chartData = []; 

        return view('admin.dashboard', compact('totalRevenue', 'totalOrders', 'totalUsers', 'totalDestinations'));
    }
}

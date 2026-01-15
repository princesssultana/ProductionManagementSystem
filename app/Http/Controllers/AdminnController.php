<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Demand;
use App\Models\Stock;

class AdminnController extends Controller
{
    public function dashboard(Request $request)
    {
        $year = $request->get('year', now()->year);

        // Stats
        $materials = Stock::count(); // Total number of stock items
        $demands   = Demand::count(); // Total demands
        $pending   = Demand::where('status', 'pending')->count(); // Pending demands

        // Monthly Demands
        $monthlyDemands = Demand::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
            ->whereYear('created_at', $year)
            ->groupBy('month')
            ->pluck('total', 'month');

        // Monthly Stock
        $monthlyStock = Stock::selectRaw('MONTH(created_at) as month, SUM(quantity) as total')
            ->whereYear('created_at', $year)
            ->groupBy('month')
            ->pluck('total', 'month');

        // Low stock threshold (can be dynamic later)
        $threshold = 50;

        // Low stock items (include 0 or NULL quantities)
        $lowStockItems = Stock::where(function($q) use ($threshold) {
            $q->where('quantity', '<=', $threshold)
              ->orWhereNull('quantity');
        })->get();

        // Count of low stock items
        $lowStockCount = $lowStockItems->count();

        return view('pages.admin.dashboard', compact(
            'materials',
            'demands',
            'pending',
            'monthlyDemands',
            'monthlyStock',
            'threshold',
            'lowStockItems',   // List of low stock items
            'lowStockCount',   // Count for alert badges
            'year'
        ));
    }
}

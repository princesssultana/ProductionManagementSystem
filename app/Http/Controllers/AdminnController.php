<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Demand;
use App\Models\Stock;

class AdminnController extends Controller  
{
    public function dashboard(Request $request)
    {
        $year = $request->get('year', now()->year);

        $materials = Stock::count();
        $demands   = Demand::count();
        $pending   = Demand::where('status', 'pending')->count();

        // Monthly Demands
        $monthlyDemands = Demand::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
            ->whereYear('created_at', $year)
            ->groupBy('month')
            ->pluck('total', 'month');

        // Monthly Stock In
        $monthlyStock = Stock::selectRaw('MONTH(created_at) as month, SUM(quantity) as total')
            ->whereYear('created_at', $year)
            ->groupBy('month')
            ->pluck('total', 'month');

        // Low Stock Alert (threshold = 50)
        $lowStock = Stock::where('quantity', '<', 50)
            ->selectRaw('MONTH(created_at) as month, COUNT(*) as total')
            ->whereYear('created_at', $year)
            ->groupBy('month')
            ->pluck('total', 'month');

        return view('pages.admin.dashboard', compact(
            'materials',
            'demands',
            'pending',
            'monthlyDemands',
            'monthlyStock',
            'lowStock',
            'year'
        ));
    }
}

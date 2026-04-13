<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Demand;
use App\Models\DemandItem;
use App\Models\Stock;

class ReportController extends Controller
{
    public function productionReport(Request $request)
    {
        $from = $request->from;
        $to   = $request->to;

        $productions = Product::query()
            ->when($from && $to, function ($query) use ($from, $to) {
                $query->whereBetween('created_at', [
                    $from . ' 00:00:00',
                    $to   . ' 23:59:59'
                ]);
            })
            ->latest()
            ->get();

        // 🔥 products table onujayi sum
        $totalProduction = $productions->sum('stock');
        $totalDemand     = DemandItem::sum('quantity');
        $totalStock      = Product::sum('stock');

        return view('pages.report.production', compact(
            'productions',
            'totalProduction',
            'totalDemand',
            'totalStock',
            'from',
            'to'
        ));
    }
}

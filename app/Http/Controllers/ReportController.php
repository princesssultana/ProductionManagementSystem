<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Production;
use App\Models\Demand;
use App\Models\Product;
use App\Models\Stock;

class ReportController extends Controller
{
    public function productionReport(Request $request)
    {
        $from = $request->from;
        $to   = $request->to;

        $productions = Product::when($from && $to, function ($query) use ($from, $to) {
            $query->whereBetween('created_at', [$from, $to]);
        })->get();

        $totalProduction = $productions->sum('quantity');
        $totalDemand = Demand::sum('quantity');
        $totalStock = Stock::sum('quantity');

        return view('pages.reports.production', compact(
            'productions',
            'totalProduction',
            'totalDemand',
            'totalStock',
            'from',
            'to'
        ));
    }
}


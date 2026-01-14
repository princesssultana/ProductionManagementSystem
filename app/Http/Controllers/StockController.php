<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use App\Models\Medicine;
use App\Models\PackagingMaterial;
use App\Models\Factory;
use App\Models\Demand;
use App\Models\Product;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function index()
    {
        $stocks = Stock::with('stockable', 'demands')->latest()->get();
        return view('pages.stock.index', compact('stocks'));
    }

    public function create()
{
    $medicines = Product::all();
    $materials = PackagingMaterial::all();

    return view('pages.stock.create', compact('medicines', 'materials'));
}


    public function store(Request $request)
    {
        $modelNamespace = $request->stockable_type == 'Medicine' 
            ? Product::class 
            : PackagingMaterial::class;

        $stock = Stock::create([
            'stockable_type' => $modelNamespace,
            'stockable_id'   => $request->stockable_id,
            'quantity'       => $request->quantity,
            'batch_no'       => $request->batch_no,
            'expiry_date'    => $request->expiry_date,
            'status'         => $request->status,
        ]);

        if ($request->factory_id) {
            Demand::create([
                'factory_id'     => $request->factory_id,
                'stockable_id'   => $request->stockable_id,
                'stockable_type' => $modelNamespace,
                'quantity'       => $request->quantity,
                'status'         => 'pending',
            ]);
        }

        return redirect()->route('stocks.index')->with('success', 'Stock added successfully.');
    }

    public function edit($id)
    {
        $stock = Stock::findOrFail($id);
        $medicines = Product::all();
        $materials = PackagingMaterial::all();
        //$factories = Factory::all();

        return view('pages.stock.edit', compact('stock', 'medicines', 'materials', 'factories'));
    }

    public function update(Request $request, $id)
    {
        $stock = Stock::findOrFail($id);

        $modelNamespace = $request->stockable_type == 'Medicine' 
            ? Product::class 
            : PackagingMaterial::class;

        $stock->update([
            'stockable_type' => $modelNamespace,
            'stockable_id'   => $request->stockable_id,
            'quantity'       => $request->quantity,
            'batch_no'       => $request->batch_no,
            'expiry_date'    => $request->expiry_date,
            'status'         => $request->status,
        ]);

        if ($request->factory_id) {
            $latestDemand = $stock->demands()->latest()->first();

            if ($latestDemand) {
                $latestDemand->update([
                    'factory_id' => $request->factory_id,
                    'quantity'   => $request->quantity,
                    'status'     => 'pending',
                ]);
            } else {
                Demand::create([
                    'factory_id'     => $request->factory_id,
                    'stockable_id'   => $request->stockable_id,
                    'stockable_type' => $modelNamespace,
                    'quantity'       => $request->quantity,
                    'status'         => 'pending',
                ]);
            }
        }

        return redirect()->route('stocks.index')->with('success', 'Stock updated successfully.');
    }

    public function show($id)
    {
        $stock = Stock::with('stockable', 'demands')->findOrFail($id);
        return view('pages.stock.show', compact('stock'));
    }

    public function destroy($id)
    {
        $stock = Stock::findOrFail($id);
        $stock->delete();
        return redirect()->route('stocks.index')->with('success', 'Stock deleted successfully.');
    }
}

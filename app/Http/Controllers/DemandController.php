<?php

namespace App\Http\Controllers;

use App\Models\Demand;
use App\Models\PackagingMaterial;
use App\Models\Product;
use Illuminate\Http\Request;

class DemandController extends Controller
{
public function index()
{
    $demands = Demand::with('material')->latest()->get();
    return view('pages.demand.index', compact('demands'));
}

public function create()
{
    $medicines = Product::all();
    return view('pages.demand.create', compact('medicines'));
}


public function store(Request $request)
{
    // 1. Validate request
    $request->validate([
        'medicine_id' => 'required|exists:products,id',
        'qty' => 'required|numeric|min:1',
        'name' => 'nullable|string',
    ]);

    // 2. Create demand
    Demand::create([
        'medicine_id' => $request->medicine_id,
        'qty' => $request->qty,
        'name' => $request->name,
        'status' => 'Pending',
    ]);

    return redirect()->route('demands.index')->with('success', 'Demand saved successfully.');
}




public function show($id)
{
    $demand = Demand::findOrFail($id);
    return view('pages.demand.show', compact('demand'));
}

public function edit($id)
{
    $demand = Demand::findOrFail($id);
    return view('pages.demand.edit', compact('demand'));
}

    

    
   public function update(Request $request, $id)
{
    $demand = Demand::findOrFail($id);
    $medicine = $demand->material;

    if (!$medicine) {
        return redirect()->back()->with('error', 'Related medicine not found.');
    }

    // Validate
    $request->validate([
        'status' => 'required|in:Pending,Approved,Rejected',
        'approved_qty' => 'nullable|numeric|min:1',
    ]);

    if ($request->status == 'Approved') {

        if (!$request->approved_qty) {
            return redirect()->back()->with('error', 'Approved quantity required when approving.');
        }

        if ($request->approved_qty > $medicine->stock) {
            return redirect()->back()->with('error', 'Approved quantity exceeds stock.');
        }

        $demand->approved_qty = $request->approved_qty;
        $medicine->stock -= $request->approved_qty;
        $medicine->save();

        $demand->date_approved = now();
    } else {
        $demand->approved_qty = null;
        $demand->date_approved = null;
    }

    $demand->status = $request->status;
    $demand->save();

    return redirect()->route('demands.index')
                     ->with('success', 'Demand updated successfully.');
}





   






public function destroy($id)
{
    $demand = Demand::findOrFail($id);
    $demand->delete();

    return redirect()->route('demands.index')
                     ->with('success', 'Demand deleted successfully');
}

 








}

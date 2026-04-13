<?php

namespace App\Http\Controllers;

use App\Models\Demand;
use App\Models\DemandItem;
use App\Models\PackagingMaterial;
use App\Models\Product;
use Illuminate\Http\Request;

class DemandController extends Controller
{
public function index()
{
    $demands = Demand::with('items.product')->latest()->get();
    return view('pages.demand.index', compact('demands'));
}

public function create()
{
    $medicines = Product::with('packagingMaterials')->get();
    return view('pages.demand.create', compact('medicines'));
}


public function store(Request $request)
{
    // Validate request
    $request->validate([
        'name' => 'nullable|string',
        'products' => 'required|array|min:1',
        'products.*' => 'required|exists:products,id',
        'quantities.*' => 'required|numeric|min:1',
    ]);

    // Create demand
    $demand = Demand::create([
        'name' => $request->name ?? 'Demand ' . now()->format('Y-m-d H:i'),
        'status' => 'Pending',
        'date_requested' => now()->toDateString(),
    ]);

    // Add demand items (products to the demand)
    foreach ($request->products as $index => $productId) {
        DemandItem::create([
            'demand_id' => $demand->id,
            'product_id' => $productId,
            'quantity' => $request->quantities[$index],
        ]);
    }

    return redirect()->route('demands.index')->with('success', 'Demand created successfully.');
}




public function show($id)
{
    $demand = Demand::with('items.product.packagingMaterials')->findOrFail($id);
    return view('pages.demand.show', compact('demand'));
}

public function edit($id)
{
    $demand = Demand::with('items')->findOrFail($id);
    $medicines = Product::with('packagingMaterials')->get();
    return view('pages.demand.edit', compact('demand', 'medicines'));
}

    

    
    public function update(Request $request, $id)
    {
        $demand = Demand::findOrFail($id);

        // Validate
        $request->validate([
            'status' => 'required|in:Pending,Approved,Rejected',
            'name' => 'nullable|string',
        ]);

        // Update demand
        $demand->update([
            'status' => $request->status,
            'name' => $request->name ?? $demand->name,
        ]);

        if ($request->status == 'Approved') {
            $demand->date_approved = now()->toDateString();
            $demand->save();

            // Deduct from stock for all items
            foreach ($demand->items as $item) {
                $product = $item->product;
                if ($item->quantity > $product->stock) {
                    return redirect()->back()->with('error', 'Insufficient stock for ' . $product->name);
                }
                $product->stock -= $item->quantity;
                $product->save();
            }
        }

        return redirect()->route('demands.index')->with('success', 'Demand updated successfully.');
    }





   






    public function destroy($id)
    {
        $demand = Demand::findOrFail($id);
        $demand->items()->delete();
        $demand->delete();

        return redirect()->route('demands.index')->with('success', 'Demand deleted successfully');
    }

    public function materials($id)
    {
        $demand = Demand::with('items.product.packagingMaterials')->findOrFail($id);
        return view('pages.demand.materials', compact('demand'));
    }






}

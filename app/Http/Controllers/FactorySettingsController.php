<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FactorySetting;
use App\Models\Stock;

class FactorySettingsController extends Controller
{
    /**
     * Show factory settings list
     */
    public function index()
    {
        $factories = FactorySetting::latest()->get();
        $stocks = Stock::with('stockable')->get();

        return view('pages.factory.index', compact('factories', 'stocks'));
    }

    /**
     * Show create factory form
     */
    public function create()
    {
        return view('pages.factory.create');
    }

    /**
     * Store factory data
     */
    public function store(Request $request)
    {
        $request->validate([
            'factory_name' => 'required|string|max:255',
            'max_capacity' => 'required|integer',
            'min_stock_threshold' => 'required|integer',
            'status' => 'required|in:active,inactive',
        ]);

        FactorySetting::create([
            'factory_name' => $request->factory_name,
            'max_capacity' => $request->max_capacity,
            'min_stock_threshold' => $request->min_stock_threshold,
            'status' => $request->status,
        ]);

        return redirect()
            ->route('factory-settings.index')
            ->with('success', 'Factory created successfully');
    }
    /**
 * Show edit form
 */
public function edit($id)
{
    $factory = FactorySetting::findOrFail($id);
    return view('pages.factory.edit', compact('factory'));
}

/**
 * Update factory
 */
public function update(Request $request, $id)
{
    $request->validate([
        'factory_name' => 'required|string|max:255',
        'max_capacity' => 'required|integer',
        'min_stock_threshold' => 'required|integer',
        'status' => 'required|in:active,inactive',
    ]);

    $factory = FactorySetting::findOrFail($id);

    $factory->update([
        'factory_name' => $request->factory_name,
        'max_capacity' => $request->max_capacity,
        'min_stock_threshold' => $request->min_stock_threshold,
        'status' => $request->status,
    ]);

    return redirect()
        ->route('factory-settings.index')
        ->with('success', 'Factory updated successfully');
}

}

<?php

namespace App\Http\Controllers;

use App\Models\Demand;
use Illuminate\Http\Request;

class DemandController extends Controller
{
   public function index()
{
    $demands = Demand::all();
    return view('pages.demand.index', compact('demands'));
}

public function create()
{
    return view('pages.demand.create');
}

public function store(Request $request)
{
    $request->validate([
        'name' => 'required',
        'qty' => 'required|numeric',
    ]);

    Demand::create($request->all());  // mass assignable fields
    return redirect()->route('demands.index')
                     ->with('success', 'Demand added');
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

    $demand->status = $request->status;

    if ($request->status == 'Approved') {
        $demand->approved_qty = $request->approved_qty;
        $demand->date_approved = now();
    }

    $demand->save();

    return redirect()->route('demands.index')
                     ->with('success', 'Demand updated successfully');
}



public function destroy($id)
{
    $demand = Demand::findOrFail($id);
    $demand->delete();

    return redirect()->route('demands.index')
                     ->with('success', 'Demand deleted successfully');
}

 








}

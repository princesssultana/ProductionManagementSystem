<?php

namespace App\Http\Controllers;


use App\Models\PackagingMaterial;
use Illuminate\Http\Request;



class PackagingMaterialsController extends Controller
{
    public function index()

    {
         
        $materials = PackagingMaterial::latest()->get();
        return view('pages.material.index', compact('materials'));
    }

    public function create()
    {
        return view('pages.material.create');
    }

    public function store(Request $request)
    {
        PackagingMaterial::create($request->all());
        return redirect()->route('materials.index')
        ->with('success','Material Added Successfully');
    }
    public function show($id)
{
    $material = PackagingMaterial::findOrFail($id);
    return view('pages.material.view', compact('material'));
}


    public function edit($id)
    {
        $material = PackagingMaterial::findOrFail($id);
        return view('pages.material.edit', compact('material'));
    }

    public function update(Request $request, $id)
    {
        $material = PackagingMaterial::findOrFail($id);
        $material->update($request->all());

        return redirect()->route('materials.index')
        ->with('success','Material Updated');
    }

    public function destroy($id)
    {
        PackagingMaterial::findOrFail($id)->delete();
        return back()->with('success','Material Deleted');
    }
}

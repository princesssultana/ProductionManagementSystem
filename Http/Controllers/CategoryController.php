<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function list()
    {
        $puddingBox = Product::all();
        return view('pages.category.list', compact('puddingBox'));
    }

    // 👇 এই method টা ADD করুন
    public function createForm()
    {
        return view('pages.category.form');
    }

public function storeCategory(Request $request)
{
    // databease data save
    Product::create([
        'medicine_name'   => $request->medicine_name,
        'batch_no'        => $request->batch_no,
        'quantity'        => $request->quantity,
        'production_date' => $request->production_date,
        'expiry_date'     => $request->expiry_date,
        'description'     => $request->description,
        'status'          => $request->status,
    ]);

    return redirect()->route('category.list')->with('success', 'Product added successfully!');
}








}



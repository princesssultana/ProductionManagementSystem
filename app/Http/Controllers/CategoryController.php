<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller

{ 


    public function list()

    { 

        $puddingBox = Category::all();
        return view('pages.category.list', compact('puddingBox'));
    }

    
    public function createForm()
    {
        return view('pages.category.form');
    }

public function storeCategory(Request $request)
{
    // databease data save or store
    Category::create([
         //bam pase column name => dan pase input field er name
        'name'   => $request->c_name,
          
        'description'     => $request->description,
        'status'          => $request->status,
    ]);

    return redirect()->route('products.list');
}








}



<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller

{ 


    public function list()

    { 

        $categories = Category::all();
        return view('pages.category.list', compact('categories'));
    }

    public function destroy($id)

    { 

        $categories = Category::find($id)->delete();
        return redirect()->back();
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

    return redirect()->route('category.list');
}



// app/Http/Controllers/CategoryController.php
public function index() {
    $categories = \App\Models\Category::all();
    return view('categories.index', compact('categories'));
}

public function create() {
    return view('categories.form');
}

public function store(Request $request) {
    $request->validate(['name' => 'required|string|max:255']);
    \App\Models\Category::create($request->only('name'));
    return redirect()->route('categories.index');
}

public function edit(\App\Models\Category $category) {
    return view('pages.category.edit', compact('category'));
}

public function update(Request $request, \App\Models\Category $category) {
    $request->validate(['name' => 'required|string|max:255']);
    $category->update($request->only('name'));
    return redirect()->back();
}




}



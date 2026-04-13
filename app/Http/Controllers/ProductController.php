<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function list()
    {
      $allProducts = Product::all();
      return view('pages.product.list', compact('allProducts'));


    }

  

public function create()
{
    $categories = Category::all();
    return view('pages.product.create', compact('categories'));
}


  public function store(Request $request)

  {
     $fileName='';
        if($request->hasFile('image')){
            $file=$request->file('image');
            $fileName= date('Ymdhis').$file->getClientOriginalName();
            $file->storeAs('/products', $fileName);
        }
    
    Product::create([
      'name' => $request->product_name,
  'category_id' => $request->category_id,
           'price' => $request->product_price,
           'stock' => $request->product_stock,
           'description' => $request->product_description,
            
           'status' => $request->status,
            'image' =>$fileName
    ]);  return redirect()->route('products.list');
  }



}

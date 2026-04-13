<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    
    public function getProducts() 
    {

        $products=Product::all();
        return $this->responseWithSuccess($products,'Product Showing Success');
    }


    public function viewProduct($productID)
    {
        $product= Product::find($productID);

        if($product)
        {
            return $this->responseWithSuccess($product,'Single Product Showing Success');

        }else{
            return $this->responseWithFailed('No product found');
        }
    }
}

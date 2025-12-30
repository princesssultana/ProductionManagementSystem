<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function list()
    {
return view('pages.category.list');

    }
 public function createform()
    {
return view('pages.category.form');

    }





}

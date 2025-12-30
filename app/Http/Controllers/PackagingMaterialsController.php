<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PackagingMaterialsController extends Controller
{
     public function index()
    {
        return view('pages.materials');
    }
}

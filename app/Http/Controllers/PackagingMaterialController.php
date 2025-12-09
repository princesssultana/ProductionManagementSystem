<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PackagingMaterialController extends Controller
{
     public function box()
    {
        return view ('box');
    }
}

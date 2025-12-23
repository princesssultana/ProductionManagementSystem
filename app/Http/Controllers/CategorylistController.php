<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategorylistController extends Controller
{
    public function categorylist()
    {
        return view('pages.category-list');
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DemandDetailsController extends Controller
{
     public function index()
    {
        return view('pages.demands');
    }
}

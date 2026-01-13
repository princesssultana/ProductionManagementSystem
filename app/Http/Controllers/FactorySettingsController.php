<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FactorySettingsController extends Controller
{
     public function index()
    {
        return view('pages.factory-settings');
    }
}

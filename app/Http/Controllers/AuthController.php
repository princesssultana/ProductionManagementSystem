<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function loginForm()
    {
        return view('pages.login');
    }

    public function loginSubmit(Request $request)
    {
        $credentials= $request->except('_token');

       if(Auth::attempt($credentials))
       {
            
            return redirect()->route('home');
       }

       return redirect()->back();
    }


}

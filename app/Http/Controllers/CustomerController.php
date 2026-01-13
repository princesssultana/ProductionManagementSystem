<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller


{
    
 
    public function create()
    {
        return view('pages.customer.create');
    }
    public function store(Request $request)
    { 
         Customer::create([
    'name' => $request->name,
   'email' => $request->email,
   'phone' => $request->phone,
   'address' => $request->address,
   'password' => bcrypt($request->password),
   'status' => 'active'


    ]);

    return redirect()->route('customer.list');

    }
     public function index()
    {
        $customers = Customer::all();
        return view('pages.customer.list', compact('customers'));
    }

    
    public function show($id)
    {
        $customer = Customer::find($id);
        return view('pages.customer.view', compact('customer'));
    }


}

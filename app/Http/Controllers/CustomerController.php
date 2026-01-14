<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller


{
    public function view($id)
{
    $customer = Customer::findOrFail($id);
    return view('pages.customer.view', compact('customer'));
}
  public function edit($id)
{
    $customer = Customer::findOrFail($id);
    return view('pages.customer.edit', compact('customer'));
}
 
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

    return redirect()->route('customer.index');

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
    public function update(Request $request, $id)
{
    $customer = Customer::findOrFail($id);

    // Validation (optional)
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:customers,email,'.$id,
        'phone' => 'required',
        'status' => 'required'
    ]);

    $customer->update($request->all());

    return redirect()->route('customer.index')->with('success', 'Customer updated successfully');
}
public function destroy($id)
{
    // Customer find or fail
    $customer = Customer::findOrFail($id);

    // Delete the customer
    $customer->delete();

    // Redirect back with success message
    return redirect()->route('customer.index')->with('success', 'Customer deleted successfully');
}




}

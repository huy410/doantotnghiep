<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::paginate(20); 
        return view('admin.customers.customersView',['customers' => $customers]);
    }

    public function show($id)
    {
        $customer = Customer::where('id',$id)->first(); 
        return view('admin.customers.customersDetailView',['customer' => $customer]);
    }

    public function destroy($id)
    {
        $customer = Customer::destroy($id); 
        return redirect(route('customers.index'));
    }

}

<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;

use App\Http\Requests;

class CustomerController extends Controller
{
    public function postAddCustomer(Requests\CustomerRequest $request) {
        Customer::create($request->all());

        return back();
    }
}

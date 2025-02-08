<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Models\Customer;

use Illuminate\Support\Facades\Log;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Log::info(__METHOD__ . '(' . __LINE__ . ')' . ' start!');
        Log::info(__METHOD__ . '(' . __LINE__ . ')' . ' end!');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Log::info(__METHOD__ . '(' . __LINE__ . ')' . ' start!');
        Log::info(__METHOD__ . '(' . __LINE__ . ')' . ' end!');
        return view('customer.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCustomerRequest $request)
    {
        Log::info(__METHOD__ . '(' . __LINE__ . ')' . ' start!');
        Log::info(__METHOD__ . '(' . __LINE__ . ')' . ' end!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        Log::info(__METHOD__ . '(' . __LINE__ . ')' . ' start!');
        Log::info(__METHOD__ . '(' . __LINE__ . ')' . ' end!');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCustomerRequest $request, Customer $customer)
    {
        Log::info(__METHOD__ . '(' . __LINE__ . ')' . ' start!');
        Log::info(__METHOD__ . '(' . __LINE__ . ')' . ' end!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        //
    }
}

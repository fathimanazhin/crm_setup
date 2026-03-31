<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        if (auth()->user()->role == 'sales') {
            $customers = Customer::where('created_by', auth()->id())->get();
        } else {
            $customers = Customer::all();
        }
        return view('customers.index', compact('customers'));
    }

    public function create()
    {
        return view('customers.create');
    }

    public function store(Request $request)
    {
       $request->validate([
    'name' => 'required|string|max:255',
    'phone' => [
        'required',
        'regex:/^[6-9]\d{9}$/', // Indian mobile format
        'unique:customers,phone,' . ($customer->id ?? 'NULL') . ',id'
    ],
]);

        $data = $request->all();
        $data['created_by'] = auth()->id();

        $customer = Customer::create($data);

        logActivity(
            'Customer Created',
            'Customer: ' . $customer->name,
            'Customer',
            $customer->id
        );

        return redirect()->route('customers.index')->with('success', 'Customer created.');
    }

    public function show(Customer $customer)
    {
        return view('customers.show', compact('customer'));
    }

    public function edit(Customer $customer)
    {
        return view('customers.edit', compact('customer'));
    }

    public function update(Request $request, Customer $customer)
    {
        $request->validate([
    'name' => 'required|string|max:255',
    'phone' => [
        'required',
        'regex:/^[6-9]\d{9}$/', // Indian mobile format
        'unique:customers,phone,' . ($customer->id ?? 'NULL') . ',id'
    ],
]);

        $customer->update($request->all());

        logActivity(
            'Customer Updated',
            'Customer: ' . $customer->name,
            'Customer',
            $customer->id
        );

        return redirect()->route('customers.index')->with('success', 'Customer updated.');
    }

    public function destroy(Customer $customer)
    {
        $name = $customer->name;

        $customer->delete();

        logActivity(
            'Customer Deleted',
            'Customer: ' . $name,
            'Customer',
            $customer->id
        );

        return redirect()->route('customers.index')->with('success', 'Customer deleted.');
    }
}
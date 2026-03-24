<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    // Display list of customers
    public function index()
    {
        if (auth()->user()->role == 'sales') {
    $customers = Customer::where('created_by', auth()->id())->get();
} else {
    $customers = Customer::all();
}
        return view('customers.index', compact('customers'));
    }

    // Show create form
    public function create()
    {
        return view('customers.create');
    }

    // Store new customer
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:customers,email',
            'phone' => 'required',
        ]);

        $data = $request->all();
$data['created_by'] = auth()->id();

$customer = Customer::create($data);

        // ✅ ACTIVITY LOG
        logActivity(
            'Customer Created',
            'Customer: ' . $customer->name,
            'Customer',
            $customer->id
        );

        return redirect()->route('customers.index')->with('success', 'Customer created.');
    }

    // Show single customer
    public function show(Customer $customer)
    {
        return view('customers.show', compact('customer'));
    }

    // Show edit form
    public function edit(Customer $customer)
    {
        return view('customers.edit', compact('customer'));
    }

    // Update customer
    public function update(Request $request, Customer $customer)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => "required|email|unique:customers,email,{$customer->id}",
            'phone' => 'required',
        ]);

        $customer->update($request->all());

        // ✅ ACTIVITY LOG
        logActivity(
            'Customer Updated',
            'Customer: ' . $customer->name,
            'Customer',
            $customer->id
        );

        return redirect()->route('customers.index')->with('success', 'Customer updated.');
    }

    // Delete customer
    public function destroy(Customer $customer)
    {
        $name = $customer->name; // store before delete

        $customer->delete();

        // ✅ ACTIVITY LOG
        logActivity(
            'Customer Deleted',
            'Customer: ' . $name,
            'Customer',
            $customer->id
        );

        return redirect()->route('customers.index')->with('success', 'Customer deleted.');
    }
}
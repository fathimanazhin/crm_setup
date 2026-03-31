@extends('layouts.app')

@section('content')

<div class="p-6 text-white max-w-2xl mx-auto">

    <h2 class="text-2xl font-bold mb-6">Customer Details</h2>

    <div class="bg-indigo-900/60 backdrop-blur-md p-6 rounded-xl shadow-lg space-y-4">

        <p><strong class="text-gray-300">ID:</strong> {{ $customer->id }}</p>

        <p><strong class="text-gray-300">Name:</strong> {{ $customer->name }}</p>

        <p><strong class="text-gray-300">Email:</strong> {{ $customer->email }}</p>

        <p><strong class="text-gray-300">Phone:</strong> {{ $customer->phone }}</p>

        <p><strong class="text-gray-300">Company Name:</strong> {{ $customer->company_name }}</p>

        <p><strong class="text-gray-300">Address:</strong> {{ $customer->address }}</p>

        <p>
            <strong class="text-gray-300">Status:</strong> 
            <span class="px-2 py-1 text-xs rounded
                {{ $customer->status == 'Active' ? 'bg-green-500/20 text-green-400' : 'bg-red-500/20 text-red-400' }}">
                {{ $customer->status }}
            </span>
        </p>

    </div>

    <div class="mt-6">
        <a href="{{ route('customers.index') }}"
           class="bg-indigo-700 px-4 py-2 rounded-lg text-white hover:bg-indigo-600 transition">
            Back to Customers
        </a>
    </div>

</div>

@endsection
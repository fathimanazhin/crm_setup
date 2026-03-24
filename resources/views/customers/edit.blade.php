@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <h1 class="text-2xl font-bold mb-6">Edit Customer</h1>

    <div class="bg-white p-6 rounded shadow-md max-w-lg mx-auto">
        <form method="POST" action="{{ route('customers.update', $customer->id) }}">
            @csrf
            @method('PUT')

            <!-- Name -->
            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-1" for="name">Name</label>
                <input type="text" id="name" name="name" value="{{ $customer->name }}" required
                       class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <!-- Email -->
            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-1" for="email">Email</label>
                <input type="email" id="email" name="email" value="{{ $customer->email }}" required
                       class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <!-- Phone -->
            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-1" for="phone">Phone</label>
                <input type="text" id="phone" name="phone" value="{{ $customer->phone }}" required
                       class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <!-- Company Name -->
            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-1" for="company_name">Company Name</label>
                <input type="text" id="company_name" name="company_name" value="{{ $customer->company_name }}"
                       class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <!-- Address -->
            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-1" for="address">Address</label>
                <input type="text" id="address" name="address" value="{{ $customer->address }}"
                       class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <!-- Status -->
            <div class="mb-6">
                <label class="block text-gray-700 font-medium mb-1" for="status">Status</label>
                <select id="status" name="status"
                        class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="Active" {{ $customer->status == 'Active' ? 'selected' : '' }}>Active</option>
                    <option value="Inactive" {{ $customer->status == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>

            <!-- Buttons -->
            <div class="flex items-center justify-between">
                <button type="submit"
                        class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">
                    Update Customer
                </button>
                <a href="{{ route('customers.index') }}"
                   class="text-gray-600 hover:text-gray-800">Back</a>
            </div>
        </form>
    </div>
</div>
@endsection
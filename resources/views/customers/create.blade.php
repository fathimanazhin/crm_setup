@extends('layouts.app')

@section('content')

<div class="max-w-3xl mx-auto p-6">

    <h2 class="text-2xl font-bold mb-4">Add Customer</h2>

    <form method="POST" action="{{ route('customers.store') }}" class="space-y-4 bg-white p-6 rounded shadow">
        @csrf

        <div>
            <label class="block font-medium">Name</label>
            <input type="text" name="name" required class="w-full border p-2 rounded">
        </div>

        <div>
            <label class="block font-medium">Email</label>
            <input type="email" name="email" required class="w-full border p-2 rounded">
        </div>

        <div>
            <label class="block font-medium">Phone</label>
            <input type="text" name="phone" required class="w-full border p-2 rounded">
        </div>

        <div>
            <label class="block font-medium">Company Name</label>
            <input type="text" name="company_name" class="w-full border p-2 rounded">
        </div>

        <div>
            <label class="block font-medium">Address</label>
            <input type="text" name="address" class="w-full border p-2 rounded">
        </div>

        <div>
            <label class="block font-medium">Status</label>
            <select name="status" class="w-full border p-2 rounded">
                <option value="Active">Active</option>
                <option value="Inactive">Inactive</option>
            </select>
        </div>

        <div class="flex gap-3">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">
                Add Customer
            </button>

            <a href="{{ route('customers.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded">
                Back
            </a>
        </div>

    </form>

</div>

@endsection
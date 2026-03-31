@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 text-white">

    <h1 class="text-2xl font-bold mb-6">Edit Customer</h1>

    <div class="bg-indigo-900/60 backdrop-blur-md p-6 rounded-xl shadow-lg max-w-lg mx-auto">
        <form method="POST" action="{{ route('customers.update', $customer->id) }}">
            @csrf
            @method('PUT')

            <!-- Name -->
            <div class="mb-4">
                <label class="block text-gray-300 font-medium mb-1" for="name">Name</label>
                <input type="text" id="name" name="name" value="{{ $customer->name }}" required
                       class="w-full bg-indigo-950 border border-indigo-700 rounded px-3 py-2 text-white focus:outline-none focus:ring-2 focus:ring-cyan-400">
            </div>

            <!-- Email -->
            <div class="mb-4">
                <label class="block text-gray-300 font-medium mb-1" for="email">Email</label>
                <input type="email" id="email" name="email" value="{{ $customer->email }}" required
                       class="w-full bg-indigo-950 border border-indigo-700 rounded px-3 py-2 text-white focus:outline-none focus:ring-2 focus:ring-cyan-400">
            </div>

            <!-- Phone -->
            <div class="mb-4">
                <label class="block text-gray-300 font-medium mb-1" for="phone">Phone</label>
                <input type="text" name="phone"
       value="{{ old('phone', $customer->phone) }}"
       class="w-full bg-indigo-950 border border-indigo-700 rounded px-3 py-2 text-white focus:outline-none focus:ring-2 focus:ring-cyan-400 @error('phone') border-red-500 @enderror"
       maxlength="10"
       required>

       @error('phone')
            <span class="text-red-400 text-sm">{{ $message }}</span>
       @enderror
            </div>

            <!-- Company Name -->
            <div class="mb-4">
                <label class="block text-gray-300 font-medium mb-1" for="company_name">Company Name</label>
                <input type="text" id="company_name" name="company_name" value="{{ $customer->company_name }}"
                       class="w-full bg-indigo-950 border border-indigo-700 rounded px-3 py-2 text-white focus:outline-none focus:ring-2 focus:ring-cyan-400">
            </div>

            <!-- Address -->
            <div class="mb-4">
                <label class="block text-gray-300 font-medium mb-1" for="address">Address</label>
                <input type="text" id="address" name="address" value="{{ $customer->address }}"
                       class="w-full bg-indigo-950 border border-indigo-700 rounded px-3 py-2 text-white focus:outline-none focus:ring-2 focus:ring-cyan-400">
            </div>

            <!-- Status -->
            <div class="mb-6">
                <label class="block text-gray-300 font-medium mb-1" for="status">Status</label>
                <select id="status" name="status"
                        class="w-full bg-indigo-950 border border-indigo-700 rounded px-3 py-2 text-white focus:outline-none focus:ring-2 focus:ring-cyan-400">
                    <option value="Active" {{ $customer->status == 'Active' ? 'selected' : '' }}>Active</option>
                    <option value="Inactive" {{ $customer->status == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>

            <!-- Buttons -->
            <div class="flex items-center justify-between">
                <button type="submit"
                        class="bg-gradient-to-r from-indigo-600 to-cyan-500 px-4 py-2 rounded-lg text-white hover:opacity-90 transition">
                    Update Customer
                </button>

                <a href="{{ route('customers.index') }}"
                   class="text-gray-300 hover:text-white transition">
                    Back
                </a>
            </div>
        </form>
    </div>

</div>
@endsection
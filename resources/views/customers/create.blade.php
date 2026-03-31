@extends('layouts.app')

@section('content')

<div class="max-w-3xl mx-auto p-6 text-white">

    <h2 class="text-2xl font-bold mb-4">Add Customer</h2>

    <form method="POST" action="{{ route('customers.store') }}" 
          class="space-y-4 bg-indigo-900/60 backdrop-blur-md p-6 rounded-xl shadow-lg">
        @csrf

        <div>
            <label class="block font-medium text-gray-300">Name</label>
            <input type="text" name="name" required 
                   class="w-full bg-indigo-950 border border-indigo-700 p-2 rounded text-white focus:outline-none focus:ring-2 focus:ring-cyan-400">
        </div>

        <div>
            <label class="block font-medium text-gray-300">Email</label>
            <input type="email" name="email" required 
                   class="w-full bg-indigo-950 border border-indigo-700 p-2 rounded text-white focus:outline-none focus:ring-2 focus:ring-cyan-400">
        </div>

        <div>
            <label class="block font-medium text-gray-300">Phone</label>
            <input type="text" name="phone" 
                   pattern="[6-9]{1}[0-9]{9}" 
                   maxlength="10"
                   class="w-full bg-indigo-950 border border-indigo-700 p-2 rounded text-white focus:outline-none focus:ring-2 focus:ring-cyan-400"
                   required>

            @error('phone')
                <span class="text-red-400 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label class="block font-medium text-gray-300">Company Name</label>
            <input type="text" name="company_name" 
                   class="w-full bg-indigo-950 border border-indigo-700 p-2 rounded text-white focus:outline-none focus:ring-2 focus:ring-cyan-400">
        </div>

        <div>
            <label class="block font-medium text-gray-300">Address</label>
            <input type="text" name="address" 
                   class="w-full bg-indigo-950 border border-indigo-700 p-2 rounded text-white focus:outline-none focus:ring-2 focus:ring-cyan-400">
        </div>

        <div>
            <label class="block font-medium text-gray-300">Status</label>
            <select name="status" 
                    class="w-full bg-indigo-950 border border-indigo-700 p-2 rounded text-white focus:outline-none focus:ring-2 focus:ring-cyan-400">
                <option value="Active">Active</option>
                <option value="Inactive">Inactive</option>
            </select>
        </div>

        <div class="flex gap-3">
            <button type="submit" 
                    class="bg-gradient-to-r from-indigo-600 to-cyan-500 px-4 py-2 rounded-lg text-white hover:opacity-90 transition">
                Add Customer
            </button>

            <a href="{{ route('customers.index') }}" 
               class="bg-indigo-700 px-4 py-2 rounded-lg text-white hover:bg-indigo-600 transition">
                Back
            </a>
        </div>

    </form>

</div>

@endsection
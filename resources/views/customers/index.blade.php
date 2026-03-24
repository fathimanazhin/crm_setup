@extends('layouts.app')

@section('content')

<div class="p-6">

    <h2 class="text-2xl font-bold mb-4">Customers</h2>

    <div class="mb-4">
        <a href="{{ route('customers.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">
            Add Customer
        </a>
    </div>

    @if(session('success'))
        <p class="text-green-600 mb-4">{{ session('success') }}</p>
    @endif

    <div class="bg-white shadow rounded overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="bg-gray-200 text-left">
                    <th class="p-3">ID</th>
                    <th class="p-3">Name</th>
                    <th class="p-3">Email</th>
                    <th class="p-3">Phone</th>
                    <th class="p-3">Company</th>
                    <th class="p-3">Address</th>
                    <th class="p-3">Status</th>
                    <th class="p-3">Actions</th>
                </tr>
            </thead>

            <tbody>
                @foreach($customers as $customer)
                <tr class="border-t">
                    <td class="p-3">{{ $customer->id }}</td>
                    <td class="p-3">{{ $customer->name }}</td>
                    <td class="p-3">{{ $customer->email }}</td>
                    <td class="p-3">{{ $customer->phone }}</td>
                    <td class="p-3">{{ $customer->company_name }}</td>
                    <td class="p-3">{{ $customer->address }}</td>
                    <td class="p-3">{{ $customer->status }}</td>
                    <td class="p-3">
                        <a href="{{ route('customers.show', $customer->id) }}" class="text-blue-500">View</a> |
                        <a href="{{ route('customers.edit', $customer->id) }}" class="text-yellow-500">Edit</a> |
                        <form action="{{ route('customers.destroy', $customer->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button class="text-red-500">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>

        </table>
    </div>

</div>

@endsection
@extends('layouts.app')

@section('content')

<div class="p-6 text-white">

    <!-- HEADER -->
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold">Customers</h2>

        <a href="{{ route('customers.create') }}"
           class="bg-gradient-to-r from-indigo-600 to-cyan-500 px-4 py-2 rounded-lg text-white font-medium hover:opacity-90 transition">
            + Add Customer
        </a>
    </div>

    <!-- SUCCESS MESSAGE -->
    @if(session('success'))
        <div class="bg-green-500/20 text-green-400 px-4 py-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <!-- TABLE CARD -->
    <div class="bg-indigo-900/60 backdrop-blur-md rounded-xl shadow-lg overflow-hidden">

        <div class="overflow-x-auto">

            <table class="w-full text-sm">

                <!-- HEADER -->
                <thead>
                    <tr class="bg-indigo-800 text-left text-gray-300">
                        <th class="p-4">ID</th>
                        <th class="p-4">Name</th>
                        <th class="p-4">Email</th>
                        <th class="p-4">Phone</th>
                        <th class="p-4">Company</th>
                        <th class="p-4">Status</th>
                        <th class="p-4 text-center">Actions</th>
                    </tr>
                </thead>

                <!-- BODY -->
                <tbody>

                    @forelse($customers as $customer)

                        <tr class="border-b border-indigo-800 hover:bg-indigo-800/40 transition">

                            <td class="p-4">{{ $customer->id }}</td>

                            <td class="p-4 font-medium">
                                {{ $customer->name }}
                            </td>

                            <td class="p-4 text-gray-300">
                                {{ $customer->email }}
                            </td>

                            <td class="p-4">
                                {{ $customer->phone }}
                            </td>

                            <td class="p-4">
                                {{ $customer->company_name }}
                            </td>

                            <td class="p-4">
                                <span class="px-2 py-1 text-xs rounded
                                    {{ $customer->status == 'active' ? 'bg-green-500/20 text-green-400' : 'bg-red-500/20 text-red-400' }}">
                                    {{ ucfirst($customer->status) }}
                                </span>
                            </td>

                            <td class="p-4 text-center space-x-2">

                                <a href="{{ route('customers.show', $customer->id) }}"
                                   class="text-cyan-400 hover:text-cyan-200">
                                    View
                                </a>

                                <a href="{{ route('customers.edit', $customer->id) }}"
                                   class="text-yellow-400 hover:text-yellow-200">
                                    Edit
                                </a>

                                <form action="{{ route('customers.destroy', $customer->id) }}"
                                      method="POST"
                                      class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-red-400 hover:text-red-200">
                                        Delete
                                    </button>
                                </form>

                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="7" class="text-center p-6 text-gray-400">
                                No customers found
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection
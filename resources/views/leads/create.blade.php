@extends('layouts.app')

@section('content')

<div class="max-w-3xl mx-auto p-6 text-white">

    <h2 class="text-2xl font-bold mb-4">Add Lead</h2>

    @if ($errors->any())
        <div class="bg-red-500/20 text-red-400 p-4 rounded mb-4">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('leads.store') }}"
          class="space-y-4 bg-indigo-900/60 backdrop-blur-md p-6 rounded-xl shadow-lg">
        @csrf

        <div>
            <label class="block font-medium text-gray-300">Lead Name</label>
            <input type="text" name="lead_name" value="{{ old('lead_name') }}" required
                   class="w-full bg-indigo-950 border border-indigo-700 p-2 rounded text-white focus:outline-none focus:ring-2 focus:ring-cyan-400">
        </div>

        <div>
            <label class="block font-medium text-gray-300">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" required
                   class="w-full bg-indigo-950 border border-indigo-700 p-2 rounded text-white focus:outline-none focus:ring-2 focus:ring-cyan-400">
        </div>

        <div>
            <label class="block font-medium text-gray-300">Phone</label>

            <div class="mb-3">
                <label class="text-gray-400">Phone Number</label>

                <input type="text" name="phone"
                       value="{{ old('phone', $lead->phone ?? '') }}"
                       maxlength="10"
                       required
                       class="w-full bg-indigo-950 border border-indigo-700 p-2 rounded text-white focus:outline-none focus:ring-2 focus:ring-cyan-400 @error('phone') border-red-500 @enderror">

                @error('phone')
                    <span class="text-red-400 text-sm">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div>
            <label class="block font-medium text-gray-300">Source</label>
            <select name="source" required
                    class="w-full bg-indigo-950 border border-indigo-700 p-2 rounded text-white focus:outline-none focus:ring-2 focus:ring-cyan-400">
                <option value="Website">Website</option>
                <option value="Referral">Referral</option>
                <option value="Campaign">Campaign</option>
            </select>
        </div>

        <div>
            <label class="block font-medium text-gray-300">Assigned User</label>
            <select name="assigned_user_id" required
                    class="w-full bg-indigo-950 border border-indigo-700 p-2 rounded text-white focus:outline-none focus:ring-2 focus:ring-cyan-400">
                @foreach($users as $user)
                    <option value="{{ $user->id }}">
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block font-medium text-gray-300">Status</label>
            <select name="status"
                    class="w-full bg-indigo-950 border border-indigo-700 p-2 rounded text-white focus:outline-none focus:ring-2 focus:ring-cyan-400">
                <option value="New">New</option>
                <option value="Contacted">Contacted</option>
                <option value="Converted">Converted</option>
                <option value="Lost">Lost</option>
            </select>
        </div>

        <div class="flex gap-3">
            <button type="submit"
                    class="bg-gradient-to-r from-indigo-600 to-cyan-500 px-4 py-2 rounded-lg text-white hover:opacity-90 transition">
                Add Lead
            </button>

            <a href="{{ route('leads.index') }}"
               class="bg-indigo-700 px-4 py-2 rounded-lg text-white hover:bg-indigo-600 transition">
                Back
            </a>
        </div>

    </form>

</div>

@endsection
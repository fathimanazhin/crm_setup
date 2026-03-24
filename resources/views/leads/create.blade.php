@extends('layouts.app')

@section('content')

<div class="max-w-3xl mx-auto p-6">

    <h2 class="text-2xl font-bold mb-4">Add Lead</h2>

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('leads.store') }}" class="space-y-4 bg-white p-6 rounded shadow">
        @csrf

        <div>
    <label class="block font-medium">Lead Name</label>
    <input type="text" name="lead_name" value="{{ old('lead_name') }}" required class="w-full border p-2 rounded">
</div>

<div>
    <label class="block font-medium">Email</label>
    <input type="email" name="email" value="{{ old('email') }}" required class="w-full border p-2 rounded">
</div>

<div>
    <label class="block font-medium">Phone</label>
    <input type="text" name="phone" value="{{ old('phone') }}" required class="w-full border p-2 rounded">
</div>

<div>
    <label class="block font-medium">Source</label>
    <select name="source" required class="w-full border p-2 rounded">
        <option value="Website">Website</option>
        <option value="Referral">Referral</option>
        <option value="Campaign">Campaign</option>
    </select>
</div>

<div>
    <label class="block font-medium">Assigned User</label>
    <select name="assigned_user_id" required class="w-full border p-2 rounded">
        @foreach($users as $user)
            <option value="{{ $user->id }}">
                {{ $user->name }}
            </option>
        @endforeach
    </select>
</div>

<div>
    <label class="block font-medium">Status</label>
    <select name="status" class="w-full border p-2 rounded">
        <option value="New">New</option>
        <option value="Contacted">Contacted</option>
        <option value="Converted">Converted</option>
        <option value="Lost">Lost</option>
    </select>
</div>

        <div class="flex gap-3">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">
                Add Lead
            </button>

            <a href="{{ route('leads.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded">
                Back
            </a>
        </div>

    </form>

</div>

@endsection
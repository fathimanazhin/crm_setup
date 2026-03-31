@extends('layouts.app')

@section('content')

<div class="p-6 text-white max-w-2xl mx-auto">

    <h2 class="text-2xl font-bold mb-6">Edit Lead</h2>

    @if ($errors->any())
        <div class="bg-red-500/20 text-red-400 p-4 rounded mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>• {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('leads.update', $lead->id) }}"
          class="bg-indigo-900/60 backdrop-blur-md p-6 rounded-xl shadow-lg space-y-4">
        @csrf
        @method('PUT')

        <!-- Lead Name -->
        <div>
            <label class="block text-gray-300 mb-1">Lead Name</label>
            <input type="text" name="lead_name"
                   value="{{ old('lead_name', $lead->lead_name) }}"
                   required
                   class="w-full bg-indigo-950 border border-indigo-700 rounded px-3 py-2 text-white focus:outline-none focus:ring-2 focus:ring-cyan-400">
        </div>

        <!-- Email -->
        <div>
            <label class="block text-gray-300 mb-1">Email</label>
            <input type="email" name="email"
                   value="{{ old('email', $lead->email) }}"
                   required
                   class="w-full bg-indigo-950 border border-indigo-700 rounded px-3 py-2 text-white focus:outline-none focus:ring-2 focus:ring-cyan-400">
        </div>

        <!-- Phone -->
        <div>
            <label class="block text-gray-300 mb-1">Phone Number</label>

            <input type="text" name="phone"
                   value="{{ old('phone', $lead->phone ?? '') }}"
                   maxlength="10"
                   pattern="[6-9]{1}[0-9]{9}"
                   oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                   required
                   class="w-full bg-indigo-950 border border-indigo-700 rounded px-3 py-2 text-white focus:outline-none focus:ring-2 focus:ring-cyan-400 @error('phone') border-red-500 @enderror">

            @error('phone')
                <span class="text-red-400 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Source -->
        <div>
            <label class="block text-gray-300 mb-1">Source</label>
            <select name="source" required
                    class="w-full bg-indigo-950 border border-indigo-700 rounded px-3 py-2 text-white focus:outline-none focus:ring-2 focus:ring-cyan-400">
                <option value="Website" {{ old('source', $lead->source)=='Website'?'selected':'' }}>Website</option>
                <option value="Referral" {{ old('source', $lead->source)=='Referral'?'selected':'' }}>Referral</option>
                <option value="Campaign" {{ old('source', $lead->source)=='Campaign'?'selected':'' }}>Campaign</option>
            </select>
        </div>

        <!-- Assigned User -->
        <div>
            <label class="block text-gray-300 mb-1">Assigned User</label>
            <select name="assigned_user_id" required
                    class="w-full bg-indigo-950 border border-indigo-700 rounded px-3 py-2 text-white focus:outline-none focus:ring-2 focus:ring-cyan-400">
                @foreach($users as $user)
                    <option value="{{ $user->id }}"
                        {{ old('assigned_user_id', $lead->assigned_user_id)==$user->id?'selected':'' }}>
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Status -->
        <div>
            <label class="block text-gray-300 mb-1">Status</label>
            <select name="status" required
                    class="w-full bg-indigo-950 border border-indigo-700 rounded px-3 py-2 text-white focus:outline-none focus:ring-2 focus:ring-cyan-400">
                <option value="New" {{ old('status', $lead->status)=='New'?'selected':'' }}>New</option>
                <option value="Contacted" {{ old('status', $lead->status)=='Contacted'?'selected':'' }}>Contacted</option>
                <option value="Converted" {{ old('status', $lead->status)=='Converted'?'selected':'' }}>Converted</option>
                <option value="Lost" {{ old('status', $lead->status)=='Lost'?'selected':'' }}>Lost</option>
            </select>
        </div>

        <!-- Buttons -->
        <div class="flex items-center justify-between pt-2">
            <button type="submit"
                    class="bg-gradient-to-r from-indigo-600 to-cyan-500 px-4 py-2 rounded-lg text-white hover:opacity-90 transition">
                Update Lead
            </button>

            <a href="{{ route('leads.index') }}"
               class="text-gray-300 hover:text-white transition">
                Back to Leads
            </a>
        </div>

    </form>

</div>

@endsection
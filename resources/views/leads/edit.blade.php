<h2>Edit Lead</h2>

@if ($errors->any())
    <div style="color:red;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ route('leads.update', $lead->id) }}">
    @csrf
    @method('PUT')

    Lead Name:
    <input type="text" name="lead_name" value="{{ old('lead_name', $lead->lead_name) }}" required><br><br>

    Email:
    <input type="email" name="email" value="{{ old('email', $lead->email) }}" required><br><br>

    Phone:
    <input type="text" name="phone" value="{{ old('phone', $lead->phone) }}" required><br><br>

    Source:
    <select name="source" required>
        <option value="Website" {{ old('source', $lead->source)=='Website'?'selected':'' }}>Website</option>
        <option value="Referral" {{ old('source', $lead->source)=='Referral'?'selected':'' }}>Referral</option>
        <option value="Campaign" {{ old('source', $lead->source)=='Campaign'?'selected':'' }}>Campaign</option>
    </select><br><br>

    Assigned User:
    <select name="assigned_user_id" required>
        @foreach($users as $user)
            <option value="{{ $user->id }}" {{ old('assigned_user_id', $lead->assigned_user_id)==$user->id?'selected':'' }}>{{ $user->name }}</option>
        @endforeach
    </select><br><br>

    Status:
    <select name="status" required>
        <option value="New" {{ old('status', $lead->status)=='New'?'selected':'' }}>New</option>
        <option value="Contacted" {{ old('status', $lead->status)=='Contacted'?'selected':'' }}>Contacted</option>
        <option value="Converted" {{ old('status', $lead->status)=='Converted'?'selected':'' }}>Converted</option>
        <option value="Lost" {{ old('status', $lead->status)=='Lost'?'selected':'' }}>Lost</option>
    </select><br><br>

    <button type="submit">Update Lead</button>
</form>

<a href="{{ route('leads.index') }}">Back to Leads</a>
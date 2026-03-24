<h2>Edit Task / Follow-up</h2>

@if ($errors->any())
    <div style="color:red;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ route('tasks.update', $task->id) }}">
    @csrf
    @method('PUT')

    Title: 
    <input type="text" name="title" value="{{ old('title', $task->title) }}" required><br><br>

    Description:<br>
    <textarea name="description">{{ old('description', $task->description) }}</textarea><br><br>

    Related To:
    <select name="related_type" required>
        <option value="Customer" {{ old('related_type', $task->related_type)=='Customer'?'selected':'' }}>Customer</option>
        <option value="Lead" {{ old('related_type', $task->related_type)=='Lead'?'selected':'' }}>Lead</option>
    </select><br><br>

    Select Related:
    <select name="related_id" required>
        <optgroup label="Customers">
            @foreach($customers as $customer)
                <option value="{{ $customer->id }}" {{ old('related_id', $task->related_id)==$customer->id?'selected':'' }}>{{ $customer->name }}</option>
            @endforeach
        </optgroup>
        <optgroup label="Leads">
            @foreach($leads as $lead)
                <option value="{{ $lead->id }}" {{ old('related_id', $task->related_id)==$lead->id?'selected':'' }}>{{ $lead->lead_name }}</option>
            @endforeach
        </optgroup>
    </select><br><br>

    Assign To User:
    <select name="assigned_user_id" required>
        @foreach($users as $user)
            <option value="{{ $user->id }}" {{ old('assigned_user_id', $task->assigned_user_id)==$user->id?'selected':'' }}>{{ $user->name }}</option>
        @endforeach
    </select><br><br>

    Due Date: 
    <input type="date" name="due_date" value="{{ old('due_date', $task->due_date) }}" required><br><br>

    Status:
    <select name="status">
        <option value="Pending" {{ old('status', $task->status)=='Pending'?'selected':'' }}>Pending</option>
        <option value="Completed" {{ old('status', $task->status)=='Completed'?'selected':'' }}>Completed</option>
    </select><br><br>

    <button type="submit">Update Task</button>
</form>

<a href="{{ route('tasks.index') }}">Back to Tasks</a>
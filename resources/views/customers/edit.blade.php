<!DOCTYPE html>
<html>
<head>
    <title>Edit Customer</title>
</head>
<body>
<h2>Edit Customer</h2>

<form method="POST" action="{{ route('customers.update', $customer->id) }}">
    @csrf
    @method('PUT')

    Name: <input type="text" name="name" value="{{ $customer->name }}" required><br>
    Email: <input type="email" name="email" value="{{ $customer->email }}" required><br>
    Phone: <input type="text" name="phone" value="{{ $customer->phone }}" required><br>
    Company Name: <input type="text" name="company_name" value="{{ $customer->company_name }}"><br>
    Address: <input type="text" name="address" value="{{ $customer->address }}"><br>
    Status:
    <select name="status">
        <option value="Active" {{ $customer->status == 'Active' ? 'selected' : '' }}>Active</option>
        <option value="Inactive" {{ $customer->status == 'Inactive' ? 'selected' : '' }}>Inactive</option>
    </select><br>
    <button type="submit">Update Customer</button>
</form>

<a href="{{ route('customers.index') }}">Back</a>
</body>
</html>
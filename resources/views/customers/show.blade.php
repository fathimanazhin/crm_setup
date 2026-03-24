<!DOCTYPE html>
<html>
<head>
    <title>Customer Details</title>
</head>
<body>
<h2>Customer Details</h2>

<p><strong>ID:</strong> {{ $customer->id }}</p>
<p><strong>Name:</strong> {{ $customer->name }}</p>
<p><strong>Email:</strong> {{ $customer->email }}</p>
<p><strong>Phone:</strong> {{ $customer->phone }}</p>
<p><strong>Company Name:</strong> {{ $customer->company_name }}</p>
<p><strong>Address:</strong> {{ $customer->address }}</p>
<p><strong>Status:</strong> {{ $customer->status }}</p>

<a href="{{ route('customers.index') }}">Back to Customers</a>
</body>
</html>
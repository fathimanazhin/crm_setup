@extends('layouts.app')

@section('content')
<h2>Edit Profile</h2>

@if(session('success'))
    <p style="color: green">{{ session('success') }}</p>
@endif

<form method="POST" action="{{ route('profile.update') }}">
    @csrf
    @method('PATCH')

    <label>Name</label>
    <input type="text" name="name" value="{{ $user->name }}" required>
    <br>

    <label>Email</label>
    <input type="email" name="email" value="{{ $user->email }}" required>
    <br>

    <label>New Password</label>
    <input type="password" name="password">
    <br>

    <label>Confirm Password</label>
    <input type="password" name="password_confirmation">
    <br>

    <button type="submit">Update Profile</button>
</form>

<form method="POST" action="{{ route('profile.destroy') }}" style="margin-top:10px;">
    @csrf
    @method('DELETE')
    <button type="submit" onclick="return confirm('Are you sure?')">Delete Account</button>
</form>
@endsection
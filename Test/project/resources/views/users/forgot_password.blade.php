@extends('layouts.menu')

@section('title','login page')

@section('content')

<h2>Forgot Password</h2>

@if (session('status'))
    <p>{{ session('status') }}</p>
@endif

<form action="{{ route('password.email') }}" method="POST">
    @csrf
    <label for="email">Email Address:</label>
    <input type="email" name="email" required>
    <button type="submit">Send Password Reset Link</button>
</form>
@endsection
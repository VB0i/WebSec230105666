@extends('layouts.menu')

@section('title', 'Register')

@section('content')
<div class="d-flex justify-content-center align-items-center vh-100">
  <div class="card shadow-lg p-4 rounded-4 col-md-5">
    <h3 class="text-center mb-3">Create an Account</h3>
    <form action="{{route('do_register')}}" method="post">
      {{ csrf_field() }}
      <div class="form-group">
        @foreach($errors->all() as $error)
        <div class="alert alert-danger">
          <strong>Error!</strong> {{$error}}
        </div>
        @endforeach

        <div class="mb-3">
            <label class="form-label">Name:</label>
            <div class="input-group">
                <span class="input-group-text"><i class="fas fa-user"></i></span>
                <input type="text" class="form-control" placeholder="Enter your name" name="name" required>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Email:</label>
            <div class="input-group">
                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                <input type="email" class="form-control" placeholder="Enter your email" name="email" required>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Password:</label>
            <div class="input-group">
                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                <input type="password" class="form-control" placeholder="Enter password" name="password" required>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Confirm Password:</label>
            <div class="input-group">
                <span class="input-group-text"><i class="fas fa-check"></i></span>
                <input type="password" class="form-control" placeholder="Confirm password" name="password_confirmation" required>
            </div>
        </div>

        <div class="d-grid">
            <button type="submit" class="btn btn-primary btn-lg rounded-pill">Register</button>
        </div>
    </form>

    <p class="text-center mt-3">
        Already have an account? <a href="{{ route('login') }}">Login</a>
    </p>
  </div>
</div>
@endsection

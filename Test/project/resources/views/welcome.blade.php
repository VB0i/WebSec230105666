@extends('layouts.master')

@section('title', 'Main Page')

@section('content')

<div class="card m-4">
    <div class="card-header bg-primary text-white">
        <h3>Welcome to Our Website</h3>
    </div>
    <div class="card-body">
        <h4 class="card-title">Welcome, {{ auth()->user()->name ?? 'Guest' }}!</h4>
        <p class="card-text">
            Welcome to our website! We are thrilled to have you here. Whether you're looking for information, services, or just browsing around, we hope you find everything you need. Our platform is designed to provide you with the best experience possible.
        </p>
        <p class="card-text">
            Feel free to explore our features and don't hesitate to reach out if you have any questions. We are here to help you!
        </p>
        <hr>
        <h5>What We Offer:</h5>
        <ul>
            <li>Comprehensive information on various topics</li>
            <li>High-quality services tailored to your needs</li>
            <li>User-friendly interface for easy navigation</li>
            <li>Support and assistance whenever you need it</li>
        </ul>
        <hr>
        <h5>Get Started:</h5>
        <p>
            Ready to dive in? Click the button below to learn more about what we offer.
        </p>
        <a href="#" class="btn btn-success">Learn More</a>
    </div>
</div>

@endsection
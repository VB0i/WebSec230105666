<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
        <style>
            /* Custom dark mode styles */
            body {
                background-color: #111827 !important;
                color: #e5e7eb;
            }
            .navbar {
                background-color: #1a1a1a !important;
                border: 1px solid #2d3748;
                border-radius: 0.375rem;
            }
            .nav-link {
                color: #e5e7eb !important;
            }
            .nav-link:hover {
                color: #90cdf4 !important;
            }
            .card {
                background-color: #1a1a1a !important;
                border: 1px solid #2d3748;
                border-radius: 0.375rem;
            }
            .card-body {
                color: #e5e7eb;
            }
            .btn-link {
                color: #e5e7eb;
                text-decoration: none;
            }
            .btn-link:hover {
                color: #90cdf4;
            }
            .container-fluid {
                padding: 0.5rem 1rem;
            }
            .btn-dark {
                background-color: #2d3748;
                border-color: #4a5568;
            }
            .btn-dark:hover {
                background-color: #4a5568;
                border-color: #718096;
            }
            /* Main content wrapper */
            .content-wrapper {
                max-width: 80rem;
                margin: 3rem auto;
                padding: 0 1.5rem;
            }
            .main-container {
                background-color: #1f2937;
                border-radius: 0.5rem;
                box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1);
                padding: 1.5rem;
            }
        </style>
    </head>
    <body class="font-sans antialiased">
        <div class="content-wrapper">
            <div class="main-container">
                <nav class="navbar navbar-expand-sm navbar-dark rounded mb-4">
                    <div class="container-fluid">
                        <ul class="navbar-nav me-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="./">Dashboard</a>
                            </li>
                            <li class="nav-item">
                                <span class="nav-link">Welcome, {{ Auth::user()->name ?? 'Guest' }}</span>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="./prime">Prime Numbers</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="./multable">Multiplication Table</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="./MiniTest">Supermarket Bill</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="./transcript">Student Transcript</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="./products">Products</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('users.index') }}">Users List</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('users.create') }}">Add User</a>
                            </li>
                        </ul>
                        <ul class="navbar-nav">
                            @auth
                                <li class="nav-item">
                                    <span class="nav-link">Welcome, {{ Auth::user()->name }}</span>
                                </li>
                                <li class="nav-item">
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="nav-link btn btn-dark">Logout</button>
                                    </form>
                                </li>
                            @else
                                <li class="nav-item">
                                    <a href="{{ route('login') }}" class="nav-link">Login</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('register') }}" class="nav-link">Register</a>
                                </li>
                            @endauth
                        </ul>
                    </div>
                </nav>
                <div class="card">
                    <div class="card-body">
                        Welcome to Dashboard Page
                    </div>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>

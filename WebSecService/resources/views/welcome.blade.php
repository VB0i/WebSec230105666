    <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <meta charset="utf-8">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">




</head>
<body class="font-sans antialiased dark:bg-black dark:text-white/50">





<nav class="navbar navbar-expand-sm bg-light">
    <div class="container-fluid">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="./">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="./even">Even Numbers</a>
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
                <a class="nav-link" href="./products">products</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('users.index') }}">users List</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('users.create') }}">Add User</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('users.register') }}">Register</a>
            </li>
        </ul>
    </div>
</nav>
<div class="card m-4">
        <div class="card-body">
            Welcome to Home Page
        </div>
    </div>
</body>
</html>

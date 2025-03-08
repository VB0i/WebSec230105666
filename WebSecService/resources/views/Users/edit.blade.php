<!DOCTYPE html>
<html>
<head>
    <title>users List</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <meta charset="utf-8">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>
<body class="font-sans antialiased dark:bg-black dark:text-white/50">


<nav class="navbar navbar-expand-sm bg-light">
    <div class="container-fluid">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="/">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/even">Even Numbers</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ url('/prime') }}">Prime Numbers</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/multable">Multiplication Table</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/MiniTest">Supermarket Bill</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/transcript">Student Transcript</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/products">products</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('users.index') }}">users List</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('users.create') }}">Add User</a>
            </li>
        </ul>
    </div>
</nav>
    <div class="container mt-5">
        <h1>Edit User</h1>
        <form action="{{ route('users.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ $user->name }}" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ $user->email }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</body>
</html>
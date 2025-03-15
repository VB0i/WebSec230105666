<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<!-- Register Button at Top Right -->
<!-- <div class="container mt-3">
    <div class="d-flex justify-content-end">
        <a href="{{ route('register') }}" class="btn btn-success">Register</a>
    </div>
</div> -->

<div class="container mt-3">
    <div class="card shadow-lg border-0 rounded-3">
        <div class="card-header bg-primary text-white text-center">
            <h2>User Profile</h2>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <tbody>
                    <tr>
                        <th>Name:</th>
                        <td>{{ auth()->user()->name ?? 'Guest' }}</td>
                    </tr>
                    <tr>
                        <th>Email:</th>
                        <td>{{ auth()->user()->email ?? 'Guest' }}</td>
                    </tr>
                    <tr>
                        <th>Password (Hashed):</th>
                        <td><code>{{ auth()->user()->password ?? 'Guest' }}</code></td>
                    </tr>
                </tbody>
            </table>

            <!-- Logout Button (Redirects to Register Page) -->
            <div class="d-flex justify-content-center mt-4">
                <a href="/" class="btn btn-danger">Logout</a>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
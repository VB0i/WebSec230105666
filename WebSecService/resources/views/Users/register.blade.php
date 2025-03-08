<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
    <form action="{{route('do_register')}}" method="post">
        {{ csrf_field() }}
        <div class="form-group">
            @foreach($errors->all() as $error)
            <div class="alert alert-danger">
                <strong>Error!</strong> {{$error}}
            </div>
            @endforeach
        </div>

        <div class="form-group mb-2">
            <label for="name" class="form-label">Name:</label>
            <input type="text" class="form-control" id="name" placeholder="Name" name="name" value="{{ old('name') }}" required>
        </div>
        <div class="form-group mb-2">
            <label for="email" class="form-label">Email:</label>
            <input type="email" class="form-control" id="email" placeholder="Email" name="email" value="{{ old('email') }}" required>
        </div>
        <div class="form-group mb-2">
            <label for="password" class="form-label">Password:</label>
            <input type="password" class="form-control" id="password" placeholder="Password" name="password" required>
        </div>
        <div class="form-group mb-2">
            <label for="password_confirmation" class="form-label">Password Confirmation:</label>
            <input type="password" class="form-control" id="password_confirmation" placeholder="Confirm Password" name="password_confirmation" required>
        </div>
        <div class="form-group mb-2">
            <button type="submit" class="btn btn-primary">Register</button>
        </div>
    </form>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Even Numbers</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="card">
    <div class="card-header">Even Numbers</div>
    <div class="card-body">
    @foreach (range(1, 100) as $i)
    @if($i%2==0)
    <span class="badge bg-primary">{{$i}}</span>
    @else
    <span class="badge bg-secondary">{{$i}}</span>
    @endif
    @endforeach
    </div>
    </div>
</body>
</html>
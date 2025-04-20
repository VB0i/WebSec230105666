<!DOCTYPE html>
<html lang="ar" data-bs-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=cognition_2" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=cognition_2" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <span class="material-symbols-outlined large-icon">cognition_2</span>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav me-auto">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/multable">Multibication</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/even">Even Numbers</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/prime">Prime Numbers</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/MiniTest">Market</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/transcript">Student Transcript</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/calculator">Calculator</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/products">Products</a>
        </li>
      </ul>
      <ul class="navbar-nav">
        <li class="nav-item me-3">
          <button class="btn btn-outline-primary" id="themeToggle">
            <i class="fas fa-sun" id="lightIcon"></i>
            <i class="fas fa-moon" id="darkIcon" style="display:none"></i>
          </button>
        </li>
        @if(Auth::check())
          <div class="dropdown">
              <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                  {{ Auth::user()->name }}
              </button>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="{{ route('profile') }}">Profile</a></li>
                <li><a class="dropdown-item" href="{{ route('dashboard') }}">Dashboard</a></li>
                <li><hr class="dropdown-divider"></li>
                <li>
                    <a class="dropdown-item text-danger" href="{{ route('do_logout') }}">
                        Logout
                    </a>
                </li>
              </ul>
          </div>
        @else
          <li class="nav-item me-2">
              <a class="btn btn-outline-primary" href="{{ route('login') }}">Login</a>
          </li>
          <li class="nav-item">
              <a class="btn btn-outline-success" href="{{ route('register') }}">Register</a>
          </li>
        @endif
      </ul>
    </div>
  </div>
</nav>

<div class="container">
    @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const html = document.documentElement;
    const themeToggle = document.getElementById('themeToggle');
    const lightIcon = document.getElementById('lightIcon');
    const darkIcon = document.getElementById('darkIcon');

    // Check for saved theme preference, default to light if none found
    const savedTheme = localStorage.getItem('theme') || 'light';
    html.setAttribute('data-bs-theme', savedTheme);
    updateIcons(savedTheme);

    themeToggle.addEventListener('click', () => {
        const currentTheme = html.getAttribute('data-bs-theme');
        const newTheme = currentTheme === 'light' ? 'dark' : 'light';
        
        html.setAttribute('data-bs-theme', newTheme);
        localStorage.setItem('theme', newTheme);
        updateIcons(newTheme);
    });

    function updateIcons(theme) {
        if (theme === 'light') {
            lightIcon.style.display = 'inline';
            darkIcon.style.display = 'none';
        } else {
            lightIcon.style.display = 'none';
            darkIcon.style.display = 'inline';
        }
    }
});
</script>
<style>
.material-symbols-outlined {
  font-variation-settings:
  'FILL' 1,
  'wght' 700,
  'GRAD' 0,
  'opsz' 40
}
</style>
</body>
</html>

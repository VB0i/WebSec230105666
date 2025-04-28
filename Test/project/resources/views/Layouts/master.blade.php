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
    <style>
        /* Toggle button styles */
        .mode-toggle {
            position: relative;
            width: 80px;
            height: 40px;
            border-radius: 20px;
            background: #f1f1f1;
            cursor: pointer;
            overflow: hidden;
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
            border: none;
            margin-right: 10px;
        }
        
        .dark-mode .mode-toggle {
            background: #333333;
        }
        
        .toggle-inner {
            position: absolute;
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 10px;
            box-sizing: border-box;
        }
        
        .toggle-icon {
            width: 24px;
            height: 24px;
            transition: transform 0.3s ease, opacity 0.3s;
            z-index: 2;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .sun {
            color: #FFD700;
            transform: scale(1) rotate(0);
            opacity: 1;
        }
        
        .dark-mode .sun {
            transform: scale(0) rotate(90deg);
            opacity: 0;
        }
        
        .moon {
            color: #E0E0E0;
            transform: scale(0) rotate(-90deg);
            opacity: 0;
        }
        
        .dark-mode .moon {
            transform: scale(1) rotate(0);
            opacity: 1;
        }
        
        .toggle-ball {
            position: absolute;
            width: 30px;
            height: 30px;
            background: #4285f4;
            border-radius: 50%;
            left: 5px;
            top: 5px;
            transition: left 0.3s ease, background 0.3s;
            z-index: 1;
        }
        
        .dark-mode .toggle-ball {
            left: calc(100% - 35px);
            background: #8ab4f8;
        }
        
        /* Cartoon stars (visible in dark mode) */
        .stars {
            position: absolute;
            width: 100%;
            height: 100%;
            opacity: 0;
            transition: opacity 0.3s;
        }
        
        .dark-mode .stars {
            opacity: 1;
        }
        
        .star {
            position: absolute;
            background: white;
            clip-path: polygon(50% 0%, 61% 35%, 98% 35%, 68% 57%, 79% 91%, 50% 70%, 21% 91%, 32% 57%, 2% 35%, 39% 35%);
            width: 8px;
            height: 8px;
            animation: twinkle 2s infinite alternate;
        }
        
        @keyframes twinkle {
            0% { opacity: 0.3; }
            100% { opacity: 1; }
        }
        
        /* Cloud (visible in light mode) */
        .cloud {
            position: absolute;
            width: 24px;
            height: 12px;
            background: white;
            border-radius: 12px;
            opacity: 1;
            transition: opacity 0.3s;
            animation: float 3s infinite ease-in-out;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
        
        .dark-mode .cloud {
            opacity: 0;
        }
        
        .cloud:before, .cloud:after {
            content: '';
            position: absolute;
            background: white;
            border-radius: 50%;
        }
        
        .cloud:before {
            width: 10px;
            height: 10px;
            top: -6px;
            left: 4px;
        }
        
        .cloud:after {
            width: 6px;
            height: 6px;
            top: -4px;
            right: 4px;
        }
        
        @keyframes float {
            0%, 100% { transform: translate(-50%, -50%); }
            50% { transform: translate(-50%, calc(-50% - 3px)); }
        }
        
        .material-symbols-outlined {
          font-variation-settings:
          'FILL' 1,
          'wght' 700,
          'GRAD' 0,
          'opsz' 40
        }
    </style>
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
          <button class="mode-toggle" id="modeToggle">
            <div class="toggle-inner">
              <div class="toggle-icon sun"><i class="fas fa-sun"></i></div>
              <div class="toggle-icon moon"><i class="fas fa-moon"></i></div>
            </div>
            <div class="toggle-ball"></div>
            
            <!-- Cartoon elements -->
            <div class="stars">
                <div class="star" style="top:10%; left:20%;"></div>
                <div class="star" style="top:30%; left:70%; animation-delay:0.5s;"></div>
                <div class="star" style="top:70%; left:40%; animation-delay:1s;"></div>
            </div>
            <div class="cloud"></div>
          </button>
        </li>
        @if(Auth::check())
          <div class="dropdown">
              <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                  {{ Auth::user()->name }}
              </button>
              
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="{{ route('profile') }}">Profile</a></li>
                @if(auth()->user()->hasPermissionTo('edit_products'))
                <li><a class="dropdown-item" href="{{ route('dashboard') }}">Dashboard</a></li>
                @endif
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
    const themeToggle = document.getElementById('modeToggle');

    // Check for saved theme preference, default to light if none found
    const savedTheme = localStorage.getItem('theme') || 'light';
    html.setAttribute('data-bs-theme', savedTheme);
    if (savedTheme === 'dark') {
        html.classList.add('dark-mode');
    }

    themeToggle.addEventListener('click', () => {
        const currentTheme = html.getAttribute('data-bs-theme');
        const newTheme = currentTheme === 'light' ? 'dark' : 'light';
        
        html.setAttribute('data-bs-theme', newTheme);
        localStorage.setItem('theme', newTheme);
        
        // Toggle dark-mode class for our custom animations
        if (newTheme === 'dark') {
            html.classList.add('dark-mode');
        } else {
            html.classList.remove('dark-mode');
        }
    });
});
</script>
</body>
</html>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'UMKM Store')</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        /* Navbar Styling */
        .navbar {
            background: #222; /* Warna lebih elegan */
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        
        .navbar-brand {
            font-weight: bold;
            font-size: 1.5rem;
            color: yellow !important;
            text-decoration: none;
        }

        /* Mencegah perubahan warna saat diklik atau aktif */
        .navbar-brand:focus,
        .navbar-brand:active,
        .navbar-brand:hover {
            color: yellow !important;
            text-decoration: none;
        }

        .nav-item{
            margin-right: 20px;
        }
        
        .navbar-nav .nav-link {
            color: white;
            font-size: 1.1rem;
            position: relative;
            transition: color 0.3s ease-in-out;
        }
        
        /* Warna kuning saat aktif dan efek underline */
        .navbar-nav .nav-link.active {
            color: yellow !important;
        }

        .navbar-nav .nav-link.active::after {
            content: '';
            display: block;
            width: 100%;
            height: 3px;
            background-color: yellow;
            position: absolute;
            bottom: -5px;
            left: 0;
        }

        /* Efek hover dengan underline */
        .navbar-nav .nav-link:hover::after {
            content: '';
            display: block;
            width: 100%;
            height: 2px;
            background-color: yellow;
            position: absolute;
            bottom: -5px;
            left: 0;
        }

        /* Footer Styling */
        footer {
            background: #222;
            color: white;
            font-size: 1rem;
            padding: 15px 0;
            margin-top: 40px;
        }

        footer p {
            margin: 0;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg bg-warning">

        <div class="container">
            <img src="{{ asset('img/umkm_logo.png') }}" alt="Logo" height="60">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto primary">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('home') ? 'active' : '' }}" href="{{ url('/home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('produk') ? 'active' : '' }}" href="{{ url('/produk') }}">Produk</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('about') ? 'active' : '' }}" href="{{ url('/about') }}">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('contact') ? 'active' : '' }}" href="{{ url('/contact') }}">Contact Us</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Content -->
    <main class="py-4">
        <div class="container">
            @yield('content')
        </div>
    </main>

    <!-- Footer -->
    <footer class="text-center">
        <p>&copy; 2025 UMKM Store. All rights reserved.</p>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

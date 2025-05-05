<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'UMKM Store')</title>

    <!-- CSS & JS -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        /* Global reset */
        * {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Segoe UI', sans-serif;
        }

        /* Navbar */
        .navbar {
            background-color: #222;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.15);
        }

        .navbar-brand {
            font-weight: bold;
            font-size: 1.6rem;
            color: #ffc107 !important;
        }

        .navbar-brand:hover {
            text-decoration: none;
            color: #ffcd39 !important;
        }

        .navbar-nav .nav-link {
            color: #f8f9fa;
            font-size: 1.05rem;
            margin-right: 15px;
            position: relative;
            transition: all 0.3s;
        }

        .navbar-nav .nav-link:hover {
            color: #ffc107 !important;
        }

        .navbar-nav .nav-link.active {
            color: #ffc107 !important;
            font-weight: bold;
        }

        .navbar-nav .nav-link.active::after,
        .navbar-nav .nav-link:hover::after {
            content: '';
            display: block;
            width: 100%;
            height: 3px;
            background-color: #ffc107;
            position: absolute;
            bottom: -6px;
            left: 0;
        }

        /* Footer */
        footer {
            background-color: #222;
            color: #fff;
            padding: 20px 0;
            font-size: 0.95rem;
        }

        footer p {
            margin: 0;
        }
    </style>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const alertBox = document.querySelector(".alert");
            if (alertBox) {
                setTimeout(() => {
                    alertBox.classList.add("fade");
                    setTimeout(() => alertBox.remove(), 500);
                }, 3000);
            }
        });
    </script>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="{{ url('/user/home') }}">
                <img src="{{ asset('img/umkm_logo.png') }}" alt="Logo" height="50" class="me-2">
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('user/home') ? 'active' : '' }}" href="{{ url('/user/home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('user/produk') ? 'active' : '' }}" href="{{ url('/user/produk') }}">Produk</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('user/keranjang') ? 'active' : '' }}" href="{{ url('/user/keranjang') }}">Keranjang</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('user/pesanan') ? 'active' : '' }}" href="{{ url('/user/pesanan') }}">Pesanan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('user/histori') ? 'active' : '' }}" href="{{ url('/user/histori') }}">Histori</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('user/about') ? 'active' : '' }}" href="{{ url('/user/about') }}">Tentang Kami</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center {{ request()->is('logout') ? 'active' : '' }}" href="{{ url('/login') }}">
                            <i class="fas fa-sign-out-alt me-1"></i> Logout
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="py-4">
        <div class="container">
            @yield('content')
        </div>
    </main>

    <!-- Footer -->
    <footer class="text-center mt-auto">
        <p>&copy; 2025 UMKM Store. All rights reserved.</p>
    </footer>

</body>
</html>

<!DOCTYPE html>
 <html lang="id">
 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <title>@yield('title', 'UMKM Store')</title>
     
     <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">
     <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
     
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
            <a href="{{ url('/admin/home') }}">
                <img src="{{ asset('img/umkm_logo.png') }}" alt="Logo" height="60">
            </a>
             <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                 <span class="navbar-toggler-icon"></span>
             </button>
             <div class="collapse navbar-collapse" id="navbarNav">
                 <ul class="navbar-nav ms-auto primary">
                     <li class="nav-item">
                         <a class="nav-link {{ request()->is('admin/home') ? 'active' : '' }}" href="{{ url('/admin/home') }}">Home</a>
                     </li>
                     <li class="nav-item">
                         <a class="nav-link {{ request()->is('admin/produk') ? 'active' : '' }}" href="{{ url('/admin/produk') }}">Produk</a>
                     </li>
                     <li class="nav-item">
                         <a class="nav-link {{ request()->is('admin/pesanan') ? 'active' : '' }}" href="{{ url('/admin/pesanan') }}">Pesanan</a>
                    </li>
                     <li class="nav-item">
                         <a class="nav-link {{ request()->is('admin/about') ? 'active' : '' }}" href="{{ url('admin/about') }}">About Us</a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link {{ request()->is('logout') ? 'active' : '' }}" href="{{ url('/login') }}">Logout</a>
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
 
 </body>
 </html>
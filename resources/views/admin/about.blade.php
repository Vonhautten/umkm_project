@extends('admin.layouts')

@section('title', 'Tentang Kami - UMKM Store')

@section('content')

<style>
    a{
        text-decoration: none;
    }
</style>
<div class="container my-5">
    <!-- Hero Section -->
    <div class="row align-items-center mb-5">
        <div class="col-md-8">
            <h1 class="fw-bold">Tentang Kami</h1>
            <p class="lead">TECHFRIEND adalah platform berbasis web yang membantu UMKM lokal dengan fokus pada barang elektronik. Kami menyediakan ruang bagi pelaku usaha untuk memasarkan produk mereka secara lebih luas dan efisien di era digital.</p>
        </div>
        <div class="col-md-4 d-flex justify-content-center align-items-center">
            <img src="{{ asset('img/umkm_logo2.png') }}" class="img-fluid rounded w-75" alt="Tentang Kami">
        </div>
    </div>
    
    
    <!-- Visi & Misi -->
    <h2 class="text-center fw-bold">Visi & Misi</h2>
    <div class="row text-center my-4">
        <div class="col-md-6">
            <div class="p-4 shadow rounded">
                <i class="fas fa-eye fa-3x text-primary mb-3"></i>
                <h4>Visi</h4>
                <p>Menjadi platform unggulan dalam mendukung digitalisasi UMKM lokal, khususnya di sektor barang elektronik, untuk meningkatkan daya saing mereka di pasar global.</p>
            </div>
        </div>
        <div class="col-md-6">
            <div class="p-4 shadow rounded">
                <i class="fas fa-bullseye fa-3x text-success mb-3"></i>
                <h4>Misi</h4>
                <ul class="list-unstyled">
                    <li>- Memfasilitasi UMKM elektronik dalam pemasaran digital.</li>
                    <li>- Meningkatkan keterjangkauan produk elektronik lokal ke pasar yang lebih luas.</li>
                    <li>- Mendorong pertumbuhan ekonomi melalui transformasi digital UMKM.</li>
                </ul>
            </div>
        </div>
    </div>
    

    <!-- Tim Kami -->
    <h2 class="text-center fw-bold my-5">Tim Kami</h2>
    <div class="row text-center">
        <div class="col-md-3">
            <div class="card shadow">
                <div class="card-body">
                    <h5 class="card-title">Evan Dwi</h5>
                    <p class="card-text">Developer</p>
                    <a href="https://www.instagram.com/vennshikiii" target="_blank" class="text-dark">
                        <i class="fab fa-instagram fa-lg"></i> @vennshikiii
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow">
                <div class="card-body">
                    <h5 class="card-title">Muhammad Rafi</h5>
                    <p class="card-text">Developer</p>
                    <a href="https://www.instagram.com/sidkibertato" target="_blank" class="text-dark">
                        <i class="fab fa-instagram fa-lg"></i> @sidkibertato
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow">
                <div class="card-body">
                    <h5 class="card-title">Muhammad Zufar</h5>
                    <p class="card-text">Developer</p>
                    <a href="https://www.instagram.com/jupjupar" target="_blank" class="text-dark">
                        <i class="fab fa-instagram fa-lg"></i> @jupjupar
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow">
                <div class="card-body">
                    <h5 class="card-title">Reffi Reskian</h5>
                    <p class="card-text">Developer</p>
                    <a href="https://www.instagram.com/reskianreffi" target="_blank" class="text-dark">
                        <i class="fab fa-instagram fa-lg"></i> @reskianreffi
                    </a>
                </div>
            </div>
        </div>
    </div>
    
</div>
@endsection

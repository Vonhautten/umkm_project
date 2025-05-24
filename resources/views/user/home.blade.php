@extends('user.layouts')

@section('title', 'Beranda - UMKM Store')

@section('content')
<style>
    /* Hero Carousel Styles */
    .hero-carousel {
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }
    
    .hero-carousel .carousel-control-prev,
    .hero-carousel .carousel-control-next {
        width: 50px;
        height: 50px;
        background-color: rgba(255, 215, 0, 0.8);
        border-radius: 50%;
        top: 50%;
        transform: translateY(-50%);
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    
    .hero-carousel:hover .carousel-control-prev,
    .hero-carousel:hover .carousel-control-next {
        opacity: 1;
    }
    
    .hero-carousel .carousel-indicators button {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        background-color: rgba(255, 255, 255, 0.5);
        border: none;
    }
    
    .hero-carousel .carousel-indicators button.active {
        background-color: #ffd700;
    }
    
    /* Feature Cards */
    .feature-card {
        transition: all 0.3s ease;
        border: none;
        border-radius: 12px;
        overflow: hidden;
        height: 100%;
    }
    
    .feature-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
    }
    
    .feature-icon {
        font-size: 2.5rem;
        color: #ffd700;
        margin-bottom: 1rem;
    }
    
    /* Section Headings */
    .section-heading {
        position: relative;
        margin-bottom: 3rem;
        text-align: center;
    }
    
    .section-heading:after {
        content: '';
        display: block;
        width: 80px;
        height: 4px;
        background: linear-gradient(90deg, #ffd700, #ffa500);
        margin: 15px auto 0;
        border-radius: 2px;
    }
    
    /* Responsive Adjustments */
    @media (max-width: 768px) {
        .hero-carousel .carousel-control-prev,
        .hero-carousel .carousel-control-next {
            width: 40px;
            height: 40px;
            opacity: 1;
        }
        
        .feature-card {
            margin-bottom: 20px;
        }
    }
</style>

<!-- Hero Carousel Section -->
<section class="hero-section mb-5">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div id="heroCarousel" class="carousel slide hero-carousel" data-bs-ride="carousel" data-bs-interval="5000">
                    <!-- Indicators -->
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
                    </div>
                    
                    <!-- Slides -->
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="{{ asset('img/BANER_1.png') }}" class="d-block w-100" alt="Promosi Produk UMKM">
                            <div class="carousel-caption d-none d-md-block">
                                <h2>Dukung Produk Lokal</h2>
                                <p>Temukan berbagai produk unggulan dari pelaku UMKM di sekitar Anda</p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('img/BANER_2.png') }}" class="d-block w-100" alt="Kemudahan Berbelanja">
                            <div class="carousel-caption d-none d-md-block">
                                <h2>Belanja Mudah & Aman</h2>
                                <p>Transaksi cepat dengan berbagai metode pembayaran yang tersedia</p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('img/BANER_3.png') }}" class="d-block w-100" alt="Dukungan untuk UMKM">
                            <div class="carousel-caption d-none d-md-block">
                                <h2>Bangga Produk Indonesia</h2>
                                <p>Dukung perkembangan ekonomi lokal dengan membeli produk UMKM</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Controls -->
                    <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="features-section py-5 bg-light">
    <div class="container">
        <h2 class="section-heading">Mengapa Memilih TECHFRIEND?</h2>
        
        <div class="row g-4">
            <div class="col-md-6 col-lg-4">
                <div class="feature-card card shadow-sm h-100">
                    <div class="card-body text-center p-4">
                        <div class="feature-icon">
                            <i class="bi bi-shop-window"></i>
                        </div>
                        <h3 class="h5 card-title mb-3">Platform UMKM Terpercaya</h3>
                        <p class="card-text">Memberikan wadah bagi pelaku UMKM untuk menjual produk secara online dengan sistem yang mudah digunakan dan aman.</p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6 col-lg-4">
                <div class="feature-card card shadow-sm h-100">
                    <div class="card-body text-center p-4">
                        <div class="feature-icon">
                            <i class="bi bi-bag-check"></i>
                        </div>
                        <h3 class="h5 card-title mb-3">Transaksi Lengkap</h3>
                        <p class="card-text">Sistem pemantauan pesanan yang transparan dengan notifikasi real-time dan riwayat pembelian yang terorganisir.</p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6 col-lg-4">
                <div class="feature-card card shadow-sm h-100">
                    <div class="card-body text-center p-4">
                        <div class="feature-icon">
                            <i class="bi bi-phone"></i>
                        </div>
                        <h3 class="h5 card-title mb-3">Ramah Pengguna</h3>
                        <p class="card-text">Antarmuka yang intuitif dan responsif, dirancang untuk kenyamanan semua kalangan pengguna.</p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6 col-lg-4">
                <div class="feature-card card shadow-sm h-100">
                    <div class="card-body text-center p-4">
                        <div class="feature-icon">
                            <i class="bi bi-shield-check"></i>
                        </div>
                        <h3 class="h5 card-title mb-3">Keamanan Transaksi</h3>
                        <p class="card-text">Sistem pembayaran yang aman dengan berbagai pilihan metode untuk kenyamanan Anda.</p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6 col-lg-4">
                <div class="feature-card card shadow-sm h-100">
                    <div class="card-body text-center p-4">
                        <div class="feature-icon">
                            <i class="bi bi-truck"></i>
                        </div>
                        <h3 class="h5 card-title mb-3">Pengiriman Cepat</h3>
                        <p class="card-text">Kerjasama dengan jasa pengiriman terpercaya untuk memastikan produk sampai tepat waktu.</p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6 col-lg-4">
                <div class="feature-card card shadow-sm h-100">
                    <div class="card-body text-center p-4">
                        <div class="feature-icon">
                            <i class="bi bi-headset"></i>
                        </div>
                        <h3 class="h5 card-title mb-3">Layanan Pelanggan</h3>
                        <p class="card-text">Tim support yang siap membantu 24/7 melalui berbagai channel komunikasi.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Popular Products Section -->
<section class="products-section py-5">
    <div class="container">
        <h2 class="section-heading">Produk Unggulan</h2>
        
        <div class="row">
            <div class="col-12">
                <div class="alert alert-info text-center">
                    <i class="bi bi-info-circle me-2"></i>
                    Fitur daftar produk akan segera hadir. Sedang dalam pengembangan.
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Testimonial Section -->
<section class="testimonial-section py-5 bg-light">
    <div class="container">
        <h2 class="section-heading">Apa Kata Mereka?</h2>
        
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div id="testimonialCarousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <div class="testimonial-card card border-0 shadow-sm">
                                <div class="card-body text-center p-4">
                                    <img src="https://randomuser.me/api/portraits/women/32.jpg" class="rounded-circle mb-3" width="80" height="80" alt="Testimonial">
                                    <p class="lead mb-4">"TECHFRIEND sangat membantu saya sebagai penjual. Sekarang produk saya bisa dijangkau lebih banyak pelanggan."</p>
                                    <h5 class="mb-1">Sarah Wijaya</h5>
                                    <p class="text-muted">Pemilik Sarah's Homemade Cookies</p>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="testimonial-card card border-0 shadow-sm">
                                <div class="card-body text-center p-4">
                                    <img src="https://randomuser.me/api/portraits/men/45.jpg" class="rounded-circle mb-3" width="80" height="80" alt="Testimonial">
                                    <p class="lead mb-4">"Sebagai pembeli, saya sangat puas dengan kemudahan berbelanja dan kualitas produk yang ditawarkan."</p>
                                    <h5 class="mb-1">Budi Santoso</h5>
                                    <p class="text-muted">Pelanggan Setia</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon bg-primary rounded-circle" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon bg-primary rounded-circle" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@section('scripts')
<script>
    // Initialize carousels with different intervals
    document.addEventListener('DOMContentLoaded', function() {
        // Hero carousel
        new bootstrap.Carousel(document.getElementById('heroCarousel'), {
            interval: 5000,
            ride: 'carousel'
        });
        
        // Testimonial carousel
        new bootstrap.Carousel(document.getElementById('testimonialCarousel'), {
            interval: 8000,
            ride: 'carousel'
        });
        
        // Add smooth scroll to all links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });
    });
</script>
@endsection
@extends('user.layouts')
 
 @section('title', 'Beranda - UMKM Store')
 
 @section('content')
 <style>
 .carousel-control-prev,
 .carousel-control-next {
     top: 50%;
     transform: translateY(-50%);
     width: 50px; /* Sesuaikan ukuran */
     height: 50px;
     background-color: rgba(255, 215, 0, 0.8); /* Warna emas transparan */
     border-radius: 50%;
     display: flex;
     align-items: center;
     justify-content: center;
 }
 
 
 </style>
 <div class="container">
     <!-- Hero Section -->
     <div class="row my-4">
         <div class="col-md-12">
            <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel" data-bs-interval="2000">
                 <div class="carousel-indicators">
                     <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"></button>
                     <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"></button>
                     <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"></button>
                 </div>
                 <div class="carousel-inner">
                     <div class="carousel-item active">
                         <img src="{{ asset('img/BANER_1.png') }}" class="d-block w-100 rounded" alt="Slide 1">
                     </div>
                     <div class="carousel-item">
                         <img src="{{ asset('img/BANER_2.png') }}" class="d-block w-100 rounded" alt="Slide 2">
                     </div>
                     <div class="carousel-item">
                         <img src="{{ asset('img/BANER_3.png') }}" class="d-block w-100 rounded" alt="Slide 3">
                     </div>
                 </div>
                 <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                     <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                 </button>
                 <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                     <span class="carousel-control-next-icon" aria-hidden="true"></span>
                 </button>
             </div>
         </div>
     </div>
 
     <!-- Promo Section -->
     <h2 class="text-center my-4">Promo Spesial</h2>
     <div class="container py-5">
         <div class="row g-4">
             <!-- Card 1 -->
             <div class="col-md-6">
                 <div class="card text-white bg-dark">
                     <img src="your-image-url.jpg" class="card-img-top" alt="Headphone">
                     <div class="card-body text-center">
                         <h5 class="card-title">Sale Up To 30% Off</h5>
                         <p class="card-text">Latest Sound System</p>
                         <a href="#" class="btn btn-warning">View Offer</a>
                     </div>
                 </div>
             </div>
     
             <!-- Card 2 -->
             <div class="col-md-6">
                 <div class="card text-white bg-dark">
                     <img src="your-image-url.jpg" class="card-img-top" alt="Headphone">
                     <div class="card-body text-center">
                         <h5 class="card-title">Sale Up To 30% Off</h5>
                         <p class="card-text">Latest Sound System</p>
                         <a href="#" class="btn btn-warning">View Offer</a>
                     </div>
                 </div>
             </div>
     
             <!-- Card 3 -->
             <div class="col-md-6 col-lg-4">
                 <div class="card text-white bg-dark">
                     <img src="your-image-url.jpg" class="card-img-top" alt="Game Controller">
                     <div class="card-body text-center">
                         <h5 class="card-title">Game Controller</h5>
                         <a href="#" class="btn btn-warning">View More</a>
                     </div>
                 </div>
             </div>
     
             <!-- Card 4 -->
             <div class="col-md-6 col-lg-4">
                 <div class="card text-white bg-dark">
                     <img src="your-image-url.jpg" class="card-img-top" alt="Game Controller">
                     <div class="card-body text-center">
                         <h5 class="card-title">Game Controller</h5>
                         <a href="#" class="btn btn-warning">View More</a>
                     </div>
                 </div>
             </div>
     
             <!-- Card 5 -->
             <div class="col-md-6 col-lg-4">
                 <div class="card text-white bg-dark">
                     <img src="your-image-url.jpg" class="card-img-top" alt="Game Controller">
                     <div class="card-body text-center">
                         <h5 class="card-title">Game Controller</h5>
                         <a href="#" class="btn btn-warning">View More</a>
                     </div>
                 </div>
             </div>
         </div>
     </div>
     
 
     <!-- Featured Products Section -->
     <h2 class="text-center my-4">Produk Unggulan</h2>
     <div class="row">
         {{-- @foreach($products as $product)
         <div class="col-md-3 mb-4">
             <div class="card shadow-sm">
                 <img src="{{ $product->image_url }}" class="card-img-top" alt="{{ $product->name }}">
                 <div class="card-body text-center">
                     <h5 class="card-title">{{ $product->name }}</h5>
                     <p class="card-text text-success fw-bold">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                     <a href="{{ route('product.show', $product->id) }}" class="btn btn-primary">Detail</a>
                 </div>
             </div>
         </div>
         @endforeach --}}
     </div>
 </div>
 @endsection
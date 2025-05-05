<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - UMKM Elektronik</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #0D47A1;
            height: 100vh;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .main-container {
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.25);
            overflow: hidden;
            max-width: 900px;
            width: 100%;
            display: flex;
            flex-wrap: wrap;
        }

        .left-side {
            background-color: #6B73FF;
            color: white;
            padding: 40px;
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .left-side img {
            max-width: 100px;
            margin-bottom: 20px;
        }

        .left-side h2 {
            font-family: monospace;
            font-weight: bold;
        }

        .right-side {
            padding: 40px;
            flex: 1;
        }

        .form-control {
            border-radius: 8px;
        }

        .btn-primary {
            background: #6B73FF;
            border: none;
            border-radius: 8px;
            transition: background 0.3s;
        }

        .btn-primary:hover {
            background: #000DFF;
        }

        .text-center a {
            color: #6B73FF;
            font-weight: 500;
        }

        .text-center a:hover {
            text-decoration: underline;
        }

        .alert {
            color: red;
            font-size: 0.95rem;
        }

        @media (max-width: 768px) {
            .main-container {
                flex-direction: column;
            }

            .left-side, .right-side {
                width: 100%;
                padding: 30px;
            }

            .left-side {
                text-align: center;
            }
        }
    </style>
</head>
<body>

<div class="main-container">
    <div class="left-side">
        <img src="{{ asset('img/logo_doang.png') }}" alt="Logo">
        <h2>TECH FRIEND</h2>
        <p class="mt-3 text-center">Login untuk mengakses layanan terbaik dari UMKM Elektronik!</p>
    </div>

    <div class="right-side">
        <h4 class="text-center mb-4">Masuk ke Akun Anda</h4>

        @if (session('error'))
            <div class="alert alert-danger text-center">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required placeholder="Masukkan email">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required placeholder="Masukkan password">
            </div>
            <button type="submit" class="btn btn-primary w-100">Login</button>
        </form>

        <div class="text-center mt-3">
            <a href="/signup">Belum punya akun? Sign Up</a>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

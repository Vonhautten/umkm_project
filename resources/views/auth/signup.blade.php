<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - UMKM Elektronik</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #6B73FF, #000DFF);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .signup-container {
            background: #fff;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 400px;
        }
        .form-control {
            border-radius: 8px;
        }
        .btn-primary {
            background: #6B73FF;
            border: none;
            border-radius: 8px;
        }
        .btn-primary:hover {
            background: #000DFF;
        }
        .logo {
            font-size: 24px;
            font-weight: bold;
            color: #6B73FF;
            text-align: center;
        }
        a {
            text-decoration: none;
        }
    </style>
</head>
<body>

<div class="signup-container">
    <div class="logo">UMKM Elektronik</div>
    <h4 class="text-center mt-3 mb-4">Buat Akun Baru</h4>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('register') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" class="form-control" id="nama" name="nama" required placeholder="Masukkan nama lengkap">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" required placeholder="Masukkan email">
        </div>
        <div class="mb-3">
            <label for="telepon" class="form-label">Nomor Telepon</label>
            <input type="text" class="form-control" id="telepon" name="telepon" placeholder="Masukkan nomor telepon (opsional)">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required placeholder="Masukkan password">
        </div>
        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required placeholder="Ulangi password">
        </div>
        <button type="submit" class="btn btn-primary w-100">Daftar</button>
    </form>

    <div class="text-center mt-3">
        <a href="/login">Sudah punya akun? Login</a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

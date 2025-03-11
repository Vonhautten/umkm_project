<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - UMKM Elektronik</title>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            background: #0D47A1;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
        }
        a{
            text-decoration: none
        }
        .login-container {
            background: rgba(255, 255, 255, 0.1);
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 350px;
            text-align: center;
        }
        .form-control {
            border-radius: 8px;
            background: rgba(255, 255, 255, 0.2);
            border: none;
            color: white;
        }
        .form-control::placeholder {
            color: rgba(255, 255, 255, 0.7);
        }
        .btn-primary {
            background: white;
            color: #0D47A1;
            border: none;
            border-radius: 8px;
        }
        .btn-primary:hover {
            background: #008cff;
        }
        .icon {
            font-size: 50px;
            margin-bottom: 20px;
        }
        a {
            color: white;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="login-container">
        @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
        @endif

        <h1><b>LOGIN<b></h1>
        <img src="{{ asset('img/logo_doang.png') }}" style="height: 10%" class="d-block w-100 rounded" alt="Slide 1">
        <h2 style=" font-family: monospace;">TECH FRIEND</h2>
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="mb-3">
                <input type="email" class="form-control" id="email" name="email" required placeholder="Masukkan email">
            </div>
            <div class="mb-3">
                <input type="password" class="form-control" id="password" name="password" required placeholder="Masukkan password">
            </div>
            <button type="submit" class="btn btn-primary w-100">Login</button>
        </form>
        <div class="text-center mt-3">
            <a href="/signup">belum punya akun? sign up</a>
        </div>
    </div>
</body>
</html>

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
        .login-container {
            background: rgba(255, 255, 255, 0.221);
            padding: 40px;
            border-radius: 30px;
            border: solid white 5px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 700px;
            display: flex;
            flex-wrap: wrap;
        }
        .left-section, .right-section {
            flex: 1;
            padding: 20px;
            text-align: center;
        }
        .left-section {
            border-right: 1px solid rgba(255, 255, 255, 0.2);
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
        .logo {
            max-width: 200px;
            margin-bottom: 15px;
        }
        a {
            color: white;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
        @media (max-width: 768px) {
            .login-container {
                flex-direction: column;
            }
            .left-section {
                border-right: none;
                border-bottom: 1px solid rgba(255, 255, 255, 0.2);
                padding-bottom: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="left-section">
            <img src="{{ asset('img/logo_doang.png') }}" class="logo" alt="Logo">
            <h2 style="font-family: monospace;">TECH FRIEND</h2>
        </div>

        <div class="right-section">
            @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
            @endif
            <h3>Login</h3>
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
                <a href="/signup">Belum punya akun? Sign Up</a>
            </div>
        </div>
    </div>
</body>
</html>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Akun | SIPAM</title>
    <link rel="icon" href="{{ asset('images/ATR2.jpg') }}" type="image/jpg">

    <!-- ICON -->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        * {
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            margin: 0;
            min-height: 100vh;
            color: white;
            overflow-x: hidden;
            background-image: url('{{ asset("images/atr.jpg") }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }

        body::before {
            content: "";
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.65);
            z-index: -1;
        }

        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            padding: 18px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: rgba(0,0,0,0.45);
            backdrop-filter: blur(8px);
            z-index: 10;
        }

        .logo {
            margin: 0;
            font-size: 20px;
            line-height: 1.2;
        }

        .logo span {
            display: block;
            font-size: 15px;
            font-weight: normal;
            color: #f9ca24;
            margin-top: 2px;
        }

        .nav-menu {
            display: flex;
            gap: 25px;
            align-items: center;
        }

        .nav-menu a {
            color: #fff;
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
        }

        main {
            padding: 130px 20px 40px;
            max-width: 1200px;
            margin: auto;
        }

        .register-wrapper {
            max-width: 440px;
            margin: auto;
            background: rgba(255,255,255,0.12);
            backdrop-filter: blur(16px);
            border-radius: 22px;
            padding: 28px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.35);
        }

        .register-title {
            margin: 0 0 8px;
            font-size: 22px;
            font-weight: 800;
        }

        .register-subtitle {
            margin: 0 0 18px;
            font-size: 14px;
            color: rgba(255,255,255,0.85);
            line-height: 1.4;
        }

        label {
            font-size: 13px;
            font-weight: 700;
            display: block;
            margin-bottom: 6px;
            margin-top: 14px;
        }

        input {
            width: 100%;
            padding: 12px 14px;
            border-radius: 14px;
            border: none;
            outline: none;
            font-size: 14px;
        }

        .btn-register {
            width: 100%;
            margin-top: 18px;
            padding: 12px 18px;
            border-radius: 14px;
            border: none;
            background: #f9ca24;
            color: #000;
            font-weight: 900;
            cursor: pointer;
            font-size: 14px;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 8px;
        }

        .btn-register:hover {
            opacity: 0.95;
        }

        .error-box {
            margin-top: 12px;
            padding: 12px 14px;
            border-radius: 14px;
            background: rgba(231, 76, 60, 0.18);
            border: 1px solid rgba(231, 76, 60, 0.35);
            color: #fff;
            font-size: 13px;
        }

        .login-link {
            margin-top: 14px;
            font-size: 13px;
            text-align: center;
        }

        .login-link a {
            color: #f9ca24;
            font-weight: 800;
            text-decoration: none;
        }

        .back-home {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-top: 16px;
            color: #fff;
            text-decoration: none;
            font-weight: 700;
            font-size: 13px;
            opacity: 0.9;
        }

        .back-home:hover {
            opacity: 1;
        }
    </style>
</head>
<body>

<div class="navbar">
    <h3 class="logo">
        SIPAM
        <span>Sistem Informasi Pembayaran dan Administrasi Membayar</span>
    </h3>

    <!-- Navbar harus ke HOME & TENTANG -->
    <div class="nav-menu">
        <a href="{{ route('home') }}">Beranda</a>
        <a href="{{ route('tentang') }}">Tentang Sistem</a>
        <a href="{{ route('login') }}">Login</a>
        <a href="{{ route('register') }}" style="color:#f9ca24;">Daftar</a>
    </div>
</div>

<main>
    <div class="register-wrapper">

        <h2 class="register-title">
            Daftar Akun Admin
        </h2>

        <p class="register-subtitle">
            Silakan buat akun untuk mengakses fitur tambah, edit, hapus, dan manajemen data SPM.
        </p>

        {{-- ERROR REGISTER --}}
        @if ($errors->any())
            <div class="error-box">
                <b>Gagal daftar:</b>
                <ul style="margin: 6px 0 0 18px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <label>Nama</label>
            <input type="text"
                   name="name"
                   value="{{ old('name') }}"
                   placeholder="Masukkan nama"
                   required autofocus>

            <label>Email</label>
            <input type="email"
                   name="email"
                   value="{{ old('email') }}"
                   placeholder="Masukkan email"
                   required>

            <label>Password</label>
            <input type="password"
                   name="password"
                   placeholder="Masukkan password"
                   required>

            <label>Konfirmasi Password</label>
            <input type="password"
                   name="password_confirmation"
                   placeholder="Ulangi password"
                   required>

            <button type="submit" class="btn-register">
                <i class="fa-solid fa-user-plus"></i> DAFTAR
            </button>
        </form>

        <div class="login-link">
            Sudah punya akun?
            <a href="{{ route('login') }}">Login</a>
        </div>

        <a href="{{ route('home') }}" class="back-home">
            <i class="fa-solid fa-arrow-left"></i> Kembali ke Beranda
        </a>

    </div>
</main>

</body>
</html>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Verifikasi Email | SIPAM</title>
    <link rel="icon" href="{{ asset('images/ATR2.jpg') }}" type="image/jpg">

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        * { box-sizing: border-box; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
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
            top: 0; left: 0; right: 0;
            padding: 18px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: rgba(0,0,0,0.45);
            backdrop-filter: blur(8px);
            z-index: 10;
        }
        .logo { margin: 0; font-size: 20px; line-height: 1.2; }
        .logo span { display:block; font-size: 15px; font-weight: normal; color: #f9ca24; margin-top: 2px; }
        .nav-menu { display: flex; gap: 25px; align-items: center; }
        .nav-menu a { color: #fff; text-decoration: none; font-size: 14px; font-weight: 600; }

        main { padding: 130px 20px 40px; max-width: 1200px; margin: auto; }

        .box {
            max-width: 520px;
            margin: auto;
            background: rgba(255,255,255,0.12);
            backdrop-filter: blur(16px);
            border-radius: 22px;
            padding: 28px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.35);
        }
        h2 { margin: 0 0 8px; font-size: 22px; font-weight: 800; }
        p { margin: 0 0 18px; font-size: 14px; color: rgba(255,255,255,0.85); line-height: 1.5; }

        .btn {
            width: 100%;
            margin-top: 12px;
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

        .btn2 {
            width: 100%;
            margin-top: 10px;
            padding: 12px 18px;
            border-radius: 14px;
            border: 1px solid rgba(255,255,255,0.4);
            background: rgba(0,0,0,0.25);
            color: #fff;
            font-weight: 900;
            cursor: pointer;
            font-size: 14px;
        }

        .success-box {
            margin-top: 12px;
            padding: 12px 14px;
            border-radius: 14px;
            background: rgba(46, 204, 113, 0.18);
            border: 1px solid rgba(46, 204, 113, 0.35);
            color: #fff;
            font-size: 13px;
        }
    </style>
</head>
<body>

<div class="navbar">
    <h3 class="logo">
        SIPAM
        <span>Sistem Informasi Pembayaran dan Administrasi Membayar</span>
    </h3>

    <div class="nav-menu">
        <a href="{{ route('home') }}">Beranda</a>
        <a href="{{ route('tentang') }}">Tentang Sistem</a>
    </div>
</div>

<main>
    <div class="box">
        <h2>Verifikasi Email</h2>

        <p>
            Terima kasih sudah mendaftar!  
            Sebelum melanjutkan, silakan cek email kamu dan klik link verifikasi.
            Jika kamu belum menerima email, kamu bisa kirim ulang.
        </p>

        @if (session('status') == 'verification-link-sent')
            <div class="success-box">
                Link verifikasi baru sudah dikirim ke email kamu.
            </div>
        @endif

        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit" class="btn">
                <i class="fa-solid fa-envelope-circle-check"></i> KIRIM ULANG LINK VERIFIKASI
            </button>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn2">
                Logout
            </button>
        </form>
    </div>
</main>

</body>
</html>

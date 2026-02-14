<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>SIPAM</title>
    <link rel="icon" href="{{ asset('images/ATR2.jpg') }}" type="image/jpg">
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

        /* overlay gelap */
        body::before {
            content: "";
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.55);
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
    display: block;        /* bikin turun ke bawah */
    font-size: 15px;       /* lebih kecil */
    font-weight: normal;
    color: #f9ca24;
    margin-top: 2px;
}


/* MENU */
.nav-menu {
    display: flex;
    gap: 25px;
}

.nav-menu a {
    color: #fff;
    text-decoration: none;
    font-size: 14px;
    font-weight: 600;
    padding-bottom: 4px;
    position: relative;
    transition: 0.3s;
}

.nav-menu a::after {
    content: "";
    position: absolute;
    left: 0;
    bottom: 0;
    width: 0%;
    height: 2px;
    background: #f9ca24;
    transition: 0.3s;
}

.nav-menu a:hover::after,
.nav-menu a.active::after {
    width: 100%;
}

.nav-menu a:hover {
    color: #f9ca24;
}


        /* floating shapes */
        .circle {
            position: absolute;
            border-radius: 50%;
            background: rgba(255,255,255,0.08);
            animation: float 12s infinite ease-in-out;
            z-index: 0;
        }

        .circle.one {
            width: 220px;
            height: 220px;
            top: 20%;
            left: -60px;
        }

        .circle.two {
            width: 160px;
            height: 160px;
            bottom: 15%;
            right: -50px;
            animation-delay: 3s;
        }

        @keyframes float {
            0% { transform: translateY(0); }
            50% { transform: translateY(-25px); }
            100% { transform: translateY(0); }
        }

        /* hero */
        .hero {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 100px 20px 20px;
            position: relative;
            z-index: 1;
        }

        .hero-box {
            background: rgba(255,255,255,0.15);
            backdrop-filter: blur(14px);
            padding: 45px;
            border-radius: 22px;
            max-width: 760px;
            text-align: center;
            box-shadow: 0 25px 60px rgba(0,0,0,0.45);
            animation: fadeIn 1.2s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .hero-box h1 {
            font-size: 34px;
            margin-bottom: 6px;
        }

        .hero-box h1 span {
            color: #f9ca24;
        }

        .hero-box p {
            font-size: 16px;
            line-height: 1.8;
            opacity: 0.95;
            margin: 20px 0 35px;
        }

        /* features */
        .features {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 15px;
            margin-bottom: 35px;
        }

        .feature-box {
            background: rgba(255,255,255,0.18);
            padding: 15px;
            border-radius: 14px;
            font-size: 14px;
            transition: 0.3s;
        }

        .feature-box:hover {
            transform: translateY(-6px);
            background: rgba(255,255,255,0.28);
        }

        /* buttons */
        .hero-buttons a {
            display: inline-block;
            padding: 14px 26px;
            margin: 6px;
            border-radius: 14px;
            text-decoration: none;
            font-weight: bold;
            transition: 0.3s;
            font-size: 15px;
        }

        .btn-primary {
            background: #888f05;
            color: white;
        }

        .btn-primary:hover {
            transform: scale(1.05);
        }

        footer {
            margin-top: 35px;
            font-size: 13px;
            opacity: 0.85;
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
    <a href="{{ url('/') }}" 
       class="{{ request()->is('/') ? 'active' : '' }}">
        Beranda
    </a>

    <a href="{{ url('/tentang') }}" 
       class="{{ request()->is('tentang') ? 'active' : '' }}">
        Tentang Sistem
    </a>

    @guest
        <a href="{{ route('login') }}"
           class="{{ request()->is('login') ? 'active' : '' }}">
            Login
        </a>

        <a href="{{ route('register') }}"
           class="{{ request()->is('register') ? 'active' : '' }}">
            Daftar
        </a>
    @endguest

    @auth
        <a href="{{ route('spm.index') }}"
           class="{{ request()->is('spm') ? 'active' : '' }}">
            Data SPM
        </a>

        <form method="POST" action="{{ route('logout') }}" style="display:inline;">
            @csrf
            <button type="submit"
                style="background:none;border:none;color:#fff;font-size:14px;font-weight:600;cursor:pointer;padding:0;">
                Logout
            </button>
        </form>
    @endauth
</div>

</div>


<!-- dekorasi floating -->
<div class="circle one"></div>
<div class="circle two"></div>

<div class="hero">
    <div class="hero-box">

        <h1>Sistem Informasi <span>SPM</span></h1>
        <h1>Kantor Pertanahan Kota Kendari</h1>

        <p>
            Aplikasi berbasis web untuk pengelolaan dan pencarian
            <b>Surat Perintah Membayar (SPM)</b> secara cepat,
            terstruktur, dan akurat.
        </p>

        <div class="features">
            <div class="feature-box">Pencarian Data SPM</div>
            <div class="feature-box">Kategori & Tahun Anggaran</div>
            <div class="feature-box">Arsip Digital</div>
        </div>

        <div class="hero-buttons">
            <a href="{{ route('spm.index') }}" class="btn-primary">
                Masuk Aplikasi SPM
            </a>
        </div>

        <footer>
            <br>© {{ date('Y') }} | Kantor Pertanahan Kota Kendari
        </footer>

    </div>
</div>

</body>
</html>

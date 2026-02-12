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
            background: rgba(0, 0, 0, 0.6);
            z-index: -1;
        }

        /* NAVBAR */
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


        .nav-menu {
            display: flex;
            gap: 25px;
        }

        .nav-menu a {
            color: #fff;
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
            position: relative;
        }

        .nav-menu a::after {
            content: "";
            position: absolute;
            left: 0;
            bottom: -4px;
            width: 0%;
            height: 2px;
            background: #f9ca24;
            transition: 0.3s;
        }

        .nav-menu a:hover::after,
        .nav-menu a.active::after {
            width: 100%;
        }

        /* CONTENT */
        .content {
            min-height: 100vh;
            padding: 120px 20px 40px;
            display: flex;
            justify-content: center;
            align-items: flex-start;
        }

        .content-box {
            background: rgba(255,255,255,0.15);
            backdrop-filter: blur(14px);
            padding: 45px;
            border-radius: 22px;
            max-width: 900px;
            width: 100%;
            box-shadow: 0 25px 60px rgba(0,0,0,0.45);
            animation: fadeIn 1s ease;
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

        .content-box h1 {
            text-align: center;
            margin-bottom: 25px;
        }

        .content-box h1 span {
            color: #f9ca24;
        }

        .content-box p {
            line-height: 1.9;
            font-size: 15px;
            opacity: 0.95;
            margin-bottom: 18px;
            text-align: justify;
        }

        .list {
            margin-top: 20px;
        }

        .list li {
            margin-bottom: 10px;
        }

        footer {
            text-align: center;
            margin-top: 30px;
            font-size: 13px;
            opacity: 0.85;
        }
    </style>
</head>
<body>

<!-- NAVBAR -->
<div class="navbar">
    <h3 class="logo">
    SIPAM
    <span>Sistem Informasi Pembayaran dan Administrasi Membayar</span>
</h3>


    <div class="nav-menu">
        <a href="/">Beranda</a>
        <a href="{{ url('/tentang') }}" class="active">Tentang Sistem</a>
    </div>
</div>

<!-- CONTENT -->
<div class="content">
    <div class="content-box">

        <h1>Tentang <span>Sistem Informasi SPM</span></h1>

        <p>
            Sistem Informasi SPM (Surat Perintah Membayar) merupakan aplikasi
            berbasis web yang dikembangkan untuk mendukung proses pengelolaan,
            pencatatan, dan pencarian data SPM pada Kantor Pertanahan Kota Kendari.
        </p>

        <p>
            Sistem ini dirancang untuk meningkatkan efisiensi kerja,
            meminimalkan kesalahan pencatatan, serta mempermudah proses
            monitoring dan pengarsipan dokumen SPM secara digital.
        </p>

        <p>
            Dengan adanya sistem ini, diharapkan pengelolaan data SPM menjadi
            lebih terstruktur, transparan, dan mudah diakses sesuai kebutuhan.
        </p>

        <h3>Fitur Utama Sistem</h3>
        <ul class="list">
            <li>Pencatatan dan pengelolaan data SPM</li>
            <li>Pencarian data berdasarkan nomor SPM</li>
            <li>Kategori dan tahun anggaran</li>
            <li>Penyimpanan arsip secara digital</li>
            <li>Tampilan sederhana dan mudah digunakan</li>
        </ul>

        <footer>
            © {{ date('Y') }} | Kantor Pertanahan Kota Kendari
        </footer>

    </div>
</div>

</body>
</html>

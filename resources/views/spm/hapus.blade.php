<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>SIPAM</title>
    <link rel="icon" href="{{ asset('images/ATR2.jpg') }}" type="image/jpg">
    <!-- ICON -->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>

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
            background: rgba(0, 0, 0, 0.6);
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

        main {
            padding: 140px 20px 40px;
            max-width: 700px;
            margin: auto;
            position: relative;
            z-index: 1;
        }

        .card {
            background: rgba(255,255,255,0.15);
            backdrop-filter: blur(16px);
            border-radius: 22px;
            padding: 35px;
            text-align: center;
        }

        .card i {
            font-size: 50px;
            color: #ff7675;
            margin-bottom: 15px;
        }

        .card h2 {
            margin-bottom: 10px;
        }

        .card p {
            margin-bottom: 25px;
            font-size: 15px;
        }

        .detail {
            background: rgba(0,0,0,0.35);
            padding: 15px;
            border-radius: 14px;
            margin-bottom: 25px;
            text-align: left;
        }

        .detail b {
            color: #f9ca24;
        }

        .btn-group {
            display: flex;
            justify-content: center;
            gap: 15px;
        }

        .btn-delete {
            background: #ff7675;
            color: #000;
            padding: 12px 24px;
            border-radius: 14px;
            font-weight: bold;
            border: none;
            cursor: pointer;
        }

        .btn-back {
            background: rgba(255,255,255,0.2);
            color: #fff;
            padding: 12px 24px;
            border-radius: 14px;
            text-decoration: none;
            font-weight: bold;
        }
    </style>
</head>
<body>

<div class="navbar">
   <h3 class="logo">
    SIPAM
    <span>Sistem Informasi Pembayaran dan Administrasi Membayar</span>
</h3>


<main>
    <div class="card">
        <i class="fa-solid fa-triangle-exclamation"></i>

        <h2>Hapus Data SPM?</h2>
        <p>Data yang dihapus <b>tidak dapat dikembalikan</b>.</p>

        <div class="detail">
            <p><b>Nomor SPM:</b> {{ $spm->nomor_spm }}</p>
            <p><b>Tanggal:</b> {{ \Carbon\Carbon::parse($spm->tanggal_spm)->format('d-m-Y') }}</p>
            <p><b>Nilai:</b> Rp {{ number_format($spm->nilai_spm,0,',','.') }}</p>
            <p><b>Kategori:</b> {{ $spm->kategori->nama_kategori ?? '-' }}</p>
        </div>

        <form action="{{ route('spm.destroy', $spm->id) }}" method="POST">
            @csrf
            @method('DELETE')

            <div class="btn-group">
                <button type="submit" class="btn-delete">
                    <i class="fa-solid fa-trash"></i> Ya, Hapus
                </button>

                <a href="{{ route('spm.index') }}" class="btn-back">
                    <i class="fa-solid fa-arrow-left"></i> Batal
                </a>
            </div>
        </form>
    </div>
</main>

</body>
</html>

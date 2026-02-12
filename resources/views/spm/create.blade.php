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

        body::before {
            content: "";
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.6);
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
        .nav-menu {
            display: flex;
            gap: 25px;
        }

        .nav-menu a {
            color: #fff;
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
        }

        .container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 120px 20px 40px;
        }

        .form-box {
            background: rgba(255,255,255,0.15);
            backdrop-filter: blur(14px);
            padding: 40px;
            border-radius: 22px;
            width: 100%;
            max-width: 600px;
            box-shadow: 0 25px 60px rgba(0,0,0,0.45);
        }

        label {
            display: block;
            margin-top: 15px;
            font-size: 14px;
            font-weight: 600;
        }

        input, select, textarea {
            width: 100%;
            padding: 12px 14px;
            border-radius: 12px;
            border: none;
            margin-top: 6px;
            font-size: 14px;
            outline: none;
        }

        /* 🔥 TEXTAREA FIXED + SCROLL */
        textarea {
            height: 110px;
            resize: none;
            overflow-y: auto;
        }

        /* Scrollbar cantik */
        textarea::-webkit-scrollbar {
            width: 6px;
        }

        textarea::-webkit-scrollbar-thumb {
            background: #f9ca24;
            border-radius: 10px;
        }

        /* KHUSUS LINK DRIVE */
        .link-drive-box {
            background: #f1f2f6;
            color: #2d3436;
            border: 2px solid transparent;
            transition: all 0.3s ease;
        }

        .link-drive-box:focus {
            border: 2px solid #f9ca24;
            box-shadow: 0 0 8px rgba(249,202,36,0.6);
        }

        small {
            display: block;
            margin-top: 6px;
            color: #ff7675;
        }

        button {
            width: 100%;
            margin-top: 20px;
            padding: 14px;
            border: none;
            border-radius: 14px;
            font-size: 15px;
            font-weight: bold;
            cursor: pointer;
            background: #888f05;
            color: white;
        }

        .btn-back {
            background: #636e72;
        }

        .error-box {
            background: #ff7675;
            padding: 15px;
            border-radius: 12px;
            margin-bottom: 20px;
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
        <a href="{{ url('/') }}">Beranda</a>
        <a href="{{ route('tentang') }}">Tentang Sistem</a>
    </div>
</div>

<div class="container">
    <div class="form-box">

        <h2>Input Data SPM</h2>

        @if ($errors->any())
            <div class="error-box">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('spm.store') }}">
            @csrf

            <label>Nomor SPM</label>
            <input type="text" name="nomor_spm" value="{{ old('nomor_spm') }}" required>

            <label>Tanggal SPM</label>
            <input type="date" name="tanggal_spm" value="{{ old('tanggal_spm') }}" required>

            <label>Nilai SPM</label>
            <input type="number" name="nilai_spm" min="0" value="{{ old('nilai_spm') }}" required>

            <label>Kategori</label>
            <select name="kategori_id" required>
                <option value="">-- Pilih Kategori --</option>
                @foreach ($kategoris as $kat)
                    <option value="{{ $kat->id }}"
                        {{ old('kategori_id') == $kat->id ? 'selected' : '' }}>
                        {{ $kat->nama_kategori }}
                    </option>
                @endforeach
            </select>

            <label>Uraian</label>
            <textarea name="uraian" required>{{ old('uraian') }}</textarea>

            <label>Tahun Anggaran</label>
            <input type="number" name="tahun_anggaran"
                   value="{{ old('tahun_anggaran', date('Y')) }}" required>

            <label>Status Scan</label>
            <select name="status_scan" required>
                <option value="">-- Pilih Status Scan --</option>
                <option value="belum" {{ old('status_scan') == 'belum' ? 'selected' : '' }}>
                    Belum Scan
                </option>
                <option value="sudah" {{ old('status_scan') == 'sudah' ? 'selected' : '' }}>
                    Sudah Scan
                </option>
            </select>

            <div class="form-group">
    <label>Link Google Drive</label>
    <input type="text" name="link_drive" class="form-control"
           placeholder="Masukkan link drive">
</div>

            
            <button type="submit"
                onclick="this.disabled=true; this.form.submit();">
                Simpan Data SPM
            </button>

            <button type="button" class="btn-back"
                onclick="window.location.href='{{ route('spm.index') }}'">
                Kembali
            </button>

        </form>

    </div>
</div>

</body>
</html>

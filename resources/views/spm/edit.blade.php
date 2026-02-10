<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Data SPM | Kantor Pertanahan Kota Kendari</title>

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

        .navbar h3 {
            margin: 0;
            font-size: 18px;
        }

        .navbar span {
            color: #f9ca24;
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

        main {
            padding: 120px 20px 40px;
            max-width: 900px;
            margin: auto;
            position: relative;
            z-index: 1;
        }

        .card {
            background: rgba(255,255,255,0.15);
            backdrop-filter: blur(16px);
            border-radius: 22px;
            padding: 30px;
        }

        .card h2 {
            margin-bottom: 25px;
        }

        label {
            font-size: 14px;
            font-weight: 600;
        }

        input, select, textarea {
            width: 100%;
            padding: 12px 16px;
            border-radius: 12px;
            border: none;
            margin-top: 6px;
            margin-bottom: 18px;
            outline: none;
        }

        textarea {
            resize: vertical;
        }

        .btn-group {
            display: flex;
            gap: 15px;
            margin-top: 10px;
        }

        .btn-save {
            background: #f9ca24;
            color: #000;
            padding: 12px 22px;
            border-radius: 14px;
            font-weight: bold;
            border: none;
            cursor: pointer;
        }

        .btn-back {
            background: rgba(255,255,255,0.2);
            color: #fff;
            padding: 12px 22px;
            border-radius: 14px;
            text-decoration: none;
            font-weight: bold;
        }

        .error {
            background: #ff7675;
            color: #000;
            padding: 12px 18px;
            border-radius: 14px;
            margin-bottom: 18px;
        }
    </style>
</head>
<body>

<div class="navbar">
    <h3>Sistem <span>SPM</span></h3>
    <div class="nav-menu">
        <a href="{{ route('spm.index') }}">Data SPM</a>
        <a href="{{ route('tentang') }}">Tentang Sistem</a>
    </div>
</div>

<main>

    <div class="card">
        <h2><i class="fa-solid fa-pen-to-square"></i> Edit Data SPM</h2>

        @if ($errors->any())
            <div class="error">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('spm.update', $spm->id) }}">
            @csrf
            @method('PUT')

            <label>Nomor SPM</label>
            <input type="text" name="nomor_spm"
                   value="{{ old('nomor_spm', $spm->nomor_spm) }}">

            <label>Tanggal SPM</label>
            <input type="date" name="tanggal_spm"
                   value="{{ old('tanggal_spm', $spm->tanggal_spm) }}">

            <label>Nilai SPM</label>
            <input type="number" name="nilai_spm"
                   value="{{ old('nilai_spm', $spm->nilai_spm) }}">

            <label>Kategori</label>
            <select name="kategori_id">
                @foreach($kategoris as $kat)
                    <option value="{{ $kat->id }}"
                        {{ $spm->kategori_id == $kat->id ? 'selected' : '' }}>
                        {{ $kat->nama_kategori }}
                    </option>
                @endforeach
            </select>

            <label>Status Scan</label>
            <select name="status_scan">
                <option value="sudah" {{ $spm->status_scan === 'sudah' ? 'selected' : '' }}>✔ Sudah Scan</option>
                <option value="belum" {{ $spm->status_scan === 'belum' ? 'selected' : '' }}>✘ Belum Scan</option>
            </select>

            <label>Uraian</label>
            <textarea name="uraian">{{ old('uraian', $spm->uraian) }}</textarea>

            <label>Tahun Anggaran</label>
            <input type="number" name="tahun_anggaran"
                   value="{{ old('tahun_anggaran', $spm->tahun_anggaran) }}">

            <div class="btn-group">
                <button type="submit" class="btn-save">
                    <i class="fa-solid fa-floppy-disk"></i> Update
                </button>

                <a href="{{ route('spm.index') }}" class="btn-back">
                    <i class="fa-solid fa-arrow-left"></i> Kembali
                </a>
            </div>
        </form>
    </div>

</main>

</body>
</html>

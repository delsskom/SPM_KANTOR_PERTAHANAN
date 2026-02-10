<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data SPM | Kantor Pertanahan Kota Kendari</title>

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
            max-width: 1200px;
            margin: auto;
            position: relative;
            z-index: 1;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .btn-add {
            background: #888f05;
            color: white;
            padding: 12px 22px;
            border-radius: 14px;
            text-decoration: none;
            font-weight: bold;
        }

        .search-box {
            background: rgba(255,255,255,0.15);
            backdrop-filter: blur(14px);
            padding: 18px;
            border-radius: 18px;
            margin-bottom: 25px;
            display: flex;
            gap: 10px;
        }

        .search-box input {
            flex: 1;
            padding: 12px 16px;
            border-radius: 12px;
            border: none;
            outline: none;
        }

        .search-box button {
            padding: 12px 24px;
            border: none;
            background: #f9ca24;
            color: #000;
            border-radius: 12px;
            font-weight: bold;
            cursor: pointer;
        }

        .table-wrapper {
            background: rgba(255,255,255,0.15);
            backdrop-filter: blur(16px);
            border-radius: 22px;
            padding: 20px;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            color: white;
        }

        table thead {
            background: rgba(0,0,0,0.35);
        }

        table th, table td {
            padding: 14px 16px;
            text-align: left;
            font-size: 14px;
        }

        table tbody tr {
            border-bottom: 1px solid rgba(255,255,255,0.15);
        }

        .nilai {
            font-weight: bold;
            color: #f9ca24;
        }
    </style>
</head>
<body>

<div class="navbar">
    <h3>Sistem <span>SPM</span></h3>
    <div class="nav-menu">
        <a href="{{ url('/') }}">Beranda</a>
        <a href="{{ route('tentang') }}">Tentang Sistem</a>
    </div>
</div>

<main>

    <div class="header">
        <h2>Data SPM Kantor Pertanahan Kota Kendari</h2>
        <a href="{{ route('spm.create') }}" class="btn-add">+ Tambah SPM</a>
    </div>

    <form class="search-box" method="GET">
        <input type="text" name="cari" placeholder="Cari Nomor SPM..." value="{{ request('cari') }}">
        <button type="submit">Cari</button>
    </form>

    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nomor SPM</th>
                    <th>Tanggal</th>
                    <th>Nilai</th>
                    <th>Kategori</th>
                    <th>Uraian</th>
                </tr>
            </thead>
            <tbody>
                @forelse($spms as $s)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $s->nomor_spm }}</td>
                    <td>{{ \Carbon\Carbon::parse($s->tanggal_spm)->format('d-m-Y') }}</td>
                    <td class="nilai">
                        Rp {{ number_format($s->nilai_spm, 0, ',', '.') }}
                    </td>
                    <td>
                        {{ $s->kategori->nama_kategori ?? '-' }}
                    </td>
                    <td>
                        {{ $s->uraian }}
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="text-align:center; padding:30px;">
                        Data SPM belum tersedia
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</main>

</body>
</html>

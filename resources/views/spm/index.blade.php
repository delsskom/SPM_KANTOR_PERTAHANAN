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

        /* overlay gelap */
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
    letter-spacing: 1px;
}

.navbar span {
    color: #f9ca24;
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


        /* ===== MAIN ===== */
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

        .header h2 {
            margin: 0;
            font-size: 26px;
        }

        .btn-add {
            background: #888f05;
            color: white;
            padding: 12px 22px;
            border-radius: 14px;
            text-decoration: none;
            font-weight: bold;
            transition: 0.3s;
        }

        .btn-add:hover {
            transform: scale(1.05);
        }

        /* SEARCH */
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
            font-size: 14px;
        }

        .search-box button {
            padding: 12px 24px;
            border: none;
            background: #f9ca24;
            color: #000;
            border-radius: 12px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
        }

        .search-box button:hover {
            transform: scale(1.05);
        }

        /* TABLE */
        .table-wrapper {
            background: rgba(255,255,255,0.15);
            backdrop-filter: blur(16px);
            border-radius: 22px;
            padding: 20px;
            box-shadow: 0 25px 60px rgba(0,0,0,0.45);
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
            transition: 0.2s;
        }

        table tbody tr:hover {
            background: rgba(255,255,255,0.12);
        }

        .nilai {
            font-weight: bold;
            color: #f9ca24;
        }

        /* FOOTER */
        footer {
            margin-top: 100px;
            text-align: center;
            font-size: 13px;
            opacity: 0.85;
        }

        @media (max-width: 768px) {
            .header {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }
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
        <a href="/spm/create" class="btn-add">+ Tambah SPM</a>
    </div>

    <!-- SEARCH -->
    <form class="search-box" method="GET">
        <input type="text" name="cari" placeholder="Cari Nomor SPM..." value="{{ request('cari') }}">
        <button type="submit">Cari</button>
    </form>

    <!-- TABLE -->
    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nomor SPM</th>
                    <th>Tanggal</th>
                    <th>Nilai</th>
                    <th>Uraian</th>
                </tr>
            </thead>
            <tbody>
                @forelse($spms as $s)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $s->nomor_spm }}</td>
                    <td>{{ $s->tanggal_spm }}</td>
                    <td class="nilai">
                        Rp {{ number_format($s->nilai_spm, 0, ',', '.') }}
                    </td>
                    <td>{{ $s->uraian }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" style="text-align:center; padding:20px;">
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

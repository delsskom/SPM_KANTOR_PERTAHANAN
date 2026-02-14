<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>SIPAM</title>
    <link rel="icon" href="{{ asset('images/ATR2.jpg') }}" type="image/jpg">

    <!-- ICON -->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css      ">

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
            flex-wrap: wrap;
        }

        .search-box input {
            flex: 1;
            min-width: 220px;
            padding: 12px 16px;
            border-radius: 12px;
            border: none;
            outline: none;
        }

        .search-box select {
            padding: 12px 16px;
            border-radius: 12px;
            border: none;
            outline: none;
            min-width: 180px;
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

        .aksi a,
        .aksi button {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            margin-right: 10px;
            font-weight: bold;
            font-size: 14px;
            background: none;
            border: none;
            cursor: pointer;
            color: inherit;
            padding: 0;
        }

        .aksi .edit {
            color: #00cec9;
            text-decoration: none;
        }

        .aksi .hapus {
            color: #ff7675;
        }
        
        .alert {
            background: #2ecc71;
            color: #000;
            padding: 14px 18px;
            border-radius: 14px;
            margin-bottom: 20px;
            font-weight: bold;
        }

        /* 🔥 Badge Status Scan */
        .badge {
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
            display: inline-block;
        }

        .badge-sudah { background: #2ecc71; color: #000; }
        .badge-belum { background: #e74c3c; color: #fff; }
         
        .drive {
    background: #27ae60;
    color: white;
    padding: 6px 12px;
    border-radius: 10px;
    text-decoration: none;
    font-weight: bold;
    font-size: 13px;
    display: inline-flex;
    align-items: center;
    gap: 6px;
}

        /* 🔥 🔥 🔥 PAGINATION STYLE 🔥 🔥 🔥 */
        .pagination-wrapper {
            margin-top: 30px;
            background: rgba(255,255,255,0.15);
            backdrop-filter: blur(16px);
            border-radius: 22px;
            padding: 25px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
        }

        .pagination-info {
            font-size: 14px;
            color: #f9ca24;
            font-weight: bold;
        }

        .pagination {
            display: flex;
            gap: 8px;
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .pagination li {
            display: inline-block;
        }

        .pagination a,
        .pagination span {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 10px;
            text-decoration: none;
            font-weight: bold;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .pagination .page-link {
            background: rgba(255,255,255,0.1);
            color: white;
        }

        .pagination .page-link:hover {
            background: rgba(255,255,255,0.25);
            transform: translateY(-2px);
        }

        .pagination .active span {
            background: #f9ca24;
            color: #000;
            box-shadow: 0 4px 12px rgba(249, 202, 36, 0.3);
        }

        .pagination .disabled span {
            background: rgba(255,255,255,0.05);
            color: #666;
            cursor: not-allowed;
        }

        .pagination .arrow {
            width: 50px;
        }

        @media (max-width: 768px) {
            .pagination-wrapper {
                flex-direction: column;
                gap: 20px;
            }
            
            .pagination {
                flex-wrap: wrap;
                justify-content: center;
            }
        }

        /* 🔥 Badge Role User */
        .user-info {
            display: flex;
            align-items: center;
            gap: 10px;
            background: rgba(255,255,255,0.1);
            padding: 8px 16px;
            border-radius: 12px;
            backdrop-filter: blur(8px);
        }

        .user-name {
            font-size: 14px;
            font-weight: 600;
            color: #f9ca24;
        }

        .role-badge {
            padding: 4px 10px;
            border-radius: 8px;
            font-size: 11px;
            font-weight: bold;
            display: inline-block;
        }

        .role-admin { background: #2ecc71; color: #000; }
        .role-user { background: #3498db; color: #fff; }

        /* 🔥 Logout Button */
        .logout-btn {
            background: #e74c3c;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: bold;
            font-size: 13px;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s ease;
        }

        .logout-btn:hover {
            background: #c0392b;
            transform: translateY(-2px);
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
        
        <!-- 🔥 Info User Login -->
        @if(auth()->check())
            <div class="user-info">
                <span class="user-name">{{ auth()->user()->name }}</span>
                <span class="role-badge {{ auth()->user()->role === 'admin' ? 'role-admin' : 'role-user' }}">
                    {{ ucfirst(auth()->user()->role) }}
                </span>
                <a href="{{ route('logout') }}" 
                   class="logout-btn"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fa-solid fa-right-from-bracket"></i> Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        @else
            <a href="{{ route('login') }}" class="btn-add">
                <i class="fa-solid fa-right-to-bracket"></i> Login
            </a>
        @endif
    </div>
</div>

<main>

    <div class="header">
        <h2>Data SPM Kantor Pertanahan Kota Kendari</h2>
        
        <!-- 🔥 Tombol Tambah SPM hanya untuk Admin -->
        @if(auth()->check() && auth()->user()->role === 'admin')
            <a href="{{ route('spm.create') }}" class="btn-add">
                <i class="fa-solid fa-plus"></i> Tambah SPM
            </a>
        @endif
    </div>

    @if(session('success'))
        <div class="alert">
            {{ session('success') }}
        </div>
    @endif

    <!-- 🔥 FORM SEARCH + FILTER -->
    <form method="GET" action="{{ route('spm.index') }}" class="search-box">

        <input type="text" name="cari"
               placeholder="Cari Nomor SPM / Kategori / Tahun..."
               value="{{ request('cari') }}">

        <!-- FILTER KATEGORI -->
        <select name="kategori">
            <option value="">-- Semua Kategori --</option>
            @foreach ($kategoris as $kat)
                <option value="{{ $kat->id }}" {{ request('kategori') == $kat->id ? 'selected' : '' }}>
                    {{ $kat->nama_kategori }}
                </option>
            @endforeach
        </select>

        <!-- FILTER TAHUN -->
        <select name="tahun">
            <option value="">-- Semua Tahun --</option>
            @for ($t = date('Y'); $t >= 2015; $t--)
                <option value="{{ $t }}" {{ request('tahun') == $t ? 'selected' : '' }}>
                    {{ $t }}
                </option>
            @endfor
        </select>

        <button type="submit">Cari</button>
    </form>

    <!-- TABEL DATA -->
    <div class="table-wrapper">
        <table>
            <thead>
            <tr>
                <th>No</th>
                <th>Nomor SPM</th>
                <th>Tanggal</th>
                <th>Nilai</th>
                <th>Kategori</th>
                <th>Status Scan</th>
                <th>Uraian</th>
                <th>Link Drive</th>
                
                <!-- 🔥 Kolom Aksi hanya untuk Admin -->
                @if(auth()->check() && auth()->user()->role === 'admin')
                    <th>Aksi</th>
                @endif
            </tr>
            </thead>
            <tbody>
            @forelse($spms as $s)
                <tr>
                    <td>{{ $loop->iteration + ($spms->currentPage() - 1) * $spms->perPage() }}</td>
                    <td>{{ $s->nomor_spm }}</td>
                    <td>{{ \Carbon\Carbon::parse($s->tanggal_spm)->format('d-m-Y') }}</td>
                    <td class="nilai">Rp {{ number_format($s->nilai_spm, 0, ',', '.') }}</td>
                    <td>{{ $s->kategori->nama_kategori ?? '-' }}</td>

                    <!-- STATUS SCAN -->
                    <td>
                        @if($s->status_scan === 'sudah')
                            <span class="badge badge-sudah">✔ Sudah Scan</span>
                        @else
                            <span class="badge badge-belum">✘ Belum Scan</span>
                        @endif
                    </td>

                   <td>{{ $s->uraian }}</td>

<td>
    @if($s->link_drive)
        <a href="{{ $s->link_drive }}" target="_blank" class="drive">
            <i class="fa-brands fa-google-drive"></i> Drive
        </a>
    @else
        <span style="color:#ccc;">Tidak ada</span>
    @endif
</td>


                    <!-- 🔥 Kolom Aksi hanya untuk Admin -->
                    @if(auth()->check() && auth()->user()->role === 'admin')
                    <td class="aksi">
                        <a href="{{ route('spm.edit', $s->id) }}" class="edit">
                            <i class="fa-solid fa-pen-to-square"></i> Edit
                        </a>

                        <form action="{{ route('spm.destroy', $s->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="hapus"
                                    onclick="return confirm('Yakin hapus data SPM ini?')">
                                <i class="fa-solid fa-trash"></i> Hapus
                            </button>
                        </form>
                    </td>
                    @endif
                </tr>
            @empty
                <tr>
                    <td colspan="{{ auth()->check() && auth()->user()->role === 'admin' ? 9 : 8 }}" style="text-align:center; padding:30px;">
                        Data SPM belum tersedia
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    <!-- 🔥 🔥 🔥 PAGINATION 🔥 🔥 🔥 -->
    @if($spms->hasPages())
    <div class="pagination-wrapper">
        <div class="pagination-info">
            Menampilkan {{ $spms->firstItem() }} - {{ $spms->lastItem() }} dari {{ $spms->total() }} data
        </div>

        <ul class="pagination">
            {{-- Previous Page Link --}}
            @if ($spms->onFirstPage())
                <li class="disabled">
                    <span class="arrow">❮</span>
                </li>
            @else
                <li>
                    <a href="{{ $spms->previousPageUrl() }}" class="page-link arrow">❮</a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($spms->getUrlRange(1, $spms->lastPage()) as $page => $url)
                @if ($page == $spms->currentPage())
                    <li class="active">
                        <span>{{ $page }}</span>
                    </li>
                @else
                    <li>
                        <a href="{{ $url }}" class="page-link">{{ $page }}</a>
                    </li>
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($spms->hasMorePages())
                <li>
                    <a href="{{ $spms->nextPageUrl() }}" class="page-link arrow">❯</a>
                </li>
            @else
                <li class="disabled">
                    <span class="arrow">❯</span>
                </li>
            @endif
        </ul>
    </div>
    @endif

</main>

</body>
</html>
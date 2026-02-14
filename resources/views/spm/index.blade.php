<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>SIPAM</title>
<link rel="icon" href="{{ asset('images/ATR2.jpg') }}" type="image/jpg">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<style>
*{box-sizing:border-box;font-family:'Segoe UI',Tahoma,Geneva,Verdana,sans-serif;}

body{
margin:0;min-height:100vh;color:white;overflow-x:hidden;
background-image:url('{{ asset("images/atr.jpg") }}');
background-size:cover;background-position:center;
background-repeat:no-repeat;background-attachment:fixed;
}

body::before{
content:"";position:fixed;inset:0;
background:rgba(0,0,0,.6);z-index:-1;
}

.navbar{
position:fixed;top:0;left:0;right:0;
padding:18px 40px;
display:flex;justify-content:space-between;
align-items:center;
background:rgba(0,0,0,.45);
backdrop-filter:blur(8px);
z-index:10;
}

.logo{margin:0;font-size:20px;}
.logo span{display:block;font-size:14px;color:#f9ca24;}

.nav-menu{display:flex;gap:25px;align-items:center;}
.nav-menu a{color:#fff;text-decoration:none;font-size:14px;font-weight:600;}

.user-area{display:flex;align-items:center;gap:14px;}
.user-name{font-size:14px;font-weight:600;color:#f9ca24;}

.btn-logout{
background:#e74c3c;color:#fff;
padding:8px 14px;border-radius:12px;
border:none;cursor:pointer;
}

main{padding:120px 20px 40px;max-width:1200px;margin:auto;}

.header{
display:flex;justify-content:space-between;
align-items:center;margin-bottom:25px;
}

.btn-add{
background:#888f05;color:white;
padding:12px 22px;border-radius:14px;
text-decoration:none;font-weight:bold;
}

.search-box{
background:rgba(255,255,255,.15);
backdrop-filter:blur(14px);
padding:18px;border-radius:18px;
margin-bottom:25px;
display:flex;gap:10px;flex-wrap:wrap;
}

.search-box input,.search-box select{
padding:12px 16px;border-radius:12px;
border:none;outline:none;
}

.search-box button{
padding:12px 24px;border:none;
background:#f9ca24;color:#000;
border-radius:12px;font-weight:bold;
cursor:pointer;
}

.table-wrapper{
background:rgba(255,255,255,.15);
backdrop-filter:blur(16px);
border-radius:22px;padding:20px;
}

table{width:100%;border-collapse:collapse;color:white;}
thead{background:rgba(0,0,0,.35);}
th,td{padding:14px;font-size:14px;}
tbody tr{border-bottom:1px solid rgba(255,255,255,.15);}

.nilai{font-weight:bold;color:#f9ca24;}

.badge{padding:6px 14px;border-radius:20px;font-size:12px;font-weight:bold;}
.badge-sudah{background:#2ecc71;color:#000;}
.badge-belum{background:#e74c3c;}

.drive{
background:#27ae60;color:white;
padding:6px 12px;border-radius:10px;
text-decoration:none;font-size:13px;
}

.alert{
background:#2ecc71;color:#000;
padding:14px;border-radius:14px;
margin-bottom:20px;font-weight:bold;
}

/* === AKSI BUTTONS BAGUS === */

.aksi{
display:flex;
gap:8px;
align-items:center;
}

.btn-aksi{
padding:7px 14px;
border-radius:12px;
font-size:13px;
font-weight:600;
display:inline-flex;
align-items:center;
gap:6px;
border:none;
cursor:pointer;
text-decoration:none;
}

.btn-edit{
background:#00cec9;
color:#000;
}

.btn-edit:hover{background:#00b5ad;}

.btn-hapus{
background:#ff7675;
color:white;
}

.btn-hapus:hover{background:#e55050;}

</style>
</head>

<body>

<div class="navbar">
<h3 class="logo">
SIPAM
<span>Sistem Informasi Pembayaran dan Administrasi Membayar</span>
</h3>

<div class="nav-menu">
<a href="{{ route('spm.index') }}">Beranda</a>
<a href="{{ route('tentang') }}">Tentang Sistem</a>

@if(auth()->check())
<div class="user-area">
<span class="user-name">Halo, {{ auth()->user()->name }}</span>

<form method="POST" action="{{ route('logout') }}">
@csrf
<button class="btn-logout">Logout</button>
</form>
</div>
@endif
</div>
</div>

<main>

<div class="header">
<h2>Data SPM Kantor Pertanahan Kota Kendari</h2>

@if(auth()->check() && auth()->user()->role === 'admin')
<a href="{{ route('spm.create') }}" class="btn-add">
Tambah SPM
</a>
@endif
</div>

@if(session('success'))
<div class="alert">{{ session('success') }}</div>
@endif

<form method="GET" action="{{ route('spm.index') }}" class="search-box">

<input type="text" name="cari"
placeholder="Cari Nomor SPM..."
value="{{ request('cari') }}">

<select name="kategori">
<option value="">-- Semua Kategori --</option>
@foreach ($kategoris as $kat)
<option value="{{ $kat->id }}"
{{ request('kategori') == $kat->id ? 'selected' : '' }}>
{{ $kat->nama_kategori }}
</option>
@endforeach
</select>

<select name="tahun">
<option value="">-- Semua Tahun --</option>
@for ($t=date('Y'); $t>=2015; $t--)
<option value="{{ $t }}"
{{ request('tahun')==$t?'selected':'' }}>
{{ $t }}
</option>
@endfor
</select>

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
<th>Status Scan</th>
<th>Uraian</th>
<th>Link Drive</th>

@if(auth()->check() && auth()->user()->role === 'admin')
<th>Aksi</th>
@endif
</tr>
</thead>

<tbody>
@forelse($spms as $s)
<tr>
<td>{{ $loop->iteration }}</td>
<td>{{ $s->nomor_spm }}</td>
<td>{{ \Carbon\Carbon::parse($s->tanggal_spm)->format('d-m-Y') }}</td>
<td class="nilai">Rp {{ number_format($s->nilai_spm,0,',','.') }}</td>
<td>{{ $s->kategori->nama_kategori ?? '-' }}</td>

<td>
@if($s->status_scan==='sudah')
<span class="badge badge-sudah">Sudah</span>
@else
<span class="badge badge-belum">Belum</span>
@endif
</td>

<td>{{ $s->uraian }}</td>

<td>
@if($s->link_drive)
<a href="{{ $s->link_drive }}" target="_blank" class="drive">Drive</a>
@else
Tidak ada
@endif
</td>

@if(auth()->check() && auth()->user()->role === 'admin')
<td class="aksi">

<a href="{{ route('spm.edit',$s->id) }}" class="btn-aksi btn-edit">
<i class="fa-solid fa-pen"></i> Edit
</a>

<form action="{{ route('spm.destroy',$s->id) }}"
method="POST"
onsubmit="return confirm('Yakin hapus data?')">
@csrf
@method('DELETE')
<button type="submit" class="btn-aksi btn-hapus">
<i class="fa-solid fa-trash"></i> Hapus
</button>
</form>

</td>
@endif

</tr>
@empty
<tr>
<td colspan="9" style="text-align:center">
Data belum ada
</td>
</tr>
@endforelse
</tbody>
</table>
</div>

</main>
</body>
</html>

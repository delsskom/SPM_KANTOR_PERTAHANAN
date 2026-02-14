<?php

namespace App\Http\Controllers;

use App\Models\Spm;
use App\Models\Kategori;
use Illuminate\Http\Request;

class SpmController extends Controller
{
    /**
     * 🔹 Halaman Welcome / Home
     */
    public function welcome()
    {
        return view('welcome');
    }

    /**
     * 🔹 Tampilkan data SPM dengan Pagination
     * ✅ Semua user login boleh melihat
     * ❌ Tidak dibatasi admin
     */
    public function index(Request $request)
    {
        // Query builder
        $query = Spm::with('kategori');

        // 🔍 FITUR PENCARIAN
        if ($request->cari) {
            $cari = $request->cari;
            $parts = preg_split('/[\/\s]+/', $cari);

            foreach ($parts as $part) {
                $part = trim($part);
                if ($part === '') continue;

                $query->where(function ($q) use ($part) {
                    $q->where('nomor_spm', 'like', "%{$part}%")
                      ->orWhereHas('kategori', function ($q2) use ($part) {
                          $q2->where('nama_kategori', 'like', "%{$part}%");
                      })
                      ->orWhere('tahun_anggaran', 'like', "%{$part}%");
                });
            }
        }

        // 🔽 FILTER KATEGORI
        if ($request->kategori) {
            $query->where('kategori_id', $request->kategori);
        }

        // 🔽 FILTER TAHUN
        if ($request->tahun) {
            $query->where('tahun_anggaran', $request->tahun);
        }

        // 🔽 Urutkan dan paginate (10 data per halaman)
        $spms = $query->orderBy('tanggal_spm', 'desc')
                      ->paginate(10)
                      ->appends($request->except('page')); // ✅ Simpan filter saat pindah halaman

        // ambil kategori untuk dropdown filter
        $kategoris = Kategori::all();

        return view('spm.index', compact('spms', 'kategoris'));
    }

    /**
     * 🔹 Form tambah SPM
     * ❌ Hanya admin boleh akses
     */
    public function create()
    {
        // 🔒 CEK ROLE
        if(auth()->user()->role !== 'admin'){
            abort(403, 'Hanya admin yang boleh menambah data');
        }

        $kategoris = Kategori::all();

        return view('spm.create', compact('kategoris'));
    }

    /**
     * 🔹 Simpan data SPM
     * ❌ Hanya admin boleh simpan
     */
    public function store(Request $request)
    {
        // 🔒 CEK ROLE
        if(auth()->user()->role !== 'admin'){
            abort(403);
        }

        // ✅ VALIDASI
        $request->validate([
            'nomor_spm'      => 'required',
            'tanggal_spm'    => 'required|date',
            'nilai_spm'      => 'required|numeric',
            'tahun_anggaran' => 'required|digits:4',
            'kategori_id'    => 'required',
            'uraian'         => 'required',
            'link_drive'     => 'nullable|url',
            'status_scan'    => 'required|in:belum,sudah',
        ]);

        // simpan
        Spm::create($request->all());

        return redirect()->route('spm.index')
            ->with('success', 'Data berhasil disimpan');
    }

    /**
     * 🔹 Detail SPM
     * ✅ Semua user boleh lihat
     */
    public function show($id)
    {
        $spm = Spm::with('kategori')->findOrFail($id);

        return view('spm.show', compact('spm'));
    }

    /**
     * 🔹 Form edit SPM
     * ❌ Admin saja
     */
    public function edit($id)
    {
        if(auth()->user()->role !== 'admin'){
            abort(403);
        }

        $spm = Spm::findOrFail($id);
        $kategoris = Kategori::all();

        return view('spm.edit', compact('spm', 'kategoris'));
    }

    /**
     * 🔹 Update data SPM
     * ❌ Admin saja
     */
    public function update(Request $request, $id)
    {
        if(auth()->user()->role !== 'admin'){
            abort(403);
        }

        $request->validate([
            'nomor_spm'      => 'required',
            'tanggal_spm'    => 'required|date',
            'nilai_spm'      => 'required|numeric',
            'tahun_anggaran' => 'required|digits:4',
            'kategori_id'    => 'required',
            'uraian'         => 'required',
            'link_drive'     => 'nullable|url',
            'status_scan'    => 'required|in:belum,sudah',
        ]);

        $spm = Spm::findOrFail($id);
        $spm->update($request->all());

        return redirect()->route('spm.index')
            ->with('success', 'Data berhasil diupdate');
    }

    /**
     * 🔹 Hapus data SPM
     * ❌ Admin saja
     */
    public function destroy($id)
    {
        if(auth()->user()->role !== 'admin'){
            abort(403);
        }

        Spm::findOrFail($id)->delete();

        return redirect()->route('spm.index')
            ->with('success', 'Data berhasil dihapus');
    }
}
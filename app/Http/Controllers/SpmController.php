<?php

namespace App\Http\Controllers;

use App\Models\Spm;
use App\Models\Kategori;
use Illuminate\Http\Request;

class SpmController extends Controller
{
    /**
     * Halaman Welcome / Home
     */
    public function welcome()
    {
        return view('welcome');
    }

    /**
     * Tampilkan data SPM
     */
    public function index(Request $request)
    {
        $spms = Spm::with('kategori')
            ->when($request->cari, function ($query) use ($request) {
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
            })
            ->when($request->kategori, function ($query) use ($request) {
                $query->where('kategori_id', $request->kategori);
            })
            ->when($request->tahun, function ($query) use ($request) {
                $query->where('tahun_anggaran', $request->tahun);
            })
            ->orderBy('tanggal_spm', 'desc')
            ->get();

        $kategoris = Kategori::all();

        return view('spm.index', compact('spms', 'kategoris'));
    }

    /**
     * Form tambah SPM (CREATE)
     */
    public function create()
    {
        $kategoris = Kategori::all();
        return view('spm.create', compact('kategoris'));
    }

    /**
     * Simpan data SPM
     */
    public function store(Request $request)
    {
        $request->validate([
            'nomor_spm'      => 'required',
            'tanggal_spm'    => 'required|date',
            'nilai_spm'      => 'required|numeric',
            'tahun_anggaran' => 'required|digits:4',
            'kategori_id'    => 'required',
            'uraian'         => 'required',

            // ✅ TAMBAHAN LINK DRIVE
            'link_drive'     => 'nullable|url',

            'status_scan'    => 'required|in:belum,sudah',
        ]);

        Spm::create($request->all());

        return redirect()->route('spm.index')
            ->with('success', 'Data berhasil disimpan');
    }

    /**
     * Detail SPM (SHOW)
     */
    public function show($id)
    {
        $spm = Spm::with('kategori')->findOrFail($id);
        return view('spm.show', compact('spm'));
    }

    /**
     * Form edit SPM
     */
    public function edit($id)
    {
        $spm = Spm::findOrFail($id);
        $kategoris = Kategori::all();

        return view('spm.edit', compact('spm', 'kategoris'));
    }

    /**
     * Update data SPM
     */
    public function update(Request $request, $id)
    {
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
     * Hapus data SPM
     */
    public function destroy($id)
    {
        Spm::findOrFail($id)->delete();

        return redirect()->route('spm.index')
            ->with('success', 'Data berhasil dihapus');
    }
}
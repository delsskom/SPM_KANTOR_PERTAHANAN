<?php

namespace App\Http\Controllers;

use App\Models\Spm;
use App\Models\Kategori;
use Illuminate\Http\Request;

class SpmController extends Controller
{
    // 👉 halaman welcome (BENAR)
    public function welcome()
    {
        return view('welcome');
    }

    public function index(Request $request)
    {
        $spms = Spm::with('kategori')
            ->when($request->cari, function ($q) use ($request) {
                $q->where('nomor_spm', 'like', '%' . $request->cari . '%');
            })
            ->get();

        return view('spm.index', compact('spms'));
    }

    public function create()
    {
        $kategoris = Kategori::all();
        return view('spm.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nomor_spm'      => 'required|string|max:50',
            'tanggal_spm'    => 'required|date',
            'nilai_spm'      => 'required|numeric',
            'nomor_sp2d'     => 'nullable|string|max:50',
            'tanggal_sp2d'   => 'nullable|date',
            'nilai_sp2d'     => 'nullable|numeric',
            'tahun_anggaran' => 'required|digits:4',
            'kategori_id'    => 'required|exists:kategoris,id',
            'uraian'         => 'required|string',
        ]);

        Spm::create($validated);

        return redirect()->route('spm.index')
            ->with('success', 'Data SPM berhasil disimpan');
    }
}

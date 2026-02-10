<?php

namespace App\Http\Controllers;

use App\Models\Spm;
use App\Models\Kategori;
use Illuminate\Http\Request;

class SpmController extends Controller
{
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
        $request->validate([
            'nomor_spm'      => 'required',
            'tanggal_spm'    => 'required|date',
            'nilai_spm'      => 'required|numeric',
            'tahun_anggaran' => 'required|digits:4',
            'kategori_id'    => 'required',
            'uraian'         => 'required',
        ]);

        Spm::create($request->all());

        return redirect()->route('spm.index')
            ->with('success', 'Data berhasil disimpan');
    }

    public function edit($id)
    {
        $spm = Spm::findOrFail($id);
        $kategoris = Kategori::all();

        return view('spm.edit', compact('spm', 'kategoris'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nomor_spm'      => 'required',
            'tanggal_spm'    => 'required|date',
            'nilai_spm'      => 'required|numeric',
            'tahun_anggaran' => 'required|digits:4',
            'kategori_id'    => 'required',
            'uraian'         => 'required',
        ]);

        $spm = Spm::findOrFail($id);
        $spm->update($request->all());

        return redirect()->route('spm.index')
            ->with('success', 'Data berhasil diupdate');
    }

    public function destroy($id)
    {
        Spm::findOrFail($id)->delete();

        return redirect()->route('spm.index')
            ->with('success', 'Data berhasil dihapus');
    }
}

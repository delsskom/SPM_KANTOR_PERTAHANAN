<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Spm extends Model
{
    protected $fillable = [
        'nomor_spm',
        'tanggal_spm',
        'nilai_spm',
        'tahun_anggaran',
        'kategori_id',
        'uraian',
        'status_scan',
        'link_drive'
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }
}

<?php

// app/Models/Kategori.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table = 'kategoris'; // ← Pastikan nama tabel sesuai
    
    protected $fillable = ['nama_kategori'];
    
    public function spms()
    {
        return $this->hasMany(Spm::class);
    }
}
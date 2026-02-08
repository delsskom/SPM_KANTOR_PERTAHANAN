<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('spms', function (Blueprint $table) {
            $table->id();

            $table->string('nomor_spm', 50);
            $table->date('tanggal_spm');
            $table->decimal('nilai_spm', 15, 2);

            $table->string('nomor_sp2d', 50)->nullable();
            $table->date('tanggal_sp2d')->nullable();
            $table->decimal('nilai_sp2d', 15, 2)->nullable();

            $table->year('tahun_anggaran');

            $table->foreignId('kategori_id')
                  ->constrained('kategoris')
                  ->cascadeOnDelete();

            $table->text('uraian');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('spms');
    }
};

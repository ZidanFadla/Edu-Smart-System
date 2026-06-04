<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('nilais', function (Blueprint $table) {
            $table->id();
            $table->foreignId('siswa_id')->constrained('siswas')->cascadeOnDelete();
            $table->foreignId('guru_id')->constrained('gurus')->cascadeOnDelete();
            $table->string('mata_pelajaran');
            $table->decimal('nilai_tugas', 5, 2);
            $table->decimal('nilai_uts', 5, 2);
            $table->decimal('nilai_uas', 5, 2);
            $table->decimal('nilai_akhir', 5, 2);
            $table->enum('status_kelulusan', ['Lulus', 'Tidak Lulus']);
            $table->enum('status_validasi', ['pending', 'valid'])->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('nilais');
    }
};

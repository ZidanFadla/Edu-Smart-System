<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('mapels')) {
            Schema::create('mapels', function (Blueprint $table) {
                $table->id();
                $table->string('kode_mapel')->unique();
                $table->string('nama_mapel');
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('mapels');
    }
};

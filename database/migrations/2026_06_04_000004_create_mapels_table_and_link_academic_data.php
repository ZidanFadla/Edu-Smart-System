<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

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

        $this->migrateExistingMapelNames();

        if (! Schema::hasColumn('gurus', 'mapel_id')) {
            Schema::table('gurus', function (Blueprint $table) {
                $table->foreignId('mapel_id')->nullable()->after('user_id')->constrained('mapels')->nullOnDelete();
            });
        }

        if (! Schema::hasColumn('nilais', 'mapel_id')) {
            Schema::table('nilais', function (Blueprint $table) {
                $table->foreignId('mapel_id')->nullable()->after('guru_id')->constrained('mapels')->nullOnDelete();
            });
        }

        $this->fillMapelRelations();

        Schema::table('gurus', function (Blueprint $table) {
            if (Schema::hasColumn('gurus', 'mata_pelajaran')) {
                $table->dropColumn('mata_pelajaran');
            }
        });

        Schema::table('nilais', function (Blueprint $table) {
            if (Schema::hasColumn('nilais', 'mata_pelajaran')) {
                $table->dropColumn('mata_pelajaran');
            }
        });
    }

    public function down(): void
    {
        Schema::table('nilais', function (Blueprint $table) {
            $table->string('mata_pelajaran')->nullable()->after('guru_id');
        });

        Schema::table('gurus', function (Blueprint $table) {
            $table->string('mata_pelajaran')->nullable()->after('nama_guru');
        });

        DB::table('gurus')
            ->leftJoin('mapels', 'gurus.mapel_id', '=', 'mapels.id')
            ->update(['gurus.mata_pelajaran' => DB::raw('mapels.nama_mapel')]);

        DB::table('nilais')
            ->leftJoin('mapels', 'nilais.mapel_id', '=', 'mapels.id')
            ->update(['nilais.mata_pelajaran' => DB::raw('mapels.nama_mapel')]);

        Schema::table('nilais', function (Blueprint $table) {
            $table->dropConstrainedForeignId('mapel_id');
        });

        Schema::table('gurus', function (Blueprint $table) {
            $table->dropConstrainedForeignId('mapel_id');
        });

        Schema::dropIfExists('mapels');
    }

    private function migrateExistingMapelNames(): void
    {
        $guruMapels = Schema::hasColumn('gurus', 'mata_pelajaran')
            ? DB::table('gurus')->whereNotNull('mata_pelajaran')->pluck('mata_pelajaran')
            : collect();

        $nilaiMapels = Schema::hasColumn('nilais', 'mata_pelajaran')
            ? DB::table('nilais')->whereNotNull('mata_pelajaran')->pluck('mata_pelajaran')
            : collect();

        $guruMapels
            ->merge($nilaiMapels)
            ->filter()
            ->unique()
            ->values()
            ->each(function (string $namaMapel, int $index): void {
                DB::table('mapels')->updateOrInsert(
                    ['nama_mapel' => $namaMapel],
                    [
                        'kode_mapel' => $this->makeKodeMapel($namaMapel, $index + 1),
                        'created_at' => now(),
                        'updated_at' => now(),
                    ],
                );
            });
    }

    private function fillMapelRelations(): void
    {
        if (Schema::hasColumn('gurus', 'mata_pelajaran')) {
            DB::table('gurus')->whereNotNull('mata_pelajaran')->orderBy('id')->each(function ($guru): void {
                $mapelId = DB::table('mapels')->where('nama_mapel', $guru->mata_pelajaran)->value('id');
                DB::table('gurus')->where('id', $guru->id)->update(['mapel_id' => $mapelId]);
            });
        }

        if (Schema::hasColumn('nilais', 'mata_pelajaran')) {
            DB::table('nilais')->whereNotNull('mata_pelajaran')->orderBy('id')->each(function ($nilai): void {
                $mapelId = DB::table('mapels')->where('nama_mapel', $nilai->mata_pelajaran)->value('id');
                DB::table('nilais')->where('id', $nilai->id)->update(['mapel_id' => $mapelId]);
            });
        }
    }

    private function makeKodeMapel(string $namaMapel, int $index): string
    {
        $prefix = Str::upper(Str::substr(Str::slug($namaMapel, ''), 0, 6)) ?: 'MAPEL';

        return $prefix.str_pad((string) $index, 3, '0', STR_PAD_LEFT);
    }
};

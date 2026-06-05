<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Raport Hasil Belajar</title>
    <style>
        @page { margin: 22px 28px; }
        body { margin: 0; font-family: DejaVu Sans, sans-serif; color: #111827; font-size: 10px; }
        .raport { min-height: 740px; position: relative; }
        .page-break { page-break-after: always; }
        .header { border-bottom: 3px double #111827; padding-bottom: 10px; margin-bottom: 14px; text-align: center; }
        .brand { font-size: 11px; font-weight: bold; letter-spacing: 1px; }
        h1 { margin: 4px 0 2px; font-size: 18px; letter-spacing: .5px; }
        .subtitle { color: #4b5563; font-size: 10px; }
        .identity { width: 100%; margin-bottom: 12px; border-collapse: collapse; }
        .identity td { border: 0; padding: 2px 4px; vertical-align: top; }
        .identity .label { width: 105px; color: #374151; }
        .identity .separator { width: 8px; }
        .score-table { width: 100%; border-collapse: collapse; margin-top: 6px; }
        .score-table th, .score-table td { border: 1px solid #4b5563; padding: 5px 4px; }
        .score-table th { background: #e5e7eb; text-align: center; font-weight: bold; }
        .center { text-align: center; }
        .summary { width: 100%; margin-top: 12px; border-collapse: collapse; }
        .summary td { border: 1px solid #9ca3af; padding: 6px; }
        .summary .label { width: 150px; background: #f3f4f6; font-weight: bold; }
        .note { margin-top: 12px; border: 1px solid #9ca3af; padding: 8px; min-height: 34px; }
        .note-title { margin-bottom: 4px; font-weight: bold; }
        .signatures { width: 100%; margin-top: 24px; border-collapse: collapse; text-align: center; }
        .signatures td { width: 33.33%; border: 0; vertical-align: top; padding: 0 12px; }
        .signature-space { height: 48px; }
        .signature-name { border-bottom: 1px solid #111827; font-weight: bold; padding-bottom: 2px; }
        .footer { position: absolute; bottom: 0; left: 0; right: 0; color: #6b7280; font-size: 8px; text-align: right; }
        .empty { margin-top: 80px; text-align: center; color: #6b7280; font-size: 14px; }
    </style>
</head>
<body>
    @forelse ($raports as $raport)
        <section class="raport {{ ! $loop->last ? 'page-break' : '' }}">
            <header class="header">
                <div class="brand">SMART EDU SYSTEM</div>
                <h1>LAPORAN HASIL BELAJAR PESERTA DIDIK</h1>
                <div class="subtitle">Tahun Pelajaran {{ $tahunPelajaran }} - Semester {{ $semester }}</div>
            </header>

            <table class="identity">
                <tr>
                    <td class="label">Nama Peserta Didik</td><td class="separator">:</td>
                    <td><strong>{{ $raport['siswa']->nama }}</strong></td>
                    <td class="label">Kelas</td><td class="separator">:</td>
                    <td>{{ $raport['siswa']->kelas }}</td>
                </tr>
                <tr>
                    <td class="label">Nomor Induk Siswa</td><td class="separator">:</td>
                    <td>{{ $raport['siswa']->nis }}</td>
                    <td class="label">Semester</td><td class="separator">:</td>
                    <td>{{ $semester }}</td>
                </tr>
            </table>

            <table class="score-table">
                <thead>
                    <tr>
                        <th rowspan="2" style="width: 25px;">No.</th>
                        <th rowspan="2">Mata Pelajaran</th>
                        <th rowspan="2">Guru</th>
                        <th colspan="4">Nilai</th>
                        <th rowspan="2" style="width: 55px;">Predikat</th>
                        <th rowspan="2" style="width: 72px;">Capaian</th>
                    </tr>
                    <tr>
                        <th style="width: 42px;">Tugas</th>
                        <th style="width: 42px;">UTS</th>
                        <th style="width: 42px;">UAS</th>
                        <th style="width: 42px;">Akhir</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($raport['nilais'] as $nilai)
                        @php
                            $predikat = match (true) {
                                (float) $nilai->nilai_akhir >= 90 => 'A',
                                (float) $nilai->nilai_akhir >= 80 => 'B',
                                (float) $nilai->nilai_akhir >= 70 => 'C',
                                default => 'D',
                            };
                        @endphp
                        <tr>
                            <td class="center">{{ $loop->iteration }}</td>
                            <td>{{ $nilai->mapel?->nama_mapel }}</td>
                            <td>{{ $nilai->guru?->nama_guru }}</td>
                            <td class="center">{{ number_format((float) $nilai->nilai_tugas, 0) }}</td>
                            <td class="center">{{ number_format((float) $nilai->nilai_uts, 0) }}</td>
                            <td class="center">{{ number_format((float) $nilai->nilai_uas, 0) }}</td>
                            <td class="center"><strong>{{ number_format((float) $nilai->nilai_akhir, 2) }}</strong></td>
                            <td class="center">{{ $predikat }}</td>
                            <td class="center">{{ $nilai->status_kelulusan }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <table class="summary">
                <tr>
                    <td class="label">Rata-rata Nilai</td>
                    <td>{{ number_format($raport['rata_rata'], 2) }}</td>
                    <td class="label">Predikat Umum</td>
                    <td>{{ $raport['predikat'] }}</td>
                    <td class="label">Status</td>
                    <td>{{ $raport['status'] }}</td>
                </tr>
            </table>

            <div class="note">
                <div class="note-title">Catatan Wali Kelas</div>
                @if ($raport['rata_rata'] >= 85)
                    Pertahankan prestasi yang telah dicapai dan terus tingkatkan semangat belajar.
                @elseif ($raport['rata_rata'] >= 70)
                    Hasil belajar sudah baik. Tingkatkan kembali konsistensi dan ketelitian dalam belajar.
                @else
                    Perlu meningkatkan pemahaman materi dan mengikuti program perbaikan pada mata pelajaran terkait.
                @endif
            </div>

            <table class="signatures">
                <tr>
                    <td>
                        Mengetahui,<br>Orang Tua/Wali
                        <div class="signature-space"></div>
                        <div class="signature-name">( ................................ )</div>
                    </td>
                    <td>
                        Wali Kelas
                        <div class="signature-space"></div>
                        <div class="signature-name">( ................................ )</div>
                    </td>
                    <td>
                        {{ now()->translatedFormat('d F Y') }}<br>Kepala Sekolah
                        <div class="signature-space"></div>
                        <div class="signature-name">( ................................ )</div>
                    </td>
                </tr>
            </table>

            <div class="footer">
                Dicetak melalui Smart Edu System pada {{ now()->format('d-m-Y H:i') }}
                @if ($mapel)
                    | Filter mapel: {{ $mapel->nama_mapel }}
                @endif
            </div>
        </section>
    @empty
        <div class="empty">Tidak ada data nilai yang sesuai dengan filter.</div>
    @endforelse
</body>
</html>

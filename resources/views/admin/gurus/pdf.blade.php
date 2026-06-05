<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Guru</title>
    <style>
        @page { margin: 24px 30px; }
        body { margin: 0; font-family: DejaVu Sans, sans-serif; color: #111827; font-size: 10px; }
        .header { border-bottom: 3px double #111827; padding-bottom: 10px; text-align: center; }
        .brand { font-size: 11px; font-weight: bold; letter-spacing: 1px; }
        h1 { margin: 4px 0 2px; font-size: 18px; }
        .subtitle { color: #4b5563; }
        .meta { width: 100%; margin: 14px 0 8px; border-collapse: collapse; }
        .meta td { padding: 2px 0; border: 0; }
        .meta .right { text-align: right; }
        .data-table { width: 100%; border-collapse: collapse; }
        .data-table th, .data-table td { border: 1px solid #4b5563; padding: 6px 5px; }
        .data-table th { background: #e5e7eb; text-align: center; font-weight: bold; }
        .center { text-align: center; }
        .empty { padding: 24px 6px !important; text-align: center; color: #6b7280; }
        .summary { margin-top: 8px; color: #374151; }
        .signature { width: 100%; margin-top: 30px; border-collapse: collapse; }
        .signature td { width: 65%; border: 0; }
        .signature .signer { width: 35%; text-align: center; vertical-align: top; }
        .signature-space { height: 55px; }
        .signature-name { border-bottom: 1px solid #111827; font-weight: bold; padding-bottom: 2px; }
        .footer { position: fixed; right: 0; bottom: -10px; color: #6b7280; font-size: 8px; }
    </style>
</head>
<body>
    <header class="header">
        <div class="brand">SMART EDU SYSTEM</div>
        <h1>DAFTAR DATA GURU</h1>
        <div class="subtitle">Dokumen Data Tenaga Pengajar</div>
    </header>

    <table class="meta">
        <tr>
            <td>Tanggal cetak: {{ now()->translatedFormat('d F Y') }}</td>
            <td class="right">Jumlah guru: {{ $gurus->count() }}</td>
        </tr>
    </table>

    <table class="data-table">
        <thead>
            <tr>
                <th style="width: 32px;">No.</th>
                <th style="width: 75px;">ID Guru</th>
                <th>Nama Guru</th>
                <th>Mata Pelajaran</th>
                <th>Email Akun</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($gurus as $guru)
                <tr>
                    <td class="center">{{ $loop->iteration }}</td>
                    <td class="center">{{ $guru->id_guru }}</td>
                    <td>{{ $guru->nama_guru }}</td>
                    <td>{{ $guru->mapel?->nama_mapel ?? '-' }}</td>
                    <td>{{ $guru->user?->email ?? '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="empty">Belum ada data guru.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="summary">
        Dokumen ini berisi data guru yang tercatat pada Smart Edu System.
    </div>

    <table class="signature">
        <tr>
            <td></td>
            <td class="signer">
                {{ now()->translatedFormat('d F Y') }}<br>
                Kepala Sekolah
                <div class="signature-space"></div>
                <div class="signature-name">( ................................ )</div>
            </td>
        </tr>
    </table>

    <div class="footer">
        Dicetak melalui Smart Edu System pada {{ now()->format('d-m-Y H:i') }}
    </div>
</body>
</html>

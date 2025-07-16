<!DOCTYPE html>
<html lang="id">
    
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Semua Data Barang</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            color: #333;
        }
        .container {
            width: 95%;
            margin: 0 auto;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #333;
            padding-bottom: 10px;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
        }
        .header p {
            margin: 5px 0 0;
            font-size: 14px;
        }
        .report-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
        }
        .report-table th, .report-table td {
            border: 1px solid #999;
            padding: 8px;
            text-align: left;
        }
        .report-table th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        .text-center {
            text-align: center;
        }
        .text-right {
            text-align: right;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="header">
            <h1>Laporan Semua Data Barang</h1>
            
            @php
                // Mengatur locale Carbon ke Bahasa Indonesia
                \Carbon\Carbon::setLocale('id');
                // Mengambil tanggal saat ini dengan format Indonesia
                $tanggalIndonesia = \Carbon\Carbon::now()->translatedFormat('d F Y H:i');
            @endphp

            <p>Dicetak pada: {{ $tanggalIndonesia }}</p>
        </div>

        <table class="report-table">
            <thead>
                <tr>
                    <th class="text-center" style="width: 5%;">No</th>
                    <th style="width: 15%;">ID Barang</th>
                    <th>Nama Barang</th>
                    <th style="width: 15%;">Satuan</th>
                    <th class="text-right" style="width: 15%;">Isi per Satuan</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($barangs as $barang)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>{{ $barang->id_brg }}</td>
                        <td>{{ $barang->nama_barang }}</td>
                        <td>{{ $barang->satuan }}</td>
                        <td class="text-right">{{ $barang->isi }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">Data barang tidak ditemukan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</body>
</html>

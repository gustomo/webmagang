
<!DOCTYPE html>
<html lang="id">
    
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Semua Data Supplier</title>
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
    </style>
</head>
<body>

    <div class="container">
        <div class="header">
            <h1>Laporan Semua Data Supplier</h1>
            
            @php
                // Array nama bulan dalam Bahasa Indonesia
                $bulan = [
                    1 =>   'Januari',
                    2 =>   'Februari',
                    3 =>   'Maret',
                    4 =>   'April',
                    5 =>   'Mei',
                    6 =>   'Juni',
                    7 =>   'Juli',
                    8 =>   'Agustus',
                    9 =>   'September',
                    10 =>  'Oktober',
                    11 =>  'November',
                    12 =>  'Desember'
                ];

                // Ambil tanggal saat ini
                $sekarang = \Carbon\Carbon::now();

                // Format tanggal secara manual
                $tanggalIndonesia = $sekarang->format('d') . ' ' . $bulan[$sekarang->month] . ' ' . $sekarang->format('Y H:i');
            @endphp

            <p>Dicetak pada: {{ $tanggalIndonesia }}</p>
        </div>

        <table class="report-table">
            <thead>
                <tr>
                    <th class="text-center" style="width: 5%;">No</th>
                    <th style="width: 15%;">ID Supplier</th>
                    <th>Nama Supplier</th>
                    <th style="width: 30%;">Alamat</th>
                    <th style="width: 15%;">Kontak</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($suppliers as $supplier)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>{{ $supplier->id_sp }}</td>
                        <td>{{ $supplier->nama_supplier }}</td>
                        <td>{{ $supplier->alamat }}</td>
                        <td>{{ $supplier->kontak }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">Data tidak ditemukan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</body>
</html>
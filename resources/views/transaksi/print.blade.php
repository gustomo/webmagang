<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice {{ $transaksi->id_transaksi }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            color: #333;
        }
        .invoice-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
        }
        .header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
            border-bottom: 1px solid #eee;
            padding-bottom: 20px;
        }
        .company-info h1 {
            margin: 0;
            color: #333;
        }
        .invoice-info {
            text-align: right;
        }
        .invoice-info h2 {
            margin: 0;
            color: #555;
        }
        .details {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        .supplier-info, .invoice-meta {
            flex: 1;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table th {
            background-color: #f5f5f5;
            text-align: left;
            padding: 10px;
        }
        table td {
            padding: 10px;
            border-bottom: 1px solid #eee;
        }
        .total-section {
            text-align: right;
            margin-top: 20px;
        }
        .total-section div {
            font-size: 1.2em;
            font-weight: bold;
        }
        .footer {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #eee;
            text-align: center;
            font-size: 0.9em;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="invoice-container">
        <div class="header">
            <div class="company-info">
                <h1>CV TIGA KONEKSI</h1>
                <p>Kampus ITN Malang 2, Kota Malang</p>
                <p>Telp: 08424343223</p>
            </div>
            <div class="invoice-info">
                <h2>INVOICE</h2>
                <p>No: {{ $transaksi->id_transaksi }}</p>
                <p>Tanggal: {{ date('d/m/Y', strtotime($transaksi->tanggal_transaksi)) }}</p>
            </div>
        </div>

        <div class="details">
            <div class="supplier-info">
                <h3>Supplier:</h3>
                <p>{{ $transaksi->supplier->nama_supplier }}</p>
                <p>{{ $transaksi->supplier->alamat }}</p>
                <p>Kontak: {{ $transaksi->supplier->kontak }}</p>
            </div>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Nama Barang</th>
                    <th>Jumlah</th>
                    <th>Satuan</th>
                    <th>Harga Satuan</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($transaksi->barang as $b)
                <tr>
                    <td>{{ $b->nama_barang }}</td>
                    <td>{{ $b->pivot->jumlah }}</td>
                    <td>{{ $b->pivot->satuan }}</td>
                    <td>Rp {{ number_format($b->pivot->harga, 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($b->pivot->subtotal, 0, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="total-section">
            <div>Total Harga: Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}</div>
        </div>
    </div>
</body>
</html>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Transaksi</title>
    
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        .detail-card {
            background: #fff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }
        .detail-row {
            display: flex;
            margin-bottom: 10px;
        }
        .detail-label {
            font-weight: bold;
            width: 150px;
            color: #555;
        }
        .detail-value {
            flex: 1;
            color: #333;
        }
        .tabel-barang {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .tabel-barang th, .tabel-barang td {
            border: 1px solid #e0e0e0;
            padding: 12px 15px;
            text-align: left;
        }
        .tabel-barang th {
            background-color: #4361ee;
            color: white;
            font-weight: 600;
        }
        .tabel-barang tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .tabel-barang tr:hover {
            background-color: #f1f1f1;
        }
        .total-section {
            margin-top: 30px;
            text-align: right;
            font-size: 1.2em;
            font-weight: bold;
            padding: 15px;
            background-color: #f8f9fa;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }
        .action-buttons {
            margin-top: 30px;
            display: flex;
            justify-content: flex-end;
        }
        .btn-hapus {
            background-color: #dc3545;
            color: white;
            border: none;
            padding: 18px 20px;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 800;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .btn-hapus:hover {
            background-color: #c82333;
            transform: translateY(-2px);
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        .main-actions {
            display: flex;
            gap: 15px;
        }
        h3 {
            color: #333;
            margin-top: 25px;
            font-size: 1.4em;
        }
    </style>
</head>
<body>

<div class="dashboard-container">
    <header class="dashboard-header">
        <div class="header-left">
            <div class="logo">Project Penjualan</div>
            <nav class="main-nav" id="mainNav">
                <ul>
                    <li><a href="{{ route('supplier.index') }}">SUPPLIER</a></li>
                    <li><a href="{{ route('barang.index') }}">BARANG</a></li>
                    <li><a href="{{ route('transaksi.index') }}">TRANSAKSI</a></li>
                </ul>
            </nav>
        </div>
        <div class="header-right">
            <div class="user-profile">
                <img src="https://ui-avatars.com/api/?name=A" alt="User Avatar" class="user-avatar">
                <span>Admin</span>
            </div>
            <div class="menu-toggle" id="menuToggle">
                <i class="fas fa-bars"></i>
            </div>
        </div>
    </header>

    <main class="dashboard-main">
        <div class="main-title-bar">
            <h2>Detail Transaksi</h2>
            <div class="main-actions">
                <a href="{{ route('transaksi.print', $transaksi->id_transaksi) }}" class="btn-print" target="_blank">
                    <i class="fas fa-print"></i> Cetak Invoice
                </a>
                <form action="{{ route('transaksi.destroy', $transaksi->id_transaksi) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-hapus" onclick="return confirm('Apakah Anda yakin ingin menghapus transaksi ini?')">
                        <i class="fas fa-trash"></i> Hapus Transaksi
                    </button>
                </form>
            </div>
        </div>

        <div class="detail-card">
            <div class="detail-row">
                <div class="detail-label">ID Transaksi</div>
                <div class="detail-value">{{ $transaksi->id_transaksi }}</div>
            </div>
            <div class="detail-row">
                <div class="detail-label">Tanggal</div>
                <div class="detail-value">{{ date('d/m/Y', strtotime($transaksi->tanggal_transaksi)) }}</div>
            </div>
            <div class="detail-row">
                <div class="detail-label">Supplier</div>
                <div class="detail-value">{{ $transaksi->supplier->nama_supplier }}</div>
            </div>
        </div>

        <h3>Daftar Barang</h3>
        <table class="tabel-barang">
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
    </main>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Toggle menu untuk mobile
    const menuToggle = document.getElementById('menuToggle');
    const mainNav = document.getElementById('mainNav');
    if (menuToggle && mainNav) {
        menuToggle.addEventListener('click', function() {
            mainNav.classList.toggle('active');
        });
    }
});
</script>

</body>
</html>
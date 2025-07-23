<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Transaksi</title>
    
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1rem;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        th, td {
            padding: 12px;
            border: 1px solid #e0e0e0;
            text-align: left;
        }

        th {
            background-color: #4361ee; /* Warna biru seragam untuk semua header */
            color: white;
            font-weight: 600;
            position: sticky;
            top: 0;
        }

        tr {
            transition: background-color 0.2s;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #e9f7fe;
            cursor: pointer;
        }


        .alert-success {
            background-color: #d4edda;
            color: #155724;
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 15px;
        }

        .text-center {
            text-align: center;
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
            <div class="search-bar">
                <input type="text" id="searchInput" placeholder="Cari transaksi...">
            </div>
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
            <h2>Daftar Transaksi</h2>
            <div class="main-actions">
                <a href="{{ route('transaksi.create') }}" class="add-button">
                    <i class="fas fa-plus"></i> Buat Transaksi
                </a>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table id="transaksiTable">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>ID Transaksi</th>
                    <th>Tanggal</th>
                    <th>Supplier</th>
                    <th>Total Harga</th>
                </tr>
            </thead>
            <tbody>
                @forelse($transaksis as $index => $t)
                <tr onclick="window.location.href='{{ route('transaksi.show', $t->id_transaksi) }}'">
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $t->id_transaksi }}</td>
                    <td>{{ date('d/m/Y', strtotime($t->tanggal_transaksi)) }}</td>
                    <td>{{ $t->supplier->nama_supplier }}</td>
                    <td>Rp {{ number_format($t->total_harga, 0, ',', '.') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center">Belum ada data transaksi</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </main>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Menu mobile toggle
    const menuToggle = document.getElementById('menuToggle');
    const mainNav = document.getElementById('mainNav');
    if (menuToggle && mainNav) {
        menuToggle.addEventListener('click', function() {
            mainNav.classList.toggle('active');
        });
    }

    // Live search
    const searchInput = document.getElementById('searchInput');
    if (searchInput) {
        searchInput.addEventListener('keyup', function() {
            const searchTerm = searchInput.value.toLowerCase();
            const rows = document.querySelectorAll('#transaksiTable tbody tr');
            
            rows.forEach(row => {
                const rowText = row.textContent.toLowerCase();
                row.style.display = rowText.includes(searchTerm) ? '' : 'none';
            });
        });
    }
});
</script>

</body>
</html>
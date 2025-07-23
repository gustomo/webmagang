<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Supplier</title>
    
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <style>
        /* Menghilangkan garis bawah pada link kartu */
        a.supplier-card-link {
            text-decoration: none;
            color: inherit;
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
                <input type="text" id="searchInput" placeholder="Cari supplier...">
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
            <h2>Daftar Supplier</h2>
            <div class="main-actions">
            <a href="print_all" class="btn-print" target="_blank"><i class="fas fa-print"></i> Cetak Laporan</a>
                <a href="{{ route('supplier.create') }}" class="add-button">+ Tambah Supplier</a>
            </div>
        </div>

        {{-- Notifikasi akan muncul di sini --}}
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="supplier-container">
            @forelse($suppliers as $s)
                <a href="{{ route('supplier.show', $s->id_sp) }}" class="supplier-card-link">
                    <div class="supplier-card">
                        <div class="supplier-details">
                            <h3>{{ $s->nama_supplier }}</h3>
                            <p><strong>Kode:</strong> {{ $s->id_sp }}</p>
                            <p><strong>Alamat:</strong> {{ Str::limit($s->alamat, 50) }}</p>
                            <p><strong>Kontak:</strong> {{ $s->kontak }}</p>
                        </div>
                        
                        @if($s->foto)
                            <div class="supplier-photo">
                                <img src="{{ asset('uploads/supplier/' . $s->foto) }}" alt="Foto {{ $s->nama_supplier }}">
                            </div>
                        @endif
                    </div>
                </a>
            @empty
                <div class="card-empty" style="width: 100%; text-align: center; padding: 20px;">
                    <p>Belum ada data supplier. Silakan tambahkan data baru.</p>
                </div>
            @endforelse
        </div>
    </main>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // --- FUNGSI UNTUK MENU MOBILE ---
    const menuToggle = document.getElementById('menuToggle');
    const mainNav = document.getElementById('mainNav');

    if (menuToggle && mainNav) {
        menuToggle.addEventListener('click', function() {
            mainNav.classList.toggle('active');
        });
    }

    // --- FUNGSI UNTUK LIVE SEARCH ---
    const searchInput = document.getElementById('searchInput');
    const supplierLinks = document.querySelectorAll('.supplier-card-link');

    searchInput.addEventListener('keyup', function() {
        const searchTerm = searchInput.value.toLowerCase();

        supplierLinks.forEach(link => {
            const card = link.querySelector('.supplier-card');
            const cardText = card.textContent.toLowerCase();
            
            if (cardText.includes(searchTerm)) {
                link.style.display = 'block';
            } else {
                link.style.display = 'none';
            }
        });
    });
});
</script>

</body>
</html>
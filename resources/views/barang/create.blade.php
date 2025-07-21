<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Barang Baru - Project Penjualan</title>
    
    <!-- Menggunakan file CSS eksternal Anda -->
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    
    <!-- Memuat Font Awesome untuk ikon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>

<div class="dashboard-container">
    <header class="dashboard-header">
        <div class="header-left">
            <div class="logo">Project Penjualan</div>
            <nav class="main-nav" id="mainNav">
                <ul>
                    <li><a href="{{ route('supplier.index') }}">SUPPLIER</a></li>
                    <li><a href="{{ route('barang.index') }}" class="active">BARANG</a></li>
                </ul>
            </nav>
        </div>
        <div class="header-right">
            <div class="search-bar">
                <input type="text" id="searchInput" placeholder="Cari Barang...">
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

    <!-- KONTEN UTAMA -->
    <main class="dashboard-main">
        <div class="form-container">
            <h2>Form Tambah Barang Baru</h2>
            <p class="form-subtitle">Isi detail di bawah ini untuk menambahkan data barang.</p>

            <form action="{{ route('barang.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Input untuk id_brg telah dihapus -->

                <!-- Input untuk nama_barang -->
                <div class="form-group">
                    <label for="nama_barang">Nama Barang</label>
                    <input type="text" id="nama_barang" name="nama_barang" required placeholder="Contoh: Kertas HVS A4">
                </div>

                <!-- Input untuk satuan (Select/Combo Box) -->
                <div class="form-group">
                    <label for="satuan">Satuan</label>
                    <select id="satuan" name="satuan" required class="form-control-select">
                        <option value="" disabled selected>Pilih salah satu satuan...</option>
                        <option value="dos">Dos</option>
                        <option value="lusin">Lusin</option>
                        <option value="krat">Krat</option>
                        <option value="sak">Sak</option>
                        <option value="rim">Rim</option>
                    </select>
                </div>

                <!-- Input untuk isi -->
                <div class="form-group">
                    <label for="isi">Isi per Satuan</label>
                    <input type="number" id="isi" name="isi" required placeholder="Contoh: 500 (untuk 1 rim)">
                </div>
                
<div class="form-group">
    <label for="stok">Stok</label>
    <input type="number" id="stok" name="stok" required placeholder="Contoh: 100">
</div>

                <div class="form-group">
                    <label for="gambar">Gambar Barang</label>
                    <input type="file" name="gambar" class="form-control">
                </div>

                <!-- Tombol Aksi Form -->
                <div class="form-actions">
                    <a href="{{ route('barang.index') }}" class="btn-cancel">Batal</a>
                    <button type="submit" class="btn-submit">Simpan Barang</button>
                </div>
            </form>
        </div>
    </main>
</div>

<style>
/* Tambahan kecil untuk memastikan select dan number input terlihat serasi */
.form-group select.form-control-select,
.form-group input[type="number"] {
    width: 100%;
    padding: 12px 15px;
    border: 1px solid var(--border-color);
    border-radius: 6px;
    font-size: 1em;
    background-color: white;
    transition: border-color 0.2s, box-shadow 0.2s;
}

.form-group select.form-control-select:focus,
.form-group input[type="number"]:focus {
    outline: none;
    border-color: var(--primary-color);
    box-shadow: 0 0 0 3px rgba(13, 110, 253, 0.15);
}
</style>

<script>
// Script Anda yang sudah ada bisa diletakkan di sini
document.addEventListener('DOMContentLoaded', function() {
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
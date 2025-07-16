<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Supplier Baru</title>
    
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    
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
                    <li><a href="{{ route('barang.index') }}">BARANG</a></li>
                </ul>
            </nav>
        </div>
        <div class="header-right">
            <div class="search-bar">
                <input type="text" placeholder="Search...">
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
        <div class="form-container">
            <h2>Form Tambah Supplier</h2>
            <p class="form-subtitle">Isi detail di bawah ini untuk menambahkan supplier baru.</p>

            <form action="{{ route('supplier.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="nama_supplier">Nama Supplier</label>
                    <input type="text" id="nama_supplier" name="nama_supplier" required>
                </div>

                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <input type="text" id="alamat" name="alamat" required>
                </div>

                <div class="form-group">
                    <label for="kontak">Kontak</label>
                    <input type="text" id="kontak" name="kontak" required>
                </div>

                <div class="form-group">
                    <label for="foto">Foto (Opsional)</label>
                    <input type="file" id="foto" name="foto" class="form-control-file">
                </div>

                <div class="form-actions">
                    <a href="{{ route('supplier.index') }}" class="btn-cancel">Batal</a>
                    <button type="submit" class="btn-submit">Simpan Supplier</button>
                </div>
            </form>
        </div>
    </main>
</div>

<script>
// Script untuk menu mobile jika diperlukan
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
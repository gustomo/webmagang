<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Transaksi Baru</title>
    
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    
    <style>
        /* Gaya tombol ikon simpel */
        .btn-add-row, .btn-remove-row {
            background: none;
            border: none;
            color: #6c757d;
            font-size: 1.2rem;
            cursor: pointer;
            padding: 0;
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .btn-add-row:hover {
            color: #28a745;
        }
        
        .btn-remove-row:hover {
            color: #dc3545;
        }
        
        /* Tetap pertahankan gaya lainnya */
        .form-container {
            background: #fff;
            border-radius: 8px;
            padding: 25px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .table-form {
            width: 100%;
            margin-top: 20px;
        }
        
        .table-form th {
            background-color: #f8f9fa;
        }
        
        .table-form td, .table-form th {
            padding: 12px;
            vertical-align: middle;
        }
        
        .total-section {
            background: #e9ecef;
            padding: 15px;
            border-radius: 5px;
            margin-top: 20px;
            font-size: 1.2em;
            font-weight: bold;
            text-align: right;
        }
        
        .dashboard-header {
            margin-bottom: 30px;
        }
        
        .form-group-custom {
            margin-bottom: 20px;
        }
        
        .form-group-custom label {
            font-weight: 600;
            margin-bottom: 8px;
            display: block;
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
        <div class="form-container">
            <h2><i class="fas fa-cart-plus"></i> Buat Transaksi Baru</h2>
            <p class="form-subtitle">Isi detail transaksi pembelian barang dari supplier</p>

            <form action="{{ route('transaksi.store') }}" method="POST" id="transaksi-form">
                @csrf

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group-custom">
                            <label for="id_sp"><i class="fas fa-truck"></i> Supplier</label>
                            <select id="id_sp" name="id_sp" class="form-control" required>
                                <option value="">Pilih Supplier</option>
                                @foreach($suppliers as $s)
                                <option value="{{ $s->id_sp }}">{{ $s->nama_supplier }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group-custom">
                            <label for="tanggal_transaksi"><i class="far fa-calendar-alt"></i> Tanggal Transaksi</label>
                            <input type="datetime-local" id="tanggal_transaksi" name="tanggal_transaksi" class="form-control" required value="{{ date('Y-m-d\TH:i') }}">
                        </div>
                    </div>
                </div>

                <hr>

                <h5><i class="fas fa-boxes"></i> Daftar Barang</h5>
                
                <table class="table table-form">
                    <thead>
                        <tr>
                            <th width="40%">Barang</th>
                            <th width="15%">Jumlah</th>
                            <th width="15%">Satuan</th>
                            <th width="20%">Harga Satuan</th>
                            <th width="10%">Subtotal</th>
                            <th width="5%">
                                <button type="button" class="btn-add-row" onclick="addRow()" title="Tambah Barang">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </th>
                        </tr>
                    </thead>
                    <tbody id="barang-container">
                        <tr>
                            <td>
                                <select name="barang[0][id_brg]" class="form-control barang-select" required>
                                    <option value="">Pilih Barang</option>
                                    @foreach($barangs as $b)
                                    <option value="{{ $b->id_brg }}" data-satuan="{{ $b->satuan }}">{{ $b->nama_barang }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <input type="number" name="barang[0][jumlah]" class="form-control qty" min="1" required>
                            </td>
                            <td>
                                <input type="text" name="barang[0][satuan]" class="form-control satuan" readonly>
                            </td>
                            <td>
                                <input type="number" name="barang[0][harga]" class="form-control harga" min="0" required>
                            </td>
                            <td>
                                <input type="text" class="form-control subtotal" readonly>
                            </td>
                            <td>
                                <button type="button" class="btn-remove-row" onclick="removeRow(this)" title="Hapus Barang">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <div class="total-section">
                    Total Harga: Rp <span id="total-harga">0</span>
                    <input type="hidden" name="total_harga" id="total-harga-input">
                </div>

                <div class="form-actions mt-4">
                    <a href="{{ route('transaksi.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Simpan Transaksi
                    </button>
                </div>
            </form>
        </div>
    </main>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Menu mobile toggle (dari desain lama)
    const menuToggle = document.getElementById('menuToggle');
    const mainNav = document.getElementById('mainNav');
    if (menuToggle && mainNav) {
        menuToggle.addEventListener('click', function() {
            mainNav.classList.toggle('active');
        });
    }

    // Fungsi untuk menambah baris baru
    window.addRow = function() {
        const rowCount = document.querySelectorAll('#barang-container tr').length;
        const newRow = document.querySelector('#barang-container tr').cloneNode(true);
        
        // Update semua nama atribut dengan index baru
        newRow.innerHTML = newRow.innerHTML.replace(/\[0\]/g, `[${rowCount}]`);
        
        // Reset nilai input
        newRow.querySelector('.barang-select').selectedIndex = 0;
        newRow.querySelector('.qty').value = '';
        newRow.querySelector('.satuan').value = '';
        newRow.querySelector('.harga').value = '';
        newRow.querySelector('.subtotal').value = '';
        
        document.getElementById('barang-container').appendChild(newRow);
    };

    // Fungsi untuk menghapus baris
    window.removeRow = function(btn) {
        const rows = document.querySelectorAll('#barang-container tr');
        if (rows.length > 1) {
            btn.closest('tr').remove();
            hitungTotalHarga();
        }
    };

    // Event listener untuk perubahan input
    document.addEventListener('input', function(e) {
        if (e.target.classList.contains('barang-select')) {
            const selectedOption = e.target.options[e.target.selectedIndex];
            const satuan = selectedOption.getAttribute('data-satuan') || '';
            e.target.closest('tr').querySelector('.satuan').value = satuan;
        }
        
        if (e.target.classList.contains('qty') || e.target.classList.contains('harga')) {
            hitungSubtotal(e.target);
        }
    });

    // Fungsi untuk menghitung subtotal per baris
    function hitungSubtotal(input) {
        const row = input.closest('tr');
        const qty = parseFloat(row.querySelector('.qty').value) || 0;
        const harga = parseFloat(row.querySelector('.harga').value) || 0;
        const subtotal = qty * harga;
        
        row.querySelector('.subtotal').value = subtotal.toLocaleString('id-ID');
        hitungTotalHarga();
    }

    // Fungsi untuk menghitung total harga
    function hitungTotalHarga() {
        let total = 0;
        document.querySelectorAll('#barang-container tr').forEach(row => {
            const subtotal = parseFloat(row.querySelector('.subtotal').value.replace(/\./g, '')) || 0;
            total += subtotal;
        });
        
        document.getElementById('total-harga').textContent = total.toLocaleString('id-ID');
        document.getElementById('total-harga-input').value = total;
    }
});
</script>

</body>
</html>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Barang: {{ $barang->nama_barang }}</title>
    
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    
    <style>
        /* Anda bisa memindahkan style ini ke file dashboard.css jika ingin */
        .form-container {
            max-width: 700px;
            margin: 0 auto;
            background: var(--card-bg);
            padding: 30px 40px;
            border-radius: 12px;
            box-shadow: var(--card-shadow);
            border: 1px solid var(--border-color);
        }
        .form-container h2 {
            text-align: center;
            font-size: 1.8em;
            margin-bottom: 10px;
        }
        .form-container .form-subtitle {
            text-align: center;
            color: var(--light-text-color);
            margin-bottom: 30px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: #495057;
        }
        .form-group input[type="text"],
        .form-group input[type="number"],
        .form-group select {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid var(--border-color);
            border-radius: 6px;
            font-size: 1em;
            transition: border-color 0.2s, box-shadow 0.2s;
        }
        .form-group input:focus,
        .form-group select:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(13, 110, 253, 0.15);
        }
        .form-actions {
            display: flex;
            justify-content: flex-end;
            gap: 15px;
            margin-top: 30px;
            border-top: 1px solid var(--border-color);
            padding-top: 20px;
        }
        .btn-submit, .btn-cancel {
            padding: 10px 25px;
            border: none;
            border-radius: 6px;
            font-weight: 500;
            cursor: pointer;
            text-decoration: none;
            text-align: center;
            transition: all 0.2s;
        }
        .btn-submit {
            background-color: var(--primary-color);
            color: white;
        }
        .btn-submit:hover {
            background-color: #2563eb;
        }
        .btn-cancel {
            background-color: #f1f3f5;
            color: #495057;
        }
        .btn-cancel:hover {
            background-color: #e9ecef;
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
                    <li><a href="{{ route('barang.index') }}" class="active">BARANG</a></li>
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
            <h2>Edit Data Barang</h2>
            <p class="form-subtitle">Perbarui informasi barang di bawah ini.</p>

            <form action="{{ route('barang.update', $barang->id_brg) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="id_brg">ID Barang</label>
                    <input type="text" id="id_brg" name="id_brg" value="{{ $barang->id_brg }}" readonly style="background-color: #e9ecef; cursor: not-allowed;">
                </div>

                <div class="form-group">
                    <label for="nama_barang">Nama Barang</label>
                    <input type="text" id="nama_barang" name="nama_barang" value="{{ $barang->nama_barang }}" required>
                </div>

                <div class="form-group">
                    <label for="satuan">Satuan</label>
                    <select id="satuan" name="satuan" required>
                        <option value="dos" {{ $barang->satuan == 'dos' ? 'selected' : '' }}>Dos</option>
                        <option value="lusin" {{ $barang->satuan == 'lusin' ? 'selected' : '' }}>Lusin</option>
                        <option value="krat" {{ $barang->satuan == 'krat' ? 'selected' : '' }}>Krat</option>
                        <option value="sak" {{ $barang->satuan == 'sak' ? 'selected' : '' }}>Sak</option>
                        <option value="rim" {{ $barang->satuan == 'rim' ? 'selected' : '' }}>Rim</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="isi">Isi per Satuan</label>
                    <input type="number" id="isi" name="isi" value="{{ $barang->isi }}" required>
                </div>

                <div class="form-actions">
                    <a href="{{ route('barang.index') }}" class="btn-cancel">Batal</a>
                    <button type="submit" class="btn-submit">Update Data</button>
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

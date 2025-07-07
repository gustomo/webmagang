<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Supplier: {{ $supplier->nama_supplier }}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    
    <style>
        /* General & Dashboard Layout */
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');

        :root {
            --primary-color: #3b82f6;
            --card-bg: #ffffff;
            --text-color: #1f2937;
            --light-text-color: #6b7280;
            --border-color: #e5e7eb;
            --header-height: 70px;
            --card-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);

            /* Variabel warna untuk Navbar Dark Theme */
            --header-bg: #1f2937;
            --header-text: #f9fafb;
            --header-text-secondary: #9ca3af;
            --header-hover-bg: #374151;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Poppins', sans-serif;
            color: var(--text-color);
            line-height: 1.6;
            background-color: #f4f7f6;
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23d4dbe1' fill-opacity='0.4'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }

        .dashboard-container { display: flex; flex-direction: column; min-height: 100vh; }
        .dashboard-main { width: 100%; padding: 40px; flex-grow: 1; }

        /* Style Navbar (Sama Seperti Index) */
        .dashboard-header {
            height: var(--header-height);
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 30px;
            position: sticky;
            top: 0;
            z-index: 1000;
            background-color: var(--header-bg);
            border-bottom: 1px solid var(--header-hover-bg);
        }
        .header-left, .header-right { display: flex; align-items: center; gap: 20px; }
        .logo { font-size: 1.4em; font-weight: 700; color: var(--header-text); }
        .main-nav ul { list-style: none; display: flex; }
        .main-nav ul li a { text-decoration: none; color: var(--header-text-secondary); font-weight: 500; padding: 10px 15px; border-bottom: 3px solid transparent; transition: all 0.3s ease; }
        .main-nav ul li a:hover { color: var(--header-text); }
        .main-nav ul li a.active { color: var(--header-text); border-bottom-color: var(--primary-color); }
        .search-bar { position: relative; display: flex; align-items: center; }
        .search-bar input { border: 1px solid var(--header-hover-bg); background: var(--header-hover-bg); color: var(--header-text); padding: 9px 15px; border-radius: 8px; width: 280px; }
        .search-bar input::placeholder { color: var(--header-text-secondary); }
        .search-bar input:focus { outline: none; border-color: var(--primary-color); }
        .user-profile { display: flex; align-items: center; gap: 10px; color: var(--header-text); }
        .user-avatar { width: 40px; height: 40px; border-radius: 50%; }

        /* Style Khusus Halaman Detail */
        .detail-container {
            background-color: var(--card-bg);
            padding: 30px;
            border-radius: 12px;
            box-shadow: var(--card-shadow);
            max-width: 1200px; /* Batasi lebar container di layar besar */
            margin: 0 auto; /* Posisikan di tengah */
        }
        .detail-header {
            border-bottom: 1px solid var(--border-color);
            padding-bottom: 15px;
            margin-bottom: 20px;
        }
        .detail-header h2 {
            font-size: 2em;
            font-weight: 600;
            margin: 0;
        }
        .detail-actions {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-top: 20px;
        }
        .detail-actions a,
        .detail-actions button {
            text-decoration: none;
            padding: 8px 18px;
            border-radius: 6px;
            color: white;
            font-weight: 500;
            border: none;
            cursor: pointer;
            font-family: 'Poppins', sans-serif;
            font-size: 14px;
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .detail-actions a:hover,
        .detail-actions button:hover {
            transform: translateY(-2px);
        }
        .detail-actions form { margin: 0; }
        .btn-back { background-color: #6c757d; }
        .btn-edit { background-color: #ffc107; color: #1f2937; }
        .btn-delete { background-color: #dc3545; }

        .detail-body {
            display: grid;
            grid-template-columns: 2fr auto;
            gap: 30px;
            align-items: flex-start;
        }
        .detail-info-group { margin-bottom: 20px; }
        .detail-info-group label {
            display: block;
            font-size: 13px;
            color: var(--light-text-color);
            margin-bottom: 5px;
            text-transform: uppercase;
        }
        .detail-info-group p {
            font-size: 1.1em;
            margin: 0;
            font-weight: 500;
        }
        .detail-photo {
            width: 250px;
        }
        .detail-photo img {
            width: 100%;
            height: auto;
            border-radius: 8px;
            border: 1px solid var(--border-color);
        }
    </style>
</head>
<body>
<header class="dashboard-header">
        <div class="header-left">
            <div class="logo">Project Penjualan</div>
            <nav class="main-nav" id="mainNav">
                <ul>
                    <li><a href="{{ route('supplier.index') }}">SUPPLIER</a></li>
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
            <div class="detail-container">
                <div class="detail-header">
                    <h2>{{ $supplier->nama_supplier }}</h2>
                </div>

                <div class="detail-actions">
                    <a href="{{ route('supplier.index') }}" class="btn-back">Kembali</a>
                    <a href="{{ route('supplier.edit', $supplier->id_sp) }}" class="btn-edit">Edit</a>
                    <form action="{{ route('supplier.destroy', $supplier->id_sp) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus supplier ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-delete">Hapus</button>
                    </form>
                </div>

                <hr style="border: none; border-top: 1px solid var(--border-color); margin: 25px 0;">

                <div class="detail-body">
                    <div class="detail-main-info">
                        <div class="detail-info-group">
                            <label>Kode Supplier</label>
                            <p>{{ $supplier->id_sp }}</p>
                        </div>
                        <div class="detail-info-group">
                            <label>Alamat Perusahaan</label>
                            <p>{{ $supplier->alamat }}</p>
                        </div>
                        <div class="detail-info-group">
                            <label>Kontak (Telepon)</label>
                            <p>{{ $supplier->kontak }}</p>
                        </div>
                    </div>
                    <div class="detail-photo">
                        @if($supplier->foto)
                            <img src="{{ asset('uploads/supplier/' . $supplier->foto) }}" alt="Foto {{ $supplier->nama_supplier }}">
                        @else
                            <p>Tidak ada foto.</p>
                        @endif
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
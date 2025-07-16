<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Barang: {{ $barang->nama_barang }}</title>
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    
    <style>
        /* Anda bisa memindahkan style ini ke file dashboard.css jika ingin */
        .detail-container {
            background-color: var(--card-bg);
            padding: 30px 40px;
            border-radius: 12px;
            box-shadow: var(--card-shadow);
            max-width: 800px;
            margin: 0 auto;
        }
        .detail-header {
            border-bottom: 1px solid var(--border-color);
            padding-bottom: 20px;
            margin-bottom: 25px;
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
        }
        .detail-header .title-group h2 {
            font-size: 2.2em;
            font-weight: 700;
            margin: 0;
            color: var(--primary-color);
            line-height: 1.2;
        }
        .detail-header .title-group .item-id {
            font-size: 1em;
            font-weight: 500;
            color: var(--light-text-color);
            background-color: #f3f4f6;
            padding: 4px 12px;
            border-radius: 15px;
            display: inline-block;
            margin-top: 8px;
        }
        .detail-actions {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid var(--border-color);
        }
        .detail-actions a, .detail-actions button {
            text-decoration: none;
            padding: 8px 18px;
            border-radius: 6px;
            color: white;
            font-weight: 500;
            border: none;
            cursor: pointer;
            font-family: 'Poppins', sans-serif;
            font-size: 14px;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        .detail-actions a:hover, .detail-actions button:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }
        .detail-actions form { margin: 0; }
        .btn-back { background-color: #6c757d; }
        .btn-edit { background-color: #ffc107; color: #1f2937; }
        .btn-delete { background-color: #dc3545; }

        .detail-info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
            margin-bottom: 30px;
        }
        .detail-info-group {
            background-color: #f9fafb;
            padding: 20px;
            border-radius: 8px;
            border: 1px solid var(--border-color);
        }
        .detail-info-group label {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 13px;
            color: var(--light-text-color);
            margin-bottom: 8px;
            text-transform: uppercase;
            font-weight: 600;
        }
        .detail-info-group label i {
            width: 16px;
            text-align: center;
        }
        .detail-info-group p {
            font-size: 1.4em;
            margin: 0;
            font-weight: 500;
            color: #374151;
            padding-left: 24px; /* Sejajar dengan teks label */
        }
        .timestamps {
            font-size: 0.85em;
            color: var(--light-text-color);
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
            <div class="detail-container">
                <div class="detail-header">
                    <div class="title-group">
                        <h2>{{ $barang->nama_barang }}</h2>
                        <span class="item-id">{{ $barang->id_brg }}</span>
                    </div>
                </div>

                <div class="detail-body">
                    <div class="detail-info-grid">
                        <div class="detail-info-group">
                            <label><i class="fas fa-box"></i> Satuan</label>
                            <p>{{ ucfirst($barang->satuan) }}</p>
                        </div>
                        <div class="detail-info-group">
                            <label><i class="fas fa-boxes"></i> Isi per Satuan</label>
                            <p>{{ number_format($barang->isi, 0, ',', '.') }}</p>
                        </div>
                    </div>
                    <div class="timestamps">
                        Dibuat pada: {{ $barang->created_at->format('d F Y, H:i') }} | Terakhir diubah: {{ $barang->updated_at->format('d F Y, H:i') }}
                    </div>
                </div>

                <div class="detail-actions">
                    <a href="{{ route('barang.index') }}" class="btn-back"><i class="fas fa-arrow-left"></i> Kembali</a>
                    <a href="{{ route('barang.edit', $barang->id_brg) }}" class="btn-edit"><i class="fas fa-pencil-alt"></i> Edit</a>
                    <form action="{{ route('barang.destroy', $barang->id_brg) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus barang ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-delete"><i class="fas fa-trash"></i> Hapus</button>
                    </form>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
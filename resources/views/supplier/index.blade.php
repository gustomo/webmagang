<!DOCTYPE html>
<html>
<head>
    <title>Data Supplier</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }
        .container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .card {
            border: 1px solid #ccc;
            border-radius: 10px;
            width: 440px;
            padding: 15px;
            box-shadow: 2px 2px 6px rgba(0,0,0,0.1);
            cursor: pointer;
            transition: transform 0.2s ease;
        }

        .card:hover {
            transform: scale(1.02);
        }

        .card h3 {
            margin: 0 0 10px;
            color: #333;
        }

        .card p {
            margin: 4px 0;
            font-size: 14px;
        }

        .card .actions {
            margin-top: 10px;
        }

        .card .actions a,
        .card .actions form {
            display: inline-block;
            margin-right: 5px;
        }

        .card .actions form {
            display: inline;
        }

        .card .actions button {
            background-color: red;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
        }

        .card .actions a {
            background-color: orange;
            color: white;
            text-decoration: none;
            padding: 5px 10px;
            border-radius: 5px;
        }

        .add-button {
            display: inline-block;
            margin-bottom: 20px;
            padding: 10px 15px;
            background-color: #28a745;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }

        .success-message {
            color: green;
            margin-bottom: 10px;
        }

        .card img {
    display: block;
    margin: 10px auto 0;
    max-width: 150px;
    max-height: 150px;
    width: auto;
    height: auto;
    object-fit: contain;
    border-radius: 8px;
    border: 1px solid #ccc;
    
    
}
/* General Styles & Reset */
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

:root {
    --primary-color: #2e7ad4; /* Biru Material-UI */
    --secondary-bg-color: #f5f5f5; /* Background abu-abu */
    --card-bg: #ffffff;
    --text-color: #333;
    --light-text-color: #777;
    --border-color: #eee;
    --header-height: 60px;
    --btn-primary-bg: #800080; /* Ungu untuk tombol VIEW DETAILS */
    --chart-placeholder-color: #64b5f6; /* Biru muda untuk bar placeholder */
    --summary-icon-color-1: #ff7043; /* Oranye */
    --summary-icon-color-2: #42a5f5; /* Biru */
    --summary-icon-color-3: #ec407a; /* Merah muda */
    --summary-icon-color-4: #26a69a; /* Teal */
}

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Poppins', sans-serif;
    background-color: var(--secondary-bg-color);
    color: var(--text-color);
    line-height: 1.6;
    overflow-x: hidden; /* Mencegah scroll horizontal dari ikon gear */
}

.dashboard-container {
    display: flex;
    flex-direction: column;
    min-height: 100vh;
}

/* Header Section Styles */
.dashboard-header {
    background-color: var(--card-bg);
    height: var(--header-height);
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0 20px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.08);
    position: sticky;
    top: 0;
    z-index: 1000;
}

.header-left, .header-right {
    display: flex;
    align-items: center;
}

.logo {
    font-size: 1.5em;
    font-weight: 700;
    color: var(--primary-color);
    margin-right: 30px; /* Jarak untuk navigasi */
}

.logo-subtitle {
    font-size: 0.7em;
    color: var(--light-text-color);
    font-weight: 400;
    margin-left: 5px;
}

/* Main Navigation (Desktop Default) */
.main-nav {
    display: flex; /* Default desktop view */
}

.main-nav ul {
    list-style: none;
    display: flex;
}

.main-nav ul li {
    margin-right: 25px;
    position: relative;
}

.main-nav ul li a {
    text-decoration: none;
    color: var(--text-color);
    font-weight: 500;
    font-size: 0.9em;
    padding: 5px 0;
    transition: color 0.3s ease;
    display: flex;
    align-items: center;
}

.main-nav ul li a:hover {
    color: var(--primary-color);
}

.main-nav ul li a .fas {
    margin-left: 5px;
    font-size: 0.8em;
}

/* Search Bar */
.search-bar {
    position: relative;
    margin-right: 20px;
    background-color: var(--secondary-bg-color);
    border-radius: 5px;
    padding: 8px 10px;
    display: flex;
    align-items: center;
}

.search-bar input {
    border: none;
    background: transparent;
    padding: 0 5px;
    font-size: 0.9em;
    outline: none;
    color: var(--text-color);
}
.search-bar input::placeholder {
    color: var(--light-text-color);
}

.search-bar .fa-search {
    color: var(--light-text-color);
    margin-right: 5px;
}

/* Header Icons */
.header-icons .fas {
    font-size: 1.1em;
    color: var(--light-text-color);
    margin-left: 20px;
    cursor: pointer;
    transition: color 0.3s ease;
}

.header-icons .fas:hover {
    color: var(--primary-color);
}

/* User Profile */
.user-profile {
    display: flex;
    align-items: center;
    margin-left: 20px;
}

.user-avatar {
    width: 30px;
    height: 30px;
    border-radius: 50%;
    object-fit: cover;
    margin-right: 8px;
    border: 2px solid var(--primary-color);
}

.user-profile span {
    font-weight: 500;
    font-size: 0.9em;
}

/* Fixed Gear Icon (Setting) */
.fixed-gear-icon {
    position: fixed;
    right: 20px;
    top: 50%;
    transform: translateY(-50%);
    background-color: var(--primary-color);
    color: var(--card-bg);
    width: 45px;
    height: 45px;
    border-radius: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 1.3em;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    cursor: pointer;
    z-index: 999;
    transition: background-color 0.3s ease, transform 0.3s ease;
}

.fixed-gear-icon:hover {
    background-color: #256bbd;
    transform: translateY(-50%) rotate(30deg);
}

/* Main Content Area */
.dashboard-main {
    padding: 20px;
    flex-grow: 1; /* Makes it take up remaining vertical space */
}

/* Dashboard Title and Breadcrumb */
.dashboard-title-bar {
    display: flex;
    justify-content: space-between;
    align-items: baseline;
    margin-bottom: 25px;
}

.dashboard-title-bar h2 {
    font-size: 1.8em;
    font-weight: 600;
    color: var(--text-color);
}

.breadcrumb {
    font-size: 0.85em;
    color: var(--light-text-color);
}

/* Dashboard Grid for Cards */
.dashboard-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr); /* 4 columns for desktop */
    gap: 20px; /* Gap between cards */
}

/* Card Base Style */
.card {
    background-color: var(--card-bg);
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    display: flex;
    flex-direction: column;
    overflow: hidden; /* Important for placeholders */
}

/* Main Metric Cards (Top Row) */
.main-metric-card {
    grid-column: span 2; /* Takes 2 columns on desktop */
    height: 220px; /* Fixed height */
    justify-content: space-between; /* Pushes bottom area to bottom */
    padding: 20px;
}

.main-metric-card .card-content {
    flex-grow: 1; /* Takes remaining space within card */
}

.main-metric-card .card-bottom-area {
    padding-top: 15px; /* Spacing from top content */
    font-size: 0.85em;
    color: var(--light-text-color);
}

/* Small Metric Cards (Middle Row) */
.small-metric-card {
    grid-column: span 1; /* Takes 1 column on desktop */
    height: 220px; /* Fixed height, same as main-metric */
    justify-content: space-between;
    padding: 20px 20px 0 20px; /* No bottom padding, for chart placeholder */
}

.small-metric-card .card-content-top {
    flex-grow: 1;
}

/* Summary Metric Cards (Bottom Row) */
.summary-metric-card {
    grid-column: span 1; /* Takes 1 column on desktop */
    height: 160px; /* Smaller fixed height */
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    text-align: center;
    padding: 15px;
}

/* Card Content Styling */
.card-value {
    font-size: 2.2em;
    font-weight: 600;
    color: var(--text-color);
    margin-bottom: 5px;
}

.card-value .currency {
    font-size: 0.6em;
    font-weight: 500;
    vertical-align: super;
    margin-left: 5px;
    color: var(--light-text-color);
}

.card-label {
    font-size: 0.85em;
    color: var(--light-text-color);
    text-transform: uppercase;
    margin-bottom: 15px;
    font-weight: 500;
}

.card-description {
    font-size: 0.9em;
    color: var(--light-text-color);
    margin-bottom: 20px;
    line-height: 1.5;
}

.card-description-small {
    font-size: 0.8em;
    color: var(--light-text-color);
    margin-bottom: 15px;
    line-height: 1.4;
}

/* Button Styles */
.btn {
    display: inline-block;
    padding: 10px 20px;
    border-radius: 5px;
    text-decoration: none;
    font-size: 0.9em;
    font-weight: 600;
    cursor: pointer;
    transition: background-color 0.3s ease, color 0.3s ease;
}

.btn-primary {
    background-color: var(--btn-primary-bg);
    color: var(--card-bg);
    border: none;
}

.btn-primary:hover {
    background-color: #6a0dad; /* Slightly darker on hover */
}

/* Card Link */
.card-link {
    color: var(--primary-color);
    text-decoration: none;
    font-size: 0.9em;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
}

.card-link .fas {
    margin-left: 5px;
    font-size: 0.8em;
}

.card-link:hover {
    text-decoration: underline;
}

/* Summary Cards Styling */
.summary-icon {
    font-size: 3em;
    margin-bottom: 15px;
}

/* Specific colors for each summary icon */
.summary-metric-card:nth-child(5) .summary-icon { color: var(--summary-icon-color-1); }
.summary-metric-card:nth-child(6) .summary-icon { color: var(--summary-icon-color-2); }
.summary-metric-card:nth-child(7) .summary-icon { color: var(--summary-icon-color-3); }
.summary-metric-card:nth-child(8) .summary-icon { color: var(--summary-icon-color-4); }

.summary-label {
    font-size: 0.8em;
    color: var(--light-text-color);
    text-transform: uppercase;
    margin-bottom: 5px;
    font-weight: 500;
}

.summary-value {
    font-size: 1.8em;
    font-weight: 600;
    color: var(--text-color);
}

/* Placeholder for Charts/Areas */
.card-bottom-area {
    width: 100%;
}

.chart-placeholder-bar {
    background-color: var(--chart-placeholder-color);
    height: 70px; /* Fixed height for the bar */
    border-radius: 0 0 8px 8px; /* Rounded bottom corners of the card */
    margin-top: auto; /* Pushes the bar to the bottom */
}


/* Responsive Design */

/* Hamburger Menu Toggle for Mobile - Hidden by default on desktop */
.menu-toggle {
    display: none;
    font-size: 1.5em;
    color: var(--primary-color);
    cursor: pointer;
    margin-left: 20px; /* Added spacing from logo */
}

/* Tablet Landscape / Large Tablet Portrait (max-width: 1200px) */
@media (max-width: 1200px) {
    .dashboard-grid {
        grid-template-columns: repeat(2, 1fr); /* 2 columns */
    }
    .main-metric-card, .small-metric-card, .summary-metric-card {
        grid-column: span 1; /* All cards default to 1 column */
    }
    .main-metric-card {
        grid-column: span 2; /* Main cards still take 2 columns */
    }
}

/* Tablet Portrait / Small Laptop (max-width: 992px) */
@media (max-width: 992px) {
    /* Header Adjustments for Mobile */
    .dashboard-header {
        flex-wrap: wrap; /* Allow elements to wrap to next line */
        height: auto; /* Header height adjusts to content */
        padding-bottom: 10px; /* Additional bottom padding when wrapped */
    }

    .header-left {
        width: 100%; /* Take full width */
        justify-content: space-between; /* Logo left, toggle right */
        padding-top: 10px;
    }

    .header-right {
        position: static; /* Back to normal flow, not absolute */
        width: 100%;
        background-color: transparent; /* Remove background */
        box-shadow: none; /* Remove shadow */
        padding: 0;
        justify-content: space-between; /* Align elements left-right */
        margin-top: 10px; /* Spacing from header-left */
    }

    .search-bar {
        order: 2; /* Center in order */
        flex-grow: 1; /* Allow search bar to fill space */
        margin: 0 10px; /* Adjust margins */
        padding: 6px 10px; /* Reduce search bar padding */
    }

    .header-icons {
        order: 1; /* Move to left */
        margin-left: 0;
        display: flex; /* Ensure icons are aligned */
        gap: 15px; /* Gap between icons */
    }

    .user-profile {
        order: 3; /* Move to right */
        margin-left: 0;
    }

    /* Main Navigation (Hamburger Menu Behavior for Mobile) */
    .main-nav {
        display: none; /* Hidden by default on mobile */
        position: absolute; /* Position relative to .dashboard-header */
        top: var(--header-height); /* Below the header */
        left: 0;
        width: 100%;
        background-color: var(--card-bg);
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.08);
        flex-direction: column; /* Vertical menu items */
        padding: 10px 20px;
        z-index: 3; /* Below fixed-gear icon */
        height: auto; /* Adjust height based on content */
    }

    .main-nav.active { /* Class added by JS to show menu */
        display: flex;
    }

    .main-nav ul {
        flex-direction: column;
        width: 100%;
    }

    .main-nav ul li {
        margin: 10px 0;
        border-bottom: 1px solid var(--border-color); /* Separator line */
        padding-bottom: 5px;
        width: 100%;
    }
    .main-nav ul li:last-child {
        border-bottom: none; /* No border for the last item */
    }

    .menu-toggle {
        display: block; /* Show hamburger icon on mobile */
    }

    /* Dashboard Grid Adjustments for Mobile */
    .dashboard-grid {
        grid-template-columns: repeat(1, 1fr); /* 1 column on mobile */
        gap: 15px; /* Reduce gap between cards */
    }

    .main-metric-card, .small-metric-card, .summary-metric-card {
        grid-column: span 1; /* All cards take 1 column */
        height: auto; /* Height adjusts to content */
        min-height: 180px; /* Minimum height */
        padding: 15px; /* Reduce padding */
    }

    .main-metric-card .card-value {
        font-size: 1.8em; /* Reduce font size */
    }
    .card-label {
        margin-bottom: 10px;
    }
    .card-description {
        font-size: 0.85em;
        margin-bottom: 15px;
    }
    .btn-primary {
        padding: 8px 15px;
        font-size: 0.85em;
    }
    .card-link {
        font-size: 0.85em;
    }

    .summary-metric-card {
        min-height: 120px;
        padding: 10px;
    }
    .summary-icon {
        font-size: 2.5em;
        margin-bottom: 10px;
    }
    .summary-value {
        font-size: 1.4em;
    }
    .summary-label {
        font-size: 0.7em;
    }

    .dashboard-title-bar {
        flex-direction: column;
        align-items: flex-start;
        margin-bottom: 15px;
    }
    .dashboard-title-bar h2 {
        font-size: 1.5em;
    }
    .breadcrumb {
        font-size: 0.75em;
        margin-top: 5px;
    }

    .fixed-gear-icon {
        width: 40px;
        height: 40px;
        font-size: 1.2em;
        right: 15px;
    }
}

/* Small Mobile Devices (max-width: 576px) */
@media (max-width: 576px) {
    .dashboard-main {
        padding: 10px;
    }
    .search-bar {
        margin: 0 5px;
        padding: 5px 8px;
    }
    .user-profile {
        /* Hide user name for very small screens */
        span {
            display: none;
        }
        .user-avatar {
            margin-right: 0;
        }
    }
    .header-icons {
        gap: 10px;
    }
    .header-icons .fas {
        font-size: 1em;
    }
    .main-nav ul li a {
        font-size: 0.8em;
    }
    .card-value {
        font-size: 1.6em;
    }
    .card-label {
        font-size: 0.8em;
    }
    .card-description {
        font-size: 0.8em;
    }
    .btn-primary {
        padding: 6px 12px;
        font-size: 0.8em;
    }
    .card-link {
        font-size: 0.8em;
    }
    .fixed-gear-icon {
        width: 35px;
        height: 35px;
        font-size: 1em;
        right: 10px;
    }
    .summary-icon {
        font-size: 2em;
    }
    .summary-value {
        font-size: 1.2em;
    }
    .summary-label {
        font-size: 0.65em;
    }
}


    </style>
</head>
<body>

    <div class="dashboard-container">
        <header class="dashboard-header">
            <div class="header-left">
                <div class="logo">Project <span class="logo-subtitle">Penjualan</span></div>
                <div class="menu-toggle" id="menuToggle">
                    <i class="fas fa-bars"></i>
                </div>
                <nav class="main-nav" id="mainNav">
                    <ul>
                        <li><a href="#">DASHBOARD <i class="fas fa-caret-down"></i></a></li>

                    </ul>
                </nav>
            </div>
            <div class="header-right">
                <div class="search-bar">
                    <i class="fas fa-search"></i>
                    <input type="text" placeholder="Search...">
                </div>
                <div class="header-icons">
                    <i class="fas fa-bell"></i>
                    <i class="fas fa-comment-dots"></i>
                </div>
                <div class="user-profile">
                    <img src="https://via.placeholder.com/30/cccccc/ffffff?text=U" alt="User Avatar" class="user-avatar">
                    <span>User Name</span>
                </div>
            </div>
        </header>

        <main class="dashboard-main">
            <div class="dashboard-title-bar">
                <h2>Dashboard Penjualan</h2>
                <div class="breadcrumb">Home / Dashboard</div>
            </div>
            <h2>Daftar Supplier</h2>

    <a href="{{ route('supplier.create') }}" class="add-button">+ Tambah Supplier</a>

    @if(session('success'))
        <div class="success-message">{{ session('success') }}</div>
    @endif

    <div class="container">
        @foreach($suppliers as $s)
            <div class="card"
                onclick="showPopup(
                    '{{ addslashes($s->nama_supplier) }}',
                    '{{ addslashes($s->id_sp) }}',
                    '{{ addslashes($s->alamat) }}',
                    '{{ addslashes($s->kontak) }}',
                    '{{ $s->foto ? asset('uploads/supplier/'.$s->foto) : '' }}'
                )">

                <h3>{{ $s->nama_supplier }}</h3>
                <p><strong>Kode Supplier:</strong> {{ $s->id_sp }}</p>
                <p><strong>Alamat:</strong> {{ $s->alamat }}</p>
                <p><strong>Kontak:</strong> {{ $s->kontak }}</p>

                @if($s->foto)
                    <img src="{{ asset('uploads/supplier/' . $s->foto) }}" alt="Foto Supplier">
                @endif

                <div class="actions" onclick="event.stopPropagation();">
                    <a href="{{ route('supplier.edit', $s->id_sp) }}">Edit</a>

                    <form action="{{ route('supplier.destroy', $s->id_sp) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Hapus</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Modal Popup -->
    <div id="popupModal" style="display: none;z-index: 999; position: fixed; top: 0; left: 0;
        width: 100%; height: 100%; background-color: rgba(0,0,0,0.5); justify-content: center; align-items: center;">
        <div style="background-color: white; padding: 20px; width: 400px; border-radius: 10px; position: relative;">
            <span onclick="closeModal()" style="position: absolute; top: 5px; right: 10px; cursor: pointer; font-weight: bold;">&times;</span>
            <h3 id="popupNama"></h3>
            <p><strong>Kode Supplier:</strong> <span id="popupKode"></span></p>
            <p><strong>Alamat:</strong> <span id="popupAlamat"></span></p>
            <p><strong>Kontak:</strong> <span id="popupKontak"></span></p>
            <img id="popupFoto" src="" style="max-width: 100%; max-height: 300px; width: auto; height: auto; margin-top: 10px; object-fit: contain;" alt="Foto Supplier">
        </div>
    </div>

    <script>
        function showPopup(nama, kode, alamat, kontak, fotoUrl) {
            document.getElementById('popupNama').innerText = nama;
            document.getElementById('popupKode').innerText = kode;
            document.getElementById('popupAlamat').innerText = alamat;
            document.getElementById('popupKontak').innerText = kontak;

            const fotoEl = document.getElementById('popupFoto');
            if (fotoUrl) {
                fotoEl.src = fotoUrl;
                fotoEl.style.display = 'block';
            } else {
                fotoEl.style.display = 'none';
            }

            document.getElementById('popupModal').style.display = 'flex';
        }

        function closeModal() {
            document.getElementById('popupModal').style.display = 'none';
        }
    </script>

        </main>

        
    </div>


    
</body>
</html>

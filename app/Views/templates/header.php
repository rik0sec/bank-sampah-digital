<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'Bank Sampah') ?> | Bank Sampah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body.dark-mode .card h5,
body.dark-mode .card h6,
body.dark-mode .card p,
body.dark-mode .card-header,
body.dark-mode .card-body,
body.dark-mode .table-responsive,
body.dark-mode thead,
body.dark-mode .fw-bold,
body.dark-mode .fw-semibold {
    color: #e2e8f0 !important;
}

body.dark-mode .bg-dark,
body.dark-mode [class*="bg-"] h5,
body.dark-mode [class*="bg-"] h6 {
    color: #fff !important;
}
        :root {
            --sidebar-width: 250px;
        }
        body.dark-mode {
            background-color: #1a1a2e;
            color: #e0e0e0;
        }
        body.dark-mode .card{
    background:#1f2937;
    border:1px solid rgba(255,255,255,.08);
    border-radius:16px;
    color:#f8fafc;
}
        /* ===== DARK MODE FIXES ===== */
body.dark-mode {
    background-color: #0f172a;
    color: #e2e8f0;
}

body.dark-mode .card {
    background: #1e293b;
    border: 1px solid rgba(255,255,255,.08);
    border-radius: 16px;
    color: #f1f5f9;
}

body.dark-mode .table {
    color: #e2e8f0;
    --bs-table-bg: transparent;
    --bs-table-striped-bg: transparent;
    --bs-table-hover-bg: rgba(255,255,255,.04);
}

body.dark-mode .table thead th {
    background: #1e293b !important;
    color: #94a3b8 !important;
    border-bottom: 2px solid rgba(255,255,255,.08) !important;
}

body.dark-mode .table tbody td {
    border-color: rgba(255,255,255,.06);
    color: #e2e8f0;
}

body.dark-mode .table tbody tr:hover {
    background: rgba(255,255,255,.04) !important;
}

body.dark-mode .table tbody tr {
    border-bottom: 1px solid rgba(255,255,255,.06);
}

body.dark-mode .btn-light {
    background: #1e293b;
    border-color: rgba(255,255,255,.15);
    color: #e2e8f0;
}

body.dark-mode .dropdown-menu {
    background: #1e293b;
    border: 1px solid rgba(255,255,255,.1);
}

body.dark-mode .dropdown-item {
    color: #e2e8f0;
}

body.dark-mode .dropdown-item-text {
    color: #cbd5e1 !important;
}
body.dark-mode .dropdown-item-text b {
    color: #f1f5f9 !important;
}

body.dark-mode .dropdown-item:hover {
    background: #334155;
    color: #fff;
}

body.dark-mode .dropdown-divider {
    border-color: rgba(255,255,255,.1);
}

body.dark-mode .text-muted {
    color: #94a3b8 !important;
}

body.dark-mode .badge {
    opacity: 0.9;
}

body.dark-mode input,
body.dark-mode select,
body.dark-mode textarea {
    background: #1e293b !important;
    border-color: rgba(255,255,255,.15) !important;
    color: #e2e8f0 !important;
}

body.dark-mode input::placeholder {
    color: #64748b !important;
}

/* ===== STAT CARD GRADIENT (tema hijau/earthy) ===== */
.stat-card{
    position: relative;
    overflow: hidden;
    border: none;
}
.stat-card .icon-corner{
    position: absolute;
    right: -8px;
    bottom: -12px;
    font-size: 4.2rem;
    opacity: .18;
}
.stat-card .stat-label{
    font-size: .76rem;
    text-transform: uppercase;
    letter-spacing: .6px;
    opacity: .92;
    font-weight: 700;
}
.stat-card .stat-value{
    font-size: 1.85rem;
    font-weight: 700;
    margin: 6px 0 2px;
}
.stat-card .stat-sub{
    font-size: .74rem;
    opacity: .85;
}

.stat-grad-green     { background: linear-gradient(135deg,#22c55e,#16a34a) !important; }
.stat-grad-teal       { background: linear-gradient(135deg,#14b8a6,#0d9488) !important; }
.stat-grad-emerald    { background: linear-gradient(135deg,#10b981,#059669) !important; }
.stat-grad-lime       { background: linear-gradient(135deg,#84cc16,#65a30d) !important; }
.stat-grad-amber      { background: linear-gradient(135deg,#d97706,#b45309) !important; }
.stat-grad-forest     { background: linear-gradient(135deg,#15803d,#166534) !important; }
.stat-grad-terracotta { background: linear-gradient(135deg,#c2410c,#9a3412) !important; }

.stat-card,
.stat-card *:not(.icon-corner){ color:#fff !important; }
.stat-card .stat-sub{ color:rgba(255,255,255,.85) !important; }

/* ===== TOP NAVBAR MODERN ===== */
.brand-badge{
    width: 42px; height: 42px;
    border-radius: 12px;
    background: linear-gradient(135deg,#22c55e,#16a34a);
    display: flex; align-items: center; justify-content: center;
    color: #fff; font-size: 1.25rem;
    box-shadow: 0 4px 10px rgba(34,197,94,.35);
    flex-shrink: 0;
}
.navbar-brand-title{
    color: #fff; font-weight: 700; font-size: 1.02rem; margin-bottom: 0;
    letter-spacing: .2px;
}
.navbar-brand-sub{
    color: rgba(255,255,255,.55); font-size: .74rem;
}
.theme-toggle-btn{
    width: 40px; height: 40px;
    border-radius: 50%;
    border: 1px solid rgba(255,255,255,.14);
    background: rgba(255,255,255,.07);
    color: #fbbf24;
    display: flex; align-items: center; justify-content: center;
    font-size: 1rem;
    transition: all .25s ease;
    margin-right: 14px;
}
.theme-toggle-btn:hover{
    background: rgba(255,255,255,.16);
    transform: rotate(15deg);
}
.user-menu-btn{
    background: rgba(255,255,255,.06) !important;
    border: 1px solid rgba(255,255,255,.14) !important;
    border-radius: 50px !important;
    padding: 5px 14px 5px 6px !important;
    transition: background .2s ease;
}
.user-menu-btn:hover{ background: rgba(255,255,255,.14) !important; }
.user-menu-btn::after{ display: none !important; }
.user-menu-btn .avatar-ring{
    width: 36px; height: 36px;
    border-radius: 50%;
    background: linear-gradient(135deg,#22c55e,#16a34a);
    display: flex; align-items: center; justify-content: center;
    color: #fff; font-weight: 700; font-size: .95rem;
    border: 2px solid rgba(255,255,255,.25);
}
.user-menu-btn .user-name{ color: #fff; font-weight: 600; font-size: .86rem; line-height: 1.15; }
.user-menu-btn .user-role{ color: rgba(255,255,255,.55); font-size: .7rem; }
.user-menu-btn .chev{
    color: rgba(255,255,255,.5); font-size: .72rem; margin-left: 4px;
    transition: transform .2s ease;
}
.user-menu-btn[aria-expanded="true"] .chev{ transform: rotate(180deg); }
/* ===== END TOP NAVBAR MODERN ===== */

/* ===== SIDEBAR SECTION LABEL ===== */
.sidebar .nav-section-label{
    display: block;
    width: 100%;
    font-size: .68rem;
    text-transform: uppercase;
    letter-spacing: 1px;
    color: rgba(255,255,255,.38);
    font-weight: 700;
    padding: 18px 20px 6px;
    white-space: nowrap;
}

/* ===== DASHBOARD HEADER GREETING ===== */
.dash-greeting-bar{
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 12px;
    background: #fff;
    border-left: 4px solid #22c55e;
    border-radius: 10px;
    padding: 10px 16px;
    margin-bottom: 18px;
    box-shadow: 0 2px 8px rgba(0,0,0,.05);
}
.dash-greeting-bar .greet-text{ font-size: .88rem; color: #475569; }
.dash-greeting-bar .greet-name{ font-weight: 700; color: #1e293b; }
.dash-greeting-bar .date-pill{
    background: #f0fdf4;
    color: #16a34a;
    font-size: .76rem;
    font-weight: 600;
    padding: 5px 12px;
    border-radius: 50px;
    white-space: nowrap;
}
body.dark-mode .dash-greeting-bar{ background: #1e293b; border-left-color: #22c55e; }
body.dark-mode .dash-greeting-bar .greet-text{ color: #94a3b8; }
body.dark-mode .dash-greeting-bar .greet-name{ color: #f1f5f9; }
body.dark-mode .dash-greeting-bar .date-pill{ background: rgba(34,197,94,.12); color: #4ade80; }

/* ===== CHART CARD HEADER ===== */
.chart-card-title{ font-weight: 700; margin-bottom: 2px; }
.chart-card-sub{ font-size: .8rem; color: #6b7a8d; }
body.dark-mode .chart-card-sub{ color: #94a3b8; }

/* ===== BADGE KATEGORI JENIS SAMPAH ===== */
.badge-kategori{
    font-weight: 600;
    font-size: .72rem;
    text-transform: capitalize;
    padding: 5px 12px;
    border-radius: 50px;
}
.badge-kertas    { background:#fef3c7; color:#92400e; }
.badge-plastik   { background:#dbeafe; color:#1d4ed8; }
.badge-logam     { background:#e2e8f0; color:#334155; }
.badge-kaca      { background:#cffafe; color:#0e7490; }
.badge-elektronik{ background:#ede9fe; color:#6d28d9; }
.badge-lainnya   { background:#f1f5f9; color:#475569; }

body.dark-mode .badge-kertas    { background: rgba(217,119,6,.18); color:#fbbf24; }
body.dark-mode .badge-plastik   { background: rgba(37,99,235,.18); color:#60a5fa; }
body.dark-mode .badge-logam     { background: rgba(148,163,184,.18); color:#cbd5e1; }
body.dark-mode .badge-kaca      { background: rgba(8,145,178,.18); color:#22d3ee; }
body.dark-mode .badge-elektronik{ background: rgba(124,58,237,.18); color:#a78bfa; }
body.dark-mode .badge-lainnya   { background: rgba(255,255,255,.08); color:#cbd5e1; }

.icon-jenis-sampah{
    width: 34px; height: 34px;
    border-radius: 8px;
    display: flex; align-items: center; justify-content: center;
    font-size: .95rem;
    flex-shrink: 0;
}
.kode-jenis-pill{
    font-family: monospace;
    font-size: .76rem;
    font-weight: 700;
    color: #64748b;
    background: #f1f5f9;
    padding: 3px 8px;
    border-radius: 6px;
}
body.dark-mode .kode-jenis-pill{ background: rgba(255,255,255,.06); color:#94a3b8; }

/* ===== HARGA SAMPAH ===== */
.harga-value{
    font-weight: 700;
    font-size: 1rem;
    color: #16a34a;
}
body.dark-mode .harga-value{ color: #4ade80; }

.periode-pill{
    display: inline-flex;
    align-items: center;
    gap: 5px;
    font-size: .82rem;
    color: #475569;
    background: #f8fafc;
    padding: 5px 12px;
    border-radius: 50px;
    border: 1px solid #e2e8f0;
}
body.dark-mode .periode-pill{
    background: rgba(255,255,255,.05);
    border-color: rgba(255,255,255,.1);
    color: #cbd5e1;
}

.status-aktif{
    background: #dcfce7; color:#15803d;
    font-weight: 600; font-size: .74rem;
    padding: 5px 12px; border-radius: 50px;
}
.status-berakhir{
    background: #fee2e2; color:#b91c1c;
    font-weight: 600; font-size: .74rem;
    padding: 5px 12px; border-radius: 50px;
}
body.dark-mode .status-aktif{ background: rgba(34,197,94,.15); color:#4ade80; }
body.dark-mode .status-berakhir{ background: rgba(239,68,68,.15); color:#f87171; }

/* ===== FORM CARD MODERN ===== */
.form-section-card{
    background: #fff;
    border-radius: 16px;
    border: 1px solid #e9edf1;
    padding: 28px 30px;
}
body.dark-mode .form-section-card{
    background: #1e293b;
    border-color: rgba(255,255,255,.08);
}
.form-label-icon{
    display: inline-flex;
    align-items: center;
    gap: 6px;
    font-weight: 600;
    font-size: .85rem;
    color: #334155;
    margin-bottom: 6px;
}
body.dark-mode .form-label-icon{ color: #cbd5e1; }
.form-label-icon i{ color: #16a34a; font-size: .9rem; }

.form-section-card .form-control,
.form-section-card .form-select{
    border-radius: 10px;
    padding: 10px 14px;
    border: 1px solid #e2e8f0;
}
body.dark-mode .form-section-card .form-control,
body.dark-mode .form-section-card .form-select{
    background: #0f172a;
    border-color: rgba(255,255,255,.1);
    color: #e2e8f0;
}
.form-section-card .form-control:focus,
.form-section-card .form-select:focus{
    border-color: #22c55e;
    box-shadow: 0 0 0 3px rgba(34,197,94,.15);
}
/* ===== END FORM CARD MODERN ===== */

/* ===== END DARK MODE ===== */
body{
    background:#f1f5f9;
    font-family:'Segoe UI',sans-serif;
}
        body.dark-mode .bg-light { background-color: #16213e !important; }
        body.dark-mode .navbar { background-color: #0f3460 !important; }
        body.dark-mode .sidebar { background-color: #0f3460 !important; }
        body.dark-mode .list-group-item { background-color: #16213e; color: #e0e0e0; border-color: #0f3460; }
        body.dark-mode .list-group-item:hover { background-color: #1a1a2e; }

        /* ===================================================== */
        /* ============ SIDEBAR - FIX SCROLL SAAT ZOOM =========== */
        /* ===================================================== */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: var(--sidebar-width);
            height: 100vh;
            background: #2c3e50;
            padding-top: 60px;
            z-index: 100;
            transition: all 0.3s;
            display: flex;
            flex-direction: column;
            overflow: hidden; /* penting: bikin browser hitung ulang area scroll saat zoom */
            transform: translateZ(0); /* paksa GPU layer sendiri, cegah repaint glitch saat zoom (bug Firefox) */
            backface-visibility: hidden;
        }

        /* Bagian logo + profil user tidak boleh ikut mengecil/terdesak */
        .sidebar > .sidebar-top{
            flex-shrink: 0;
        }

        /* Daftar menu jadi satu-satunya area yang scroll */
        .sidebar > ul.nav{
            display: flex !important;
            flex-direction: column !important;
            flex-wrap: nowrap !important;
            flex: 1 1 auto;
            min-height: 0;      /* kunci utama supaya overflow-y:auto benar-benar bekerja saat zoom */
            overflow-y: auto;
            overflow-x: hidden;
            padding-bottom: 24px;
            width: 100%;
        }
        /* Setiap item (li menu ATAU div label section) wajib penuh selebar sidebar
           dan tidak boleh menyusut/berbagi baris dengan item lain */
        .sidebar > ul.nav > li,
        .sidebar > ul.nav > .nav-section-label{
            flex: 0 0 auto;
            width: 100%;
            max-width: 100%;
        }
        .sidebar > ul.nav::-webkit-scrollbar{ width: 5px; }
        .sidebar > ul.nav::-webkit-scrollbar-track{ background: transparent; }
        .sidebar > ul.nav::-webkit-scrollbar-thumb{
            background: rgba(255,255,255,.15);
            border-radius: 10px;
        }
        .sidebar > ul.nav::-webkit-scrollbar-thumb:hover{
            background: rgba(255,255,255,.28);
        }
        /* ===================================================== */

        .sidebar .nav-link {
            color: #ecf0f1;
            padding: 12px 20px;
            transition: all 0.3s;
        }
        .sidebar .nav-link:hover, .sidebar .nav-link.active {
            background: #34495e;
            color: #fff;
        }
        .sidebar .nav-link i {
            margin-right: 10px;
        }
        .main-content {
            margin-left: var(--sidebar-width);
            padding: 20px;
            padding-top: 70px;
            min-height: 100vh;
        }
        .top-navbar{
 position: fixed;
    top: 0;
    left: var(--sidebar-width);
    right: 0;
    height: 70px;

    background: rgba(15,23,42,.95);
    backdrop-filter: blur(10px);

    border-bottom: 1px solid rgba(255,255,255,.08);

    z-index: 999;
    transform: translateZ(0); /* paksa GPU layer sendiri, cegah repaint glitch saat zoom (bug Firefox) */
    backface-visibility: hidden;
}
        body.dark-mode .top-navbar {
            background: #0f3460;
        }
        .stat-card {
            border-radius: 10px;
            padding: 20px;
            color: #fff;
            transition: transform 0.3s;
        }
        .stat-card:hover {
            transform: translateY(-5px);
        }
        .stat-card .icon {
            font-size: 2.5rem;
            opacity: 0.7;
        }
        @media (max-width: 768px) {
            .sidebar { left: -250px; }
            .sidebar.show { left: 0; }
            .main-content, .top-navbar { margin-left: 0; left: 0; }
        }

        .sidebar{
    background: linear-gradient(
        180deg,
        #1e293b,
        #0f172a
    );
    box-shadow: 4px 0 15px rgba(0,0,0,.15);
}

.sidebar .nav-link{
    margin:4px 10px;
    border-radius:10px;
    font-weight:500;
}

.sidebar .nav-link:hover{
    background:#334155;
}

.sidebar .nav-link.active{
    background:#22c55e;
    color:white;
}

.sidebar .nav-link i{
    width:20px;
}

/* ===== Tambahan baru ===== */

.user-profile{
    background: rgba(255,255,255,.06);
    border: 1px solid rgba(255,255,255,.08);
    border-radius: 12px;
    padding: 12px;
    margin: 12px;
}

.sidebar .nav-link{
    display:flex;
    align-items:center;
    gap:12px;
    padding:12px 16px;
    border-radius:12px;
}

.sidebar .nav-link i{
    width:20px;
    text-align:center;
}

/* ========================= */

.table thead th{
    font-size:.85rem;
    text-transform:uppercase;
    letter-spacing:.5px;
    border-bottom:none;
}

.table tbody tr{
    border-bottom:1px solid rgba(255,255,255,.08);
}

.table tbody tr:hover{
    background:rgba(255,255,255,.03);
}
.table{
    margin-bottom:0;
}

.table thead th{
    background:#f8fafc;
    color:#64748b;
    font-size:.8rem;
    font-weight:700;
    border-bottom:2px solid #e2e8f0;
}

.table tbody td{
    padding:14px;
}

.table tbody tr:hover{
    background:#f8fafc;
}

.card{
    border:none;
    border-radius:18px;
    box-shadow:0 4px 20px rgba(0,0,0,.08);
}

.btn{
    border-radius:10px;
}

body.dark-mode .modal-content {
    background: #1e293b;
    color: #e2e8f0;
}
body.dark-mode .modal-header,
body.dark-mode .modal-footer {
    border-color: rgba(255,255,255,.08);
}
body.dark-mode .modal-title {
    color: #f1f5f9;
}
body.dark-mode .btn-close {
    filter: invert(1);
}

</style>

</head>
<body>
    <?php if (session('logged_in')): ?>
        <div class="top-navbar navbar navbar-expand-lg px-4">
        <div class="container-fluid">
            <button class="btn btn-outline-secondary d-md-none me-2" onclick="document.querySelector('.sidebar').classList.toggle('show')">
                <i class="bi bi-list"></i>
            </button>

            <div class="d-flex align-items-center">
                <div class="brand-badge me-3">
                    <i class="bi bi-recycle"></i>
                </div>
                <div>
                    <h5 class="navbar-brand-title">Bank Sampah Digital</h5>
                    <small class="navbar-brand-sub">Sistem Manajemen Bank Sampah</small>
                </div>
            </div>

            <div class="ms-auto d-flex align-items-center">
                <button id="darkModeToggle" class="theme-toggle-btn" onclick="toggleDarkMode()" title="Ganti tema">
                    <i class="bi bi-moon-stars-fill"></i>
                </button>

                <div class="dropdown">
                    <button class="btn user-menu-btn dropdown-toggle d-flex align-items-center"
                            type="button"
                            data-bs-toggle="dropdown">

                        <div class="avatar-ring me-2">
                            <?= strtoupper(substr(session('nama'), 0, 1)) ?>
                        </div>

                        <div class="text-start">
                            <div class="user-name"><?= esc(session('nama')) ?></div>
                            <div class="user-role"><?= ucfirst(session('role')) ?></div>
                        </div>

                        <i class="bi bi-chevron-down chev"></i>
                    </button>

                    <ul class="dropdown-menu dropdown-menu-end shadow">
                        <li>
                            <span class="dropdown-item-text">
                                Login sebagai
                                <b><?= ucfirst(session('role')) ?></b>
                            </span>
                        </li>

                        <?php
                        $linkProfil = '#';

                        if (session('role') == 'admin') {
                            $linkProfil = base_url('profil-admin');
                        } elseif (session('role') == 'petugas') {
                            $linkProfil = base_url('profil-petugas');
                        } elseif (session('role') == 'nasabah') {
                            $db = db_connect();
                            $nasabah = $db->query(
                                "SELECT id FROM nasabah WHERE user_id = ?",
                                [session('id')]
                            )->getRow();
                            if ($nasabah) {
                                $linkProfil = base_url('nasabah-menu/profil/' . $nasabah->id);
                            }
                        }
                        ?>

                        <li>
                            <a class="dropdown-item" href="<?= $linkProfil ?>">
                                <i class="bi bi-person"></i> Profil Saya
                            </a>
                        </li>

                        <li><hr class="dropdown-divider"></li>

                        <li>
                            <a class="dropdown-item text-danger" href="<?= base_url('logout') ?>">
                                <i class="bi bi-box-arrow-right"></i>
                                Logout
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>
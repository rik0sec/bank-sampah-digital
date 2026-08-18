<?php if (session('logged_in')): ?>
<div class="sidebar">
    <div class="sidebar-top">
        <div class="text-center py-3 text-white border-bottom border-secondary">
            <i class="bi bi-recycle fs-2"></i>
            <h6 class="mt-2">Bank Sampah</h6>
            <small class="text-white-50">E-Waste Management</small>

            <div class="user-profile mt-3">
                <div class="fw-semibold">
                    <?= esc(session('nama')) ?>
                </div>
                <small class="text-white-50">
                    <?= ucfirst(session('role')) ?>
                </small>
            </div>
        </div>
    </div>

    <ul class="nav flex-column mt-2">
        <?php if (session('role') == 'admin'): ?>

    <div class="nav-section-label">Menu</div>
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('dashboard') ?>">
            <i class="bi bi-speedometer2"></i> Dashboard
        </a>
    </li>

    <div class="nav-section-label">Data Master</div>
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('nasabah') ?>">
            <i class="bi bi-people"></i> Data Nasabah
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('jenis-sampah') ?>">
            <i class="bi bi-trash"></i> Jenis Sampah
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('harga-sampah') ?>">
            <i class="bi bi-tag"></i> Harga Sampah
        </a>
    </li>

    <div class="nav-section-label">Transaksi</div>
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('penyetoran') ?>">
            <i class="bi bi-box-arrow-in-down"></i> Penyetoran
        </a>
    </li>

    <div class="nav-section-label">Laporan</div>
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('laporan') ?>">
            <i class="bi bi-file-earmark-text"></i> Laporan
        </a>
    </li>

    <div class="nav-section-label">Administrasi</div>
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('user') ?>">
            <i class="bi bi-person-gear"></i> Manajemen User
        </a>
    </li>

<?php elseif (session('role') == 'petugas'): ?>

    <div class="nav-section-label">Menu</div>
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('dashboard-petugas') ?>">
            <i class="bi bi-speedometer2"></i> Dashboard
        </a>
    </li>

    <div class="nav-section-label">Data Master</div>
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('nasabah') ?>">
            <i class="bi bi-people"></i> Data Nasabah
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('jenis-sampah') ?>">
            <i class="bi bi-trash"></i> Jenis Sampah
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('harga-sampah') ?>">
            <i class="bi bi-tag"></i> Harga Sampah
        </a>
    </li>

    <div class="nav-section-label">Transaksi</div>
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('pengajuan-setoran') ?>">
            <i class="bi bi-inbox"></i> Pengajuan Setoran
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('penyetoran') ?>">
            <i class="bi bi-check-circle"></i> Penyetoran
        </a>
    </li>

    <div class="nav-section-label">Laporan</div>
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('laporan-petugas') ?>">
            <i class="bi bi-file-earmark-bar-graph"></i> Laporan Harian
        </a>
    </li>

<?php elseif (session('role') == 'nasabah'): ?>

<?php
$db = db_connect();

$nasabah = $db->query(
    "SELECT id FROM nasabah WHERE user_id = ?",
    [session('id')]
)->getRow();

$nasabahId = $nasabah->id ?? 0;
?>

    <div class="nav-section-label">Menu</div>
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('nasabah-menu/dashboard/'.$nasabahId) ?>">
            <i class="bi bi-speedometer2"></i> Dashboard Saya
        </a>
    </li>

    <div class="nav-section-label">Data Master</div>
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('jenis-sampah') ?>">
            <i class="bi bi-trash"></i> Jenis Sampah
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('harga-sampah') ?>">
            <i class="bi bi-tag"></i> Harga Sampah
        </a>
    </li>

    <div class="nav-section-label">Transaksi</div>
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('setor-sampah') ?>">
            <i class="bi bi-box-arrow-in-down"></i> Setor Sampah
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('nasabah-menu/cetak-nota/'.$nasabahId) ?>">
            <i class="bi bi-printer"></i> Nota Setoran
        </a>
    </li>

<?php endif; ?>
    </ul>
</div>
<?php endif; ?>
<div class="main-content">
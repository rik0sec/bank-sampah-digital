<?= view('templates/header') ?>
<?= view('templates/sidebar') ?>

<?php if(session()->getFlashdata('success')): ?>
<div class="alert alert-success alert-dismissible fade show">
    <i class="bi bi-check-circle"></i> <?= session()->getFlashdata('success') ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
<?php endif; ?>

<?php if(session()->getFlashdata('error')): ?>
<div class="alert alert-danger alert-dismissible fade show">
    <i class="bi bi-x-circle"></i> <?= session()->getFlashdata('error') ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
<?php endif; ?>

<?php
$jam = (int) date('H');
$sapaan = $jam < 11 ? 'Selamat pagi' : ($jam < 15 ? 'Selamat siang' : ($jam < 18 ? 'Selamat sore' : 'Selamat malam'));
?>
<div class="dash-greeting-bar">
    <div class="greet-text">
        <?= $sapaan ?>, <span class="greet-name"><?= esc(session('nama')) ?></span> 👋
    </div>
    <div class="date-pill">
        <i class="bi bi-calendar3"></i> <?= date('d F Y') ?>
    </div>
</div>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3">
    <h1 class="h2 mb-0">Dashboard Admin</h1>
</div>

<div class="row g-3 mb-4">

    <div class="col-xl-3 col-md-4 col-6">
        <div class="card stat-card stat-grad-green">
            <div class="card-body">
                <i class="bi bi-people-fill icon-corner"></i>
                <div class="stat-label">Total Nasabah</div>
                <div class="stat-value"><?= esc($total_nasabah) ?></div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-4 col-6">
        <div class="card stat-card stat-grad-teal">
            <div class="card-body">
                <i class="bi bi-recycle icon-corner"></i>
                <div class="stat-label">Jenis Sampah</div>
                <div class="stat-value"><?= esc($total_jenis_sampah) ?></div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-4 col-6">
        <div class="card stat-card stat-grad-emerald">
            <div class="card-body">
                <i class="bi bi-check-circle-fill icon-corner"></i>
                <div class="stat-label">Penyetoran Disetujui</div>
                <div class="stat-value"><?= esc($total_penyetoran) ?></div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-4 col-6">
        <div class="card stat-card stat-grad-lime">
            <div class="card-body">
                <i class="bi bi-speedometer icon-corner"></i>
                <div class="stat-label">Total Berat Masuk</div>
                <div class="stat-value"><?= esc($total_berat_masuk) ?> kg</div>
                <div class="stat-sub">Dari penyetoran disetujui</div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-4 col-6">
        <div class="card stat-card stat-grad-amber">
            <div class="card-body">
                <i class="bi bi-hourglass-split icon-corner"></i>
                <div class="stat-label">Pengajuan Pending</div>
                <div class="stat-value"><?= esc($total_pending) ?></div>
                <div class="stat-sub">Menunggu persetujuan petugas</div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-4 col-6">
        <div class="card stat-card stat-grad-forest">
            <div class="card-body">
                <i class="bi bi-cash-coin icon-corner"></i>
                <div class="stat-label">Total Pemasukan</div>
                <div class="stat-value">Rp <?= number_format($total_pemasukan ?? 0, 0, ',', '.') ?></div>
                <div class="stat-sub">Dari penyetoran disetujui</div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-4 col-6">
        <div class="card stat-card stat-grad-terracotta">
            <div class="card-body">
                <i class="bi bi-x-circle-fill icon-corner"></i>
                <div class="stat-label">Pengajuan Ditolak</div>
                <div class="stat-value"><?= esc($total_ditolak) ?></div>
                <div class="stat-sub">Pengajuan yang ditolak</div>
            </div>
        </div>
    </div>

</div>

<div class="row g-3 mb-4">
    <div class="col-md-12">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <div class="chart-card-title">Grafik Berat per Bulan</div>
                <div class="chart-card-sub mb-3">Tren total berat sampah masuk sepanjang tahun</div>
                <canvas id="grafikBulanan" style="max-height: 300px;"></canvas>
            </div>
        </div>
    </div>
</div>

<script>
const grafikBulananCtx = document.getElementById('grafikBulanan');
if (grafikBulananCtx) {
    new Chart(grafikBulananCtx, {
        type: 'bar',
        data: {
            labels: <?= $grafik_bulan ?: json_encode(['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des']) ?>,
            datasets: [{
                label: 'Berat (kg)',
                data: <?= $grafik_berat ?: json_encode([0,0,0,0,0,0,0,0,0,0,0,0]) ?>,
                backgroundColor: 'rgba(34, 197, 94, 0.7)',
                borderColor: 'rgba(34, 197, 94, 1)',
                borderWidth: 1,
                borderRadius: 6
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: { y: { beginAtZero: true } }
        }
    });
}
</script>
<?= view('templates/footer') ?>
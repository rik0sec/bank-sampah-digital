<?= view('templates/header') ?>
<?= view('templates/sidebar') ?>

<div class="dash-greeting-bar">
    <div class="greet-text">
        Halo, <span class="greet-name"><?= esc(session('nama')) ?></span> 👋
    </div>
    <div class="date-pill">
        <i class="bi bi-calendar3"></i> <?= date('d F Y') ?>
    </div>
</div>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3">
    <h1 class="h2 mb-0">Dashboard Petugas</h1>
</div>

<div class="row g-3 mb-4">

    <div class="col-xl-3 col-md-4 col-6">
        <div class="card stat-card stat-grad-teal">
            <div class="card-body">
                <i class="bi bi-people-fill icon-corner"></i>
                <div class="stat-label">Total Nasabah</div>
                <div class="stat-value"><?= esc($total_nasabah) ?></div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-4 col-6">
        <div class="card stat-card stat-grad-emerald">
            <div class="card-body">
                <i class="bi bi-recycle icon-corner"></i>
                <div class="stat-label">Jenis Sampah</div>
                <div class="stat-value"><?= esc($total_jenis_sampah) ?></div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-4 col-6">
        <div class="card stat-card stat-grad-amber">
            <div class="card-body">
                <i class="bi bi-hourglass-split icon-corner"></i>
                <div class="stat-label">Pengajuan Pending</div>
                <div class="stat-value"><?= esc($pendingSetoran) ?></div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-4 col-6">
        <div class="card stat-card stat-grad-green">
            <div class="card-body">
                <i class="bi bi-check-circle-fill icon-corner"></i>
                <div class="stat-label">Setoran Disetujui</div>
                <div class="stat-value"><?= esc($setoranDisetujui) ?></div>
            </div>
        </div>
    </div>

    <div class="col-xl-4 col-md-4 col-6">
        <div class="card stat-card stat-grad-lime">
            <div class="card-body">
                <i class="bi bi-speedometer icon-corner"></i>
                <div class="stat-label">Total Berat Disetujui</div>
                <div class="stat-value"><?= esc($totalBerat) ?> Kg</div>
                <div class="stat-sub">Pengajuan yang telah disetujui</div>
            </div>
        </div>
    </div>

    <div class="col-xl-4 col-md-4 col-6">
        <div class="card stat-card stat-grad-teal">
            <div class="card-body">
                <i class="bi bi-box-arrow-in-down icon-corner"></i>
                <div class="stat-label">Total Berat Masuk</div>
                <div class="stat-value"><?= esc($total_berat_masuk) ?> Kg</div>
                <div class="stat-sub">Dari penyetoran</div>
            </div>
        </div>
    </div>

    <div class="col-xl-4 col-md-4 col-6">
        <div class="card stat-card stat-grad-forest">
            <div class="card-body">
                <i class="bi bi-clipboard-check-fill icon-corner"></i>
                <div class="stat-label">Total Setoran Disetujui</div>
                <div class="stat-value"><?= esc($setoranDisetujui) ?></div>
                <div class="stat-sub">Semua pengajuan yang diterima</div>
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

<div class="row g-3 mb-4">
    <div class="col-md-12">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <div class="chart-card-title mb-3">Riwayat Pengajuan Terbaru</div>

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Nasabah</th>
                                <th>Jenis Sampah</th>
                                <th>Berat</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($riwayat as $r): ?>
                            <tr>
                                <td><?= date('d-m-Y H:i', strtotime($r->created_at)) ?></td>
                                <td><?= esc($r->nama) ?></td>
                                <td><?= esc($r->nama_jenis) ?></td>
                                <td><?= $r->berat ?> Kg</td>
                                <td>
                                    <?php if ($r->status == 'pending'): ?>
                                        <span class="badge bg-warning">Pending</span>
                                    <?php elseif ($r->status == 'disetujui'): ?>
                                        <span class="badge bg-success">Disetujui</span>
                                    <?php else: ?>
                                        <span class="badge bg-danger">Ditolak</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
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
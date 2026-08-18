<?= view('templates/header') ?>
<?= view('templates/sidebar') ?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <div>
        <h1 class="h2 mb-1">Detail Penyetoran</h1>
        <p class="text-muted mb-0">Kode transaksi: <strong><?= esc($penyetoran->kode_transaksi) ?></strong></p>
    </div>
    <a href="<?= base_url('penyetoran') ?>" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>
</div>

<div class="row g-3 mb-3">
    <div class="col-md-3 col-6">
        <div class="card stat-card stat-grad-teal">
            <div class="card-body">
                <i class="bi bi-person-fill icon-corner"></i>
                <div class="stat-label">Nasabah</div>
                <div class="stat-value" style="font-size:1.1rem;"><?= esc($nama_nasabah) ?></div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-6">
        <div class="card stat-card stat-grad-green">
            <div class="card-body">
                <i class="bi bi-calendar3 icon-corner"></i>
                <div class="stat-label">Tanggal</div>
                <div class="stat-value" style="font-size:1.1rem;"><?= date('d M Y', strtotime($penyetoran->tanggal)) ?></div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-6">
        <div class="card stat-card stat-grad-lime">
            <div class="card-body">
                <i class="bi bi-speedometer icon-corner"></i>
                <div class="stat-label">Total Berat</div>
                <div class="stat-value"><?= esc($penyetoran->total_berat) ?> kg</div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-6">
        <div class="card stat-card stat-grad-forest">
            <div class="card-body">
                <i class="bi bi-cash-coin icon-corner"></i>
                <div class="stat-label">Total Harga</div>
                <div class="stat-value" style="font-size:1.2rem;">Rp <?= number_format($penyetoran->total_harga, 0, ',', '.') ?></div>
            </div>
        </div>
    </div>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body">
        <div class="chart-card-title mb-3">Rincian Jenis Sampah</div>
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Jenis Sampah</th>
                        <th>Berat (kg)</th>
                        <th>Harga/Kg</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($detail as $d): ?>
                    <tr>
                        <td><strong><?= esc($d->nama_jenis) ?></strong></td>
                        <td><?= esc($d->berat) ?> kg</td>
                        <td>Rp <?= number_format($d->harga_per_kg, 0, ',', '.') ?></td>
                        <td class="harga-value">Rp <?= number_format($d->subtotal, 0, ',', '.') ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= view('templates/footer') ?>
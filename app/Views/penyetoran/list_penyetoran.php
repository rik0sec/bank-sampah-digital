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
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
<h1 class="h2">Daftar Penyetoran</h1>
<a href="<?= base_url('penyetoran/tambah') ?>"
class="btn btn-primary">
<i class="bi bi-plus-circle"></i>
        Tambah Penyetoran
</a>
</div>

<div class="card shadow-sm border-0 mb-3">
    <div class="card-body">
        <form method="get" action="<?= base_url('penyetoran') ?>" class="row g-2 align-items-end">
            <div class="col-md-3">
                <label class="form-label small text-muted">Dari Tanggal</label>
                <input type="date" name="dari" class="form-control" value="<?= esc($dari) ?>">
            </div>
            <div class="col-md-3">
                <label class="form-label small text-muted">Sampai Tanggal</label>
                <input type="date" name="sampai" class="form-control" value="<?= esc($sampai) ?>">
            </div>
            <div class="col-md-3 d-flex gap-2">
                <button type="submit" class="btn btn-success">
                    <i class="bi bi-funnel"></i> FIlter
                </button>
                <a href="<?= base_url('penyetoran') ?>" class="btn btn-outline-secondary">Reset</a>
            </div>
            <div class="col-md-3 d-flex gap-2 justify-content-md-end">
                <a href="<?= base_url('penyetoran/export-pdf') . (($dari || $sampai) ? '?dari='.esc($dari).'&sampai='.esc($sampai) : '') ?>"
                   target="_blank" class="btn btn-outline-danger">
                    <i class="bi bi-file-earmark-pdf"></i> PDF
                </a>
                <a href="<?= base_url('penyetoran/export-excel') . (($dari || $sampai) ? '?dari='.esc($dari).'&sampai='.esc($sampai) : '') ?>"
                   class="btn btn-outline-success">
                    <i class="bi bi-file-earmark-excel"></i> Excel
                </a>
            </div>
        </form>
    </div>
</div>

<div class="row g-3 mb-3">
    <div class="col-md-6">
        <div class="card stat-card stat-grad-teal">
            <div class="card-body">
                <i class="bi bi-speedometer icon-corner"></i>
                <div class="stat-label">Total Berat (periode ini)</div>
                <div class="stat-value"><?= number_format($total_berat_periode, 2) ?> kg</div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card stat-card stat-grad-forest">
            <div class="card-body">
                <i class="bi bi-cash-coin icon-corner"></i>
                <div class="stat-label">Total Nilai (periode ini)</div>
                <div class="stat-value">Rp <?= number_format($total_harga_periode, 0, ',', '.') ?></div>
            </div>
        </div>
    </div>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body">
        <div class="table-responsive small">
            <table class="table table-striped table-sm">
                <thead><tr><th>Kode</th><th>Nasabah</th>th>Tanggal</th><th>Total Berat</th><th>Total Harga</th><th>Status</th><th>Aksi</th></tr></thead>
                <tbody>
                <?php foreach($penyetoran as $p){?>
                <tr>
                <td><?= esc($p->kode_transaksi) ?></td><td><?= esc($p->nama_nasabah) ?></td><td><?= esc($p->tanggal) ?></td>
                <td><?= esc($p->total_berat) ?> kg</td><td>Rp <?= number_format($p->total_harga, 0, ',', '.') ?></td>
                <td><?= esc($p->status) ?></td>
                <td>
                <a href="<?= base_url('penyetoran/detail/'.$p->id) ?>" class="btn btn-sm btn-success">detail</a>
                <a href="<?= base_url('penyetoran/edit/'.$p->id) ?>" class="btn btn-sm btn-info">edit</a>
                <a href="<?= base_url('penyetoran/delete/'.$p->id) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus?')">delete</a>
                </td>
                </tr>
                <?php }?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= view('templates/footer') ?>
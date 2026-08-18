<?= view('templates/header') ?>
<?= view('templates/sidebar') ?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <div>
        <h1 class="h2 mb-1">Edit Penyetoran</h1>
        <p class="text-muted mb-0">Perbarui data transaksi <strong><?= esc($penyetoran->kode_transaksi) ?></strong>.</p>
    </div>
    <a href="<?= base_url('penyetoran') ?>" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="form-section-card">
            <form method="POST" action="<?= current_url() ?>">
                <div class="row g-3">
                    <div class="col-sm-6">
                        <label class="form-label-icon"><i class="bi bi-upc-scan"></i> Kode Transaksi</label>
                        <input type="text" class="form-control" name="kode_transaksi" value="<?= esc($penyetoran->kode_transaksi) ?>" required>
                    </div>
                    <div class="col-sm-6">
                        <label class="form-label-icon"><i class="bi bi-person"></i> Nasabah</label>
                        <select class="form-select" name="nasabah_id" required>
                            <?php foreach($nasabah as $n): ?>
                            <option value="<?= $n->id ?>" <?= $penyetoran->nasabah_id==$n->id?'selected':'' ?>><?= esc($n->nama) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-sm-6">
                        <label class="form-label-icon"><i class="bi bi-calendar3"></i> Tanggal</label>
                        <input type="date" class="form-control" name="tanggal" value="<?= esc($penyetoran->tanggal) ?>" required>
                    </div>
                    <div class="col-sm-6">
                        <label class="form-label-icon"><i class="bi bi-speedometer"></i> Total Berat (kg)</label>
                        <input type="number" step="0.01" class="form-control" name="total_berat" value="<?= esc($penyetoran->total_berat) ?>" required>
                    </div>
                    <div class="col-sm-6">
                        <label class="form-label-icon"><i class="bi bi-cash-coin"></i> Total Harga</label>
                        <input type="number" step="0.01" class="form-control" name="total_harga" value="<?= esc($penyetoran->total_harga) ?>" required>
                    </div>
                    <div class="col-sm-6">
                        <label class="form-label-icon"><i class="bi bi-flag"></i> Status</label>
                        <select class="form-select" name="status" required>
                            <option value="pending" <?= $penyetoran->status=='pending'?'selected':'' ?>>Pending</option>
                            <option value="disetujui" <?= $penyetoran->status=='disetujui'?'selected':'' ?>>Disetujui</option>
                            <option value="ditolak" <?= $penyetoran->status=='ditolak'?'selected':'' ?>>Ditolak</option>
                        </select>
                    </div>
                </div>

                <hr class="my-4">

                <div class="d-flex gap-2">
                    <button class="btn btn-success px-4" type="submit">
                        <i class="bi bi-check-circle"></i> Simpan Perubahan
                    </button>
                    <a href="<?= base_url('penyetoran') ?>" class="btn btn-outline-secondary px-4">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>

<?= view('templates/footer') ?>
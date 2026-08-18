<?= view('templates/header') ?>
<?= view('templates/sidebar') ?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <div>
        <h1 class="h2 mb-1">Tambah Penyetoran</h1>
        <p class="text-muted mb-0">Catat transaksi setoran sampah baru.</p>
    </div>
    <a href="<?= base_url('penyetoran') ?>" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="form-section-card">
            <form method="POST" action="<?= base_url('penyetoran/tambah') ?>">
                <div class="row g-3">
                    <div class="col-sm-6">
                        <label class="form-label-icon"><i class="bi bi-upc-scan"></i> Kode Transaksi</label>
                        <input type="text" class="form-control" name="kode_transaksi" placeholder="Contoh: STR20260712001" required>
                    </div>
                    <div class="col-sm-6">
                        <label class="form-label-icon"><i class="bi bi-person"></i> Nasabah</label>
                        <select class="form-select" name="nasabah_id" required>
                            <option value="">-- Pilih Nasabah --</option>
                            <?php foreach($nasabah as $n): ?>
                            <option value="<?= $n->id ?>"><?= esc($n->nama) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-sm-6">
                        <label class="form-label-icon"><i class="bi bi-calendar3"></i> Tanggal</label>
                        <input type="date" class="form-control" name="tanggal" value="<?= date('Y-m-d') ?>" required>
                    </div>
                    <div class="col-sm-6">
                        <label class="form-label-icon"><i class="bi bi-speedometer"></i> Total Berat (kg)</label>
                        <input type="number" step="0.01" class="form-control" name="total_berat" placeholder="0.00" required>
                    </div>
                    <div class="col-sm-6">
                        <label class="form-label-icon"><i class="bi bi-cash-coin"></i> Total Harga</label>
                        <input type="number" step="0.01" class="form-control" name="total_harga" placeholder="0" required>
                    </div>
                    <div class="col-sm-6">
                        <label class="form-label-icon"><i class="bi bi-flag"></i> Status</label>
                        <select class="form-select" name="status" required>
                            <option value="pending">Pending</option>
                            <option value="disetujui">Disetujui</option>
                            <option value="ditolak">Ditolak</option>
                        </select>
                    </div>
                </div>

                <hr class="my-4">

                <div class="d-flex gap-2">
                    <button class="btn btn-success px-4" type="submit">
                        <i class="bi bi-check-circle"></i> Simpan
                    </button>
                    <a href="<?= base_url('penyetoran') ?>" class="btn btn-outline-secondary px-4">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>

<?= view('templates/footer') ?>
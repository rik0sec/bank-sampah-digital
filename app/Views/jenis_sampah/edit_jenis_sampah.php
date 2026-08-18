<?= view('templates/header') ?>
<?= view('templates/sidebar') ?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <div>
        <h1 class="h2 mb-1">Edit Jenis Sampah</h1>
        <p class="text-muted mb-0">Perbarui data jenis sampah <strong><?= esc($jenis_sampah->nama_jenis) ?></strong>.</p>
    </div>
    <a href="<?= base_url('jenis-sampah') ?>" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="form-section-card">
            <form method="POST" action="<?= current_url() ?>">
                <div class="row g-3">
                    <div class="col-sm-6">
                        <label class="form-label-icon"><i class="bi bi-upc-scan"></i> Kode Jenis</label>
                        <input type="text" class="form-control" name="kode_jenis" value="<?= esc($jenis_sampah->kode_jenis) ?>" required>
                    </div>
                    <div class="col-sm-6">
                        <label class="form-label-icon"><i class="bi bi-tag"></i> Nama Jenis</label>
                        <input type="text" class="form-control" name="nama_jenis" value="<?= esc($jenis_sampah->nama_jenis) ?>" required>
                    </div>
                    <div class="col-sm-6">
                        <label class="form-label-icon"><i class="bi bi-grid"></i> Kategori</label>
                        <select class="form-select" name="kategori" required>
                            <?php $kats = ['organik','anorganik','b3','elektronik','kertas','logam','plastik','kaca']; foreach($kats as $k): ?>
                            <option value="<?= $k ?>" <?= $jenis_sampah->kategori==$k?'selected':'' ?>><?= ucfirst($k) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-sm-12">
                        <label class="form-label-icon"><i class="bi bi-card-text"></i> Deskripsi</label>
                        <textarea class="form-control" name="deskripsi" rows="3"><?= esc($jenis_sampah->deskripsi) ?></textarea>
                    </div>
                </div>

                <hr class="my-4">

                <div class="d-flex gap-2">
                    <button class="btn btn-success px-4" type="submit">
                        <i class="bi bi-check-circle"></i> Simpan Perubahan
                    </button>
                    <a href="<?= base_url('jenis-sampah') ?>" class="btn btn-outline-secondary px-4">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>

<?= view('templates/footer') ?>
<?= view('templates/header') ?>
<?= view('templates/sidebar') ?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <div>
        <h1 class="h2 mb-1">Tambah Jenis Sampah</h1>
        <p class="text-muted mb-0">Tambahkan jenis sampah baru yang dapat disetorkan nasabah.</p>
    </div>
    <a href="<?= base_url('jenis-sampah') ?>" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="form-section-card">
            <form method="POST" action="<?= base_url('jenis-sampah/tambah') ?>">
                <div class="row g-3">
                    <div class="col-sm-6">
                        <label class="form-label-icon"><i class="bi bi-upc-scan"></i> Kode Jenis</label>
                        <input type="text" class="form-control" name="kode_jenis" placeholder="Contoh: JS008" required>
                    </div>
                    <div class="col-sm-6">
                        <label class="form-label-icon"><i class="bi bi-tag"></i> Nama Jenis</label>
                        <input type="text" class="form-control" name="nama_jenis" placeholder="Contoh: Kaleng Bekas" required>
                    </div>
                    <div class="col-sm-6">
                        <label class="form-label-icon"><i class="bi bi-grid"></i> Kategori</label>
                        <select class="form-select" name="kategori" required>
                            <option value="">-- Pilih Kategori --</option>
                            <option value="organik">Organik</option>
                            <option value="anorganik">Anorganik</option>
                            <option value="b3">B3</option>
                            <option value="elektronik">Elektronik</option>
                            <option value="kertas">Kertas</option>
                            <option value="logam">Logam</option>
                            <option value="plastik">Plastik</option>
                            <option value="kaca">Kaca</option>
                        </select>
                    </div>
                    <div class="col-sm-12">
                        <label class="form-label-icon"><i class="bi bi-card-text"></i> Deskripsi</label>
                        <textarea class="form-control" name="deskripsi" rows="3" placeholder="Deskripsi singkat jenis sampah ini..."></textarea>
                    </div>
                </div>

                <hr class="my-4">

                <div class="d-flex gap-2">
                    <button class="btn btn-success px-4" type="submit">
                        <i class="bi bi-check-circle"></i> Simpan
                    </button>
                    <a href="<?= base_url('jenis-sampah') ?>" class="btn btn-outline-secondary px-4">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>

<?= view('templates/footer') ?>
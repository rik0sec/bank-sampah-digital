<?= view('templates/header') ?>
<?= view('templates/sidebar') ?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <div>
        <h1 class="h2 mb-1">Tambah Nasabah</h1>
        <p class="text-muted mb-0">Daftarkan nasabah baru ke sistem Bank Sampah.</p>
    </div>
    <a href="<?= base_url('nasabah') ?>" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="form-section-card">
            <form method="POST" action="<?= base_url('nasabah/tambah') ?>">
                <div class="row g-3">
                    <div class="col-sm-6">
                        <label class="form-label-icon"><i class="bi bi-upc-scan"></i> Kode Nasabah</label>
                        <input type="text" class="form-control" name="kode_nasabah" required placeholder="Contoh: NSB-001">
                    </div>
                    <div class="col-sm-6">
                        <label class="form-label-icon"><i class="bi bi-person"></i> Nama</label>
                        <input type="text" class="form-control" name="nama" required placeholder="Nama lengkap nasabah">
                    </div>
                    <div class="col-sm-12">
                        <label class="form-label-icon"><i class="bi bi-geo-alt"></i> Alamat</label>
                        <textarea class="form-control" name="alamat" rows="3" placeholder="Alamat nasabah"></textarea>
                    </div>
                    <div class="col-sm-6">
                        <label class="form-label-icon"><i class="bi bi-telephone"></i> No Telp</label>
                        <input type="text" class="form-control" name="no_telp" placeholder="Contoh: 081234567890">
                    </div>
                    <div class="col-sm-6">
                        <label class="form-label-icon"><i class="bi bi-envelope"></i> Email</label>
                        <input type="email" class="form-control" name="email" placeholder="Contoh: nasabah@email.com">
                    </div>
                    <div class="col-sm-6">
                        <label class="form-label-icon"><i class="bi bi-cash-coin"></i> Saldo Awal (Rp)</label>
                        <input type="number" class="form-control" name="saldo" value="0" step="0.01" min="0">
                    </div>
                </div>

                <hr class="my-4">

                <div class="d-flex gap-2">
                    <button class="btn btn-success px-4" type="submit">
                        <i class="bi bi-check-circle"></i> Simpan
                    </button>
                    <a href="<?= base_url('nasabah') ?>" class="btn btn-outline-secondary px-4">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>

<?= view('templates/footer') ?>
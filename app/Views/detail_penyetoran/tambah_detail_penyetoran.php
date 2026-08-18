<?= view('templates/header') ?>
<?= view('templates/sidebar') ?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
  <div class="col-md-7 col-lg-8">
    <h4 class="mb-3">Tambah Detail Penyetoran</h4>
    <form method="POST" action="<?= base_url('detail-penyetoran/tambah') ?>">
      <div class="row g-3">
        <div class="col-sm-12"><label class="form-label">Penyetoran</label>
          <select class="form-control" name="penyetoran_id" required><option value="">-- Pilih --</option>
            <?php foreach($penyetoran as $p): ?><option value="<?= $p->id ?>"><?= esc($p->kode_transaksi) ?></option><?php endforeach; ?>
          </select>
        </div>
        <div class="col-sm-12"><label class="form-label">Jenis Sampah</label>
          <select class="form-control" name="jenis_sampah_id" required><option value="">-- Pilih --</option>
            <?php foreach($jenis_sampah as $j): ?><option value="<?= $j->id ?>"><?= esc($j->nama_jenis) ?></option><?php endforeach; ?>
          </select>
        </div>
        <div class="col-sm-4"><label class="form-label">Berat (kg)</label><input type="number" step="0.01" class="form-control" name="berat" required/></div>
        <div class="col-sm-4"><label class="form-label">Harga/Kg</label><input type="number" step="0.01" class="form-control" name="harga_per_kg" required/></div>
        <div class="col-sm-4"><label class="form-label">Subtotal</label><input type="number" step="0.01" class="form-control" name="subtotal" required/></div>
        <hr class="my-4" /><button class="w-100 btn btn-primary btn-lg" type="submit">Simpan</button>
      </div>
    </form>
  </div>
</main>

<?= view('templates/footer') ?>
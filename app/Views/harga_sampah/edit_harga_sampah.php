<?= view('templates/header') ?>
<?= view('templates/sidebar') ?>

  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      <h3 class="mb-1">Edit Harga Sampah</h3>
      <a href="<?= base_url('harga_sampah') ?>" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Kembali ke Harga Sampah
      </a>
    </div>
  <div class="col-md-7 col-lg-8">
    <form method="POST" action="<?= current_url() ?>">
      <div class="row g-3">
        <div class="col-sm-12">
          <label class="form-label">Jenis Sampah</label>
          <select class="form-control" name="jenis_sampah_id" required>
            <?php foreach($jenis_sampah as $j): ?>
            <option value="<?= $j->id ?>" <?= $harga_sampah->jenis_sampah_id==$j->id?'selected':'' ?>><?= esc($j->nama_jenis) ?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="col-sm-6"><label class="form-label">Harga per Kg</label><input type="number" class="form-control" name="harga_per_kg" value="<?= esc($harga_sampah->harga_per_kg) ?>" required/></div>
        <div class="col-sm-6"><label class="form-label">Berlaku Mulai</label><input type="date" class="form-control" name="berlaku_mulai" value="<?= esc($harga_sampah->berlaku_mulai) ?>" required/></div>
        <div class="col-sm-6"><label class="form-label">Berlaku Sampai</label><input type="date" class="form-control" name="berlaku_sampai" value="<?= esc($harga_sampah->berlaku_sampai) ?>"/></div>
        <hr class="my-4" /><button class="w-100 btn btn-primary btn-lg" type="submit">Simpan</button>
      </div>
    </form>
  </div>


<?= view('templates/footer') ?>
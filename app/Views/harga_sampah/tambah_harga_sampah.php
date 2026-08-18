<?= view('templates/header') ?>
<?= view('templates/sidebar') ?>

  <div class="col-md-7 col-lg-8">
    <h4 class="mb-3">Tambah Harga Sampah</h4>
    <form method="POST" action="<?= base_url('harga-sampah/tambah') ?>">
      <div class="row g-3">
        <div class="col-sm-12">
          <label class="form-label">Jenis Sampah</label>
          <select class="form-control" name="jenis_sampah_id" required>
            <option value="">-- Pilih --</option>
            <?php foreach($jenis_sampah as $j): ?>
            <option value="<?= $j->id ?>"><?= esc($j->nama_jenis) ?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="col-sm-6"><label class="form-label">Harga per Kg</label><input type="number" class="form-control" name="harga_per_kg" required/></div>
        <div class="col-sm-6"><label class="form-label">Berlaku Mulai</label><input type="date" class="form-control" name="berlaku_mulai" required/></div>
        <div class="col-sm-6"><label class="form-label">Berlaku Sampai</label><input type="date" class="form-control" name="berlaku_sampai"/></div>
        <hr class="my-4" /><button class="w-100 btn btn-primary btn-lg" type="submit">Simpan</button>
      </div>
    </form>
  </div>

<?= view('templates/footer') ?>
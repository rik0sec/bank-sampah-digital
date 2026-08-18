<?= view('templates/header') ?>
<?= view('templates/sidebar') ?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Daftar Detail Penyetoran</h1>
    <div class="btn-group me-2"><a href="<?= base_url('detail-penyetoran/tambah')?>" class="btn btn-primary">Tambah</a></div>
  </div>
  <div class="table-responsive small">
    <table class="table table-striped table-sm">
      <thead><tr><th>Penyetoran ID</th><th>Jenis Sampah</th><th>Berat</th><th>Harga/Kg</th><th>Subtotal</th><th>Aksi</th></tr></thead>
      <tbody>
        <?php foreach($detail_penyetoran as $d){?>
        <tr><td><?= $d->penyetoran_id ?></td><td><?= esc($d->nama_jenis) ?></td><td><?= esc($d->berat) ?> kg</td>
          <td>Rp <?= number_format($d->harga_per_kg, 0, ',', '.') ?></td><td>Rp <?= number_format($d->subtotal, 0, ',', '.') ?></td>
          <td><a href="<?= base_url('detail-penyetoran/edit/'.$d->id) ?>" class="btn btn-sm btn-info">edit</a>
            <a href="<?= base_url('detail-penyetoran/delete/'.$d->id) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus?')">delete</a>
          </td>
        </tr>
        <?php }?>
      </tbody>
    </table>
  </div>
</main>

<?= view('templates/footer') ?>
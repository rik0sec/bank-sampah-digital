<!doctype html>
<html lang="en" data-bs-theme="auto">
  <head>
    <meta charset="utf-8" /><meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Bank Sampah · Edit Detail Penyetoran</title>
    <script src="<?=base_url()?>assets/js/color-modes.js"></script>
    <link href="<?=base_url()?>public/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" />
    <meta name="theme-color" content="#712cf9" /><link href="<?=base_url()?>public/bootstrap/dashboard/dashboard.css" rel="stylesheet" />
  </head>
  <body>
    <header class="navbar sticky-top bg-dark flex-md-nowrap p-0 shadow" data-bs-theme="dark">
      <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6 text-white" href="#">RikoSec</a>
    </header>
    <div class="container-fluid"><div class="row">
      <div class="sidebar border border-right col-md-3 col-lg-2 p-0 bg-body-tertiary">
        <div class="offcanvas-body d-md-flex flex-column p-0 pt-lg-3 overflow-y-auto">
          <ul class="nav flex-column">
            <li class="nav-item"><a class="nav-link" href="<?=base_url("")?>">Dashboard</a></li><li class="nav-item"><a class="nav-link" href="<?=base_url("nasabah")?>">Nasabah</a></li>
            <li class="nav-item"><a class="nav-link" href="<?=base_url("jenis-sampah")?>">Jenis Sampah</a></li>
            <li class="nav-item"><a class="nav-link" href="<?=base_url("harga-sampah")?>">Harga Sampah</a></li>
            <li class="nav-item"><a class="nav-link" href="<?=base_url("penyetoran")?>">Penyetoran</a></li>
            <li class="nav-item"><a class="nav-link" href="<?=base_url("penjualan")?>">Penjualan</a></li>
            <li class="nav-item"><a class="nav-link" href="<?=base_url("user")?>">Users</a></li>
            <li class="nav-item"><a class="nav-link active" href="<?=base_url("detail-penyetoran")?>">Detail Penyetoran</a></li>
          </ul>
        </div>
      </div>
      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="col-md-7 col-lg-8">
          <h4 class="mb-3">Edit Detail Penyetoran</h4>
          <form method="POST" action="<?= current_url() ?>">
            <div class="row g-3">
              <div class="col-sm-12"><label class="form-label">Penyetoran</label>
                <select class="form-control" name="penyetoran_id" required>
                  <?php foreach($penyetoran as $p): ?><option value="<?=$p->id?>" <?=$detail->penyetoran_id==$p->id?'selected':''?>><?=$p->kode_transaksi?></option><?php endforeach; ?>
                </select>
              </div>
              <div class="col-sm-12"><label class="form-label">Jenis Sampah</label>
                <select class="form-control" name="jenis_sampah_id" required>
                  <?php foreach($jenis_sampah as $j): ?><option value="<?=$j->id?>" <?=$detail->jenis_sampah_id==$j->id?'selected':''?>><?=$j->nama_jenis?></option><?php endforeach; ?>
                </select>
              </div>
              <div class="col-sm-4"><label class="form-label">Berat (kg)</label><input type="number" step="0.01" class="form-control" name="berat" value="<?=$detail->berat?>" required/></div>
              <div class="col-sm-4"><label class="form-label">Harga/Kg</label><input type="number" step="0.01" class="form-control" name="harga_per_kg" value="<?=$detail->harga_per_kg?>" required/></div>
              <div class="col-sm-4"><label class="form-label">Subtotal</label><input type="number" step="0.01" class="form-control" name="subtotal" value="<?=$detail->subtotal?>" required/></div>
              <hr class="my-4" /><button class="w-100 btn btn-primary btn-lg" type="submit">Simpan</button>
            </div>
          </form>
        </div>
      </main>
    </div></div>
    <script src="<?=base_url()?>public/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
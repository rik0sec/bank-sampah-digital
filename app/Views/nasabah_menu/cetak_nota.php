<?= view('templates/header', ['title' => 'Cetak Nota Setoran']) ?>
<?= view('templates/sidebar') ?>

        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Cetak Nota Setoran</h1>
            <div class="btn-group">
                <a href="<?= base_url('nasabah-menu/dashboard/'.$nasabah->id) ?>" class="btn btn-secondary btn-sm">
                    <i class="bi bi-speedometer2"></i> Dashboard
                </a>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <div class="card p-3">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="rounded-circle bg-success text-white d-flex align-items-center justify-content-center" style="width:50px;height:50px;font-size:1.3rem;">
                                <?= strtoupper(substr($nasabah->nama, 0, 1)) ?>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h5 class="mb-0"><?= esc($nasabah->nama) ?></h5>
                            <small class="text-muted"><?= esc($nasabah->kode_nasabah) ?></small>
                            <br><small class="text-success fw-semibold">Saldo: Rp <?= number_format($nasabah->saldo ?? 0, 0, ',', '.') ?></small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Daftar Transaksi Setoran</h5>
                    </div>
                    <div class="card-body">
                        <?php if(empty($penyetoran)){ ?>
                            <p class="text-muted mb-0">Belum ada transaksi setoran.</p>
                        <?php } else { ?>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Kode Transaksi</th>
                                        <th>Tanggal</th>
                                        <th>Total Berat (kg)</th>
                                        <th>Total Harga</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; foreach($penyetoran as $p){ ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= esc($p->kode_transaksi) ?></td>
                                        <td><?= date('d-m-Y', strtotime($p->tanggal)) ?></td>
                                        <td><?= number_format($p->total_berat ?? 0, 2, ',', '.') ?></td>
                                        <td>Rp <?= number_format($p->total_harga ?? 0, 0, ',', '.') ?></td>
                                        <td>
                                            <span class="badge bg-<?= $p->status == 'Lunas' ? 'success' : 'warning' ?>">
                                                <?= esc($p->status) ?>
                                            </span>
                                        </td>
                                        <td>
                                            <a href="<?= base_url('nasabah-menu/nota-detail/'.$nasabah->id.'/'.$p->id) ?>" class="btn btn-primary btn-sm" target="_blank">
                                                <i class="bi bi-printer"></i> Cetak
                                            </a>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= view('templates/footer') ?>

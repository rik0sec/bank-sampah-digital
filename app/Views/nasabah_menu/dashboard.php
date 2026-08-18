<?= view('templates/header', ['title' => 'Dashboard Nasabah']) ?>
<?= view('templates/sidebar') ?>

        <div class="dash-greeting-bar">
            <div class="greet-text">
                Selamat datang, <span class="greet-name"><?= esc($nasabah->nama) ?></span> 👋
            </div>
            <div class="date-pill">
                <i class="bi bi-calendar3 me-1"></i><?= date('d F Y') ?>
            </div>
        </div>

        <h1 class="h2 mb-3">Dashboard Nasabah</h1>

        <div class="row mb-3 g-3">
            <div class="col-md-6">
                <div class="card p-3 h-100">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="rounded-circle bg-success text-white d-flex align-items-center justify-content-center" style="width:60px;height:60px;font-size:1.5rem;">
                                <?= strtoupper(substr($nasabah->nama, 0, 1)) ?>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h5 class="mb-0"><?= esc($nasabah->nama) ?></h5>
                            <small class="text-muted"><?= esc($nasabah->kode_nasabah) ?></small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card stat-card stat-grad-green h-100">
                    <div class="card-body">
                        <div class="stat-label">Saldo</div>
                        <div class="stat-value">Rp <?= number_format($nasabah->saldo ?? 0, 0, ',', '.') ?></div>
                        <div class="stat-sub">Saldo tersedia saat ini</div>
                        <i class="bi bi-wallet2 icon-corner"></i>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card stat-card stat-grad-teal h-100">
                    <div class="card-body">
                        <div class="stat-label">Total Setoran</div>
                        <div class="stat-value"><?= $summary->jumlah_transaksi ?? 0 ?></div>
                        <div class="stat-sub">Jumlah transaksi setoran</div>
                        <i class="bi bi-box-arrow-in-down icon-corner"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-1">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="chart-card-title">Riwayat Setoran Terakhir</div>
                        <div class="chart-card-sub mb-3">Transaksi setoran sampah yang telah kamu ajukan</div>

                        <?php if(empty($riwayat)){ ?>
                            <p class="text-muted mb-0">Belum ada riwayat setoran.</p>
                        <?php } else { ?>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Kode Transaksi</th>
                                        <th>Tanggal</th>
                                        <th>Total Berat (kg)</th>
                                        <th>Total Harga</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($riwayat as $r){ ?>
                                    <tr>
                                        <td><?= esc($r->kode_transaksi) ?></td>
                                        <td><?= date('d-m-Y', strtotime($r->tanggal)) ?></td>
                                        <td><?= number_format($r->total_berat ?? 0, 2, ',', '.') ?></td>
                                        <td>Rp <?= number_format($r->total_harga ?? 0, 0, ',', '.') ?></td>
                                        <td>
                                            <?php
                                        $warna = 'secondary';

                                        if ($r->status == 'pending') {
                                        $warna = 'warning';
                                      } elseif ($r->status == 'disetujui') {
                                        $warna = 'success';
                                      } elseif ($r->status == 'ditolak') {
                                        $warna = 'danger';
                                    }
                                        ?>

                                    <span class="badge bg-<?= $warna ?>">
                                     <?= ucfirst($r->status) ?>
                                    </span>
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
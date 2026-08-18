<?= view('templates/header') ?>
<?= view('templates/sidebar') ?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom no-print">
    <div>
        <h1 class="h2 mb-1">Laporan</h1>
        <p class="text-muted mb-0">Ringkasan aktivitas penyetoran Bank Sampah.</p>
    </div>
    <button onclick="window.print()" class="btn btn-success">
        <i class="bi bi-printer"></i> Cetak Laporan
    </button>
</div>

<!-- Filter -->
<div class="card shadow-sm mb-4 no-print">
    <div class="card-body">
        <form method="get" class="row g-2 align-items-end">
            <div class="col-md-3">
                <label class="form-label fw-semibold small">Dari Tanggal</label>
                <input type="date" name="dari" class="form-control" value="<?= esc($dari) ?>">
            </div>
            <div class="col-md-3">
                <label class="form-label fw-semibold small">Sampai Tanggal</label>
                <input type="date" name="sampai" class="form-control" value="<?= esc($sampai) ?>">
            </div>
            <div class="col-md-3">
                <label class="form-label fw-semibold small">Petugas</label>
                <select name="petugas_id" class="form-select">
                    <option value="">Semua Petugas</option>
                    <?php foreach($daftar_petugas as $p): ?>
                    <option value="<?= $p->id ?>" <?= $petugas_id==$p->id?'selected':'' ?>><?= esc($p->nama_lengkap) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-3 d-flex gap-2">
                <button type="submit" class="btn btn-success"><i class="bi bi-funnel"></i> Filter</button>
                <a href="<?= base_url('laporan') ?>" class="btn btn-outline-secondary">Reset</a>
            </div>
        </form>
        <div class="d-flex gap-2 mt-3 pt-3 border-top">
    <?php $q = '?' . http_build_query(['dari' => $dari, 'sampai' => $sampai, 'petugas_id' => $petugas_id]); ?>
    <a href="<?= base_url('laporan/export-pdf') . $q ?>" target="_blank" class="btn btn-outline-danger">
        <i class="bi bi-file-earmark-pdf"></i> Export PDF
    </a>
    <a href="<?= base_url('laporan/export-excel') . $q ?>" class="btn btn-outline-success">
        <i class="bi bi-file-earmark-excel"></i> Export Excel
    </a>
</div>
    </div>
</div>

<div id="print-area">

    <!-- Kop Surat (khusus cetak) -->
    <div class="kop-surat text-center mb-3">
        <div class="d-flex align-items-center justify-content-center gap-3">
            <i class="bi bi-recycle fs-1 text-success"></i>
            <div>
                <h2 class="fw-bold mb-0 text-uppercase">Bank Sampah Digital</h2>
                <p class="mb-0 text-muted">Sistem Informasi Manajemen Bank Sampah</p>
            </div>
        </div>
        <hr class="border-2 border-success mt-2 mb-1">
        <hr class="border-1 mt-0">
        <h5 class="fw-bold mt-2 mb-0">LAPORAN AKTIVITAS PENYETORAN</h5>
        <p class="mb-0">
            Periode: <strong><?= $dari ? date('d M Y', strtotime($dari)) : 'Semua' ?> s/d <?= $sampai ? date('d M Y', strtotime($sampai)) : 'Semua' ?></strong>
        </p>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-md-2 col-6">
            <div class="card stat-card stat-grad-teal">
                <div class="card-body">
                    <i class="bi bi-people-fill icon-corner"></i>
                    <div class="stat-label">Total Nasabah</div>
                    <div class="stat-value"><?= $total_nasabah ?></div>
                </div>
            </div>
        </div>
        <div class="col-md-2 col-6">
            <div class="card stat-card stat-grad-emerald">
                <div class="card-body">
                    <i class="bi bi-recycle icon-corner"></i>
                    <div class="stat-label">Jenis Sampah</div>
                    <div class="stat-value"><?= $total_jenis ?></div>
                </div>
            </div>
        </div>
        <div class="col-md-2 col-6">
            <div class="card stat-card stat-grad-green">
                <div class="card-body">
                    <i class="bi bi-check-circle-fill icon-corner"></i>
                    <div class="stat-label">Penyetoran</div>
                    <div class="stat-value"><?= $total_penyetoran ?></div>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-6">
            <div class="card stat-card stat-grad-lime">
                <div class="card-body">
                    <i class="bi bi-speedometer icon-corner"></i>
                    <div class="stat-label">Total Berat</div>
                    <div class="stat-value"><?= number_format($total_berat,2,',','.') ?> Kg</div>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-6">
            <div class="card stat-card stat-grad-forest">
                <div class="card-body">
                    <i class="bi bi-cash-coin icon-corner"></i>
                    <div class="stat-label">Total Nilai</div>
                    <div class="stat-value">Rp <?= number_format($total_uang,0,",",".") ?></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Rekap Per Petugas -->
    <?php if(!empty($rekap_petugas)): ?>
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">
            <div class="chart-card-title mb-3">Rekap Per Petugas</div>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Petugas</th>
                            <th class="text-center">Jumlah Transaksi</th>
                            <th class="text-center">Total Berat</th>
                            <th class="text-end">Total Nilai</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($rekap_petugas as $rp): ?>
                        <tr>
                            <td><strong><?= esc($rp->nama_petugas ?? 'Tanpa Petugas') ?></strong></td>
                            <td class="text-center"><?= $rp->jumlah_transaksi ?></td>
                            <td class="text-center"><?= number_format($rp->total_berat,2,',','.') ?> Kg</td>
                            <td class="text-end harga-value">Rp <?= number_format($rp->total_nilai,0,',','.') ?></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <!-- Riwayat Detail -->
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <div class="chart-card-title mb-3">Riwayat Penyetoran</div>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Kode</th>
                            <th>Tanggal</th>
                            <th>Nasabah</th>
                            <th>Petugas</th>
                            <th>Berat</th>
                            <th>Total</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($laporan as $r): ?>
                        <tr>
                            <td><span class="kode-jenis-pill"><?= esc($r->kode_transaksi) ?></span></td>
                            <td><?= date('d-m-Y',strtotime($r->tanggal)) ?></td>
                            <td><strong><?= esc($r->nama) ?></strong></td>
                            <td><?= !empty($r->nama_petugas) ? esc($r->nama_petugas) : '<span class="text-muted">-</span>' ?></td>
                            <td><?= $r->total_berat ?> Kg</td>
                            <td class="harga-value">Rp <?= number_format($r->total_harga,0,",",".") ?></td>
                            <td>
                                <?php if($r->status=="disetujui"): ?>
                                    <span class="badge status-aktif">Disetujui</span>
                                <?php elseif($r->status=="ditolak"): ?>
                                    <span class="badge status-berakhir">Ditolak</span>
                                <?php else: ?>
                                    <span class="badge bg-warning text-dark"><?= ucfirst($r->status) ?></span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="text-center mt-4 print-only" style="font-size:10px;color:#888;">
        Dicetak pada: <?= date('d F Y, H:i') ?> WIB &nbsp;|&nbsp; Sistem Bank Sampah Digital
    </div>

</div><!-- end print-area -->

<style>
@media print {
    .no-print { display: none !important; }
    .print-only { display: block !important; }
    .sidebar, nav, header, .navbar { display: none !important; }
    body { background: white !important; font-size: 12px; }
    #print-area { padding: 10px 20px; }
    .card { border: 1px solid #ccc !important; box-shadow: none !important; break-inside: avoid; }
    thead { -webkit-print-color-adjust: exact; print-color-adjust: exact; }
    .badge { -webkit-print-color-adjust: exact; print-color-adjust: exact; border: 1px solid #ccc; }
    .stat-card { color: #000 !important; background: #fff !important; border: 1px solid #ccc !important; }
    .kop-surat { margin-bottom: 15px !important; }
}
.print-only { display: none; }
.kop-surat { display: none; }
@media print { .kop-surat { display: block !important; } }
</style>

<?= view('templates/footer') ?>
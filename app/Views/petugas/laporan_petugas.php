<?= view('templates/header') ?>
<?= view('templates/sidebar') ?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom no-print">
    <h1 class="h2">Laporan Harian Petugas</h1>
    <button onclick="window.print()" class="btn btn-success">
        <i class="bi bi-printer"></i> Cetak Laporan
    </button>
</div>

<!-- Filter Tanggal -->
<div class="card mb-4 no-print shadow-sm">
    <div class="card-body">
        <form method="get" class="row g-2 align-items-end">
            <div class="col-md-4">
                <label class="form-label fw-semibold">Pilih Tanggal</label>
                <input type="date" name="tanggal" class="form-control"
                       value="<?= esc($tanggal) ?>" max="<?= date('Y-m-d') ?>">
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-search"></i> Tampilkan
                </button>
            </div>
            <div class="col-auto">
                <a href="?tanggal=<?= date('Y-m-d') ?>" class="btn btn-outline-secondary">Hari Ini</a>
            </div>
        </form>
    </div>
</div>

<!-- ===== AREA CETAK ===== -->
<div id="print-area">

    <!-- Kop Surat -->
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
        <h5 class="fw-bold mt-2 mb-0">LAPORAN HARIAN PETUGAS</h5>
        <p class="mb-0">Tanggal: <strong><?= date('d F Y', strtotime($tanggal)) ?></strong>
            &nbsp;|&nbsp; No. Laporan: <strong>LHP/<?= date('Ymd', strtotime($tanggal)) ?>/<?= str_pad(session('id'), 3, '0', STR_PAD_LEFT) ?></strong>
        </p>
    </div>

    <!-- Summary — tampilan web (cards) -->
    <div class="row g-3 mb-4 no-print">
        <div class="col-6 col-md-3">
            <div class="card text-center border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="fs-1 fw-bold text-primary"><?= $summary->total_pengajuan ?></div>
                    <div class="text-muted small">Total Pengajuan</div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card text-center border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="fs-1 fw-bold text-success"><?= $summary->total_disetujui ?></div>
                    <div class="text-muted small">Disetujui</div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card text-center border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="fs-1 fw-bold text-danger"><?= $summary->total_ditolak ?></div>
                    <div class="text-muted small">Ditolak</div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card text-center border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="fs-1 fw-bold text-success">
                        Rp <?= number_format($summary->total_pendapatan, 0, ',', '.') ?>
                    </div>
                    <div class="text-muted small">Total Pendapatan</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Summary — tampilan cetak (tabel ringkas) -->
    <div class="print-only mb-3">
        <table class="table table-bordered table-sm" style="font-size:12px;">
            <thead style="background:#198754;color:white;">
                <tr>
                    <th class="text-center">Total Pengajuan</th>
                    <th class="text-center">Disetujui</th>
                    <th class="text-center">Ditolak</th>
                    <th class="text-center">Pending</th>
                    <th class="text-center">Total Berat Diterima</th>
                    <th class="text-center">Total Pendapatan</th>
                </tr>
            </thead>
            <tbody>
                <tr class="text-center fw-bold">
                    <td><?= $summary->total_pengajuan ?></td>
                    <td class="text-success"><?= $summary->total_disetujui ?></td>
                    <td class="text-danger"><?= $summary->total_ditolak ?></td>
                    <td class="text-warning"><?= $summary->total_pending ?></td>
                    <td><?= number_format($summary->total_berat, 2, ',', '.') ?> kg</td>
                    <td>Rp <?= number_format($summary->total_pendapatan, 0, ',', '.') ?></td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Rekap Per Jenis Sampah -->
    <?php if(!empty($rekap_jenis)): ?>
    <div class="card mb-4 shadow-sm">
        <div class="card-header fw-bold bg-success text-white">
            Rekap Per Jenis Sampah (Disetujui)
        </div>
        <div class="card-body p-0">
            <table class="table table-bordered mb-0">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Jenis Sampah</th>
                        <th class="text-center">Jumlah Transaksi</th>
                        <th class="text-center">Total Berat (kg)</th>
                        <th class="text-end">Total Nilai</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $nr = 1; foreach($rekap_jenis as $r): ?>
                    <tr>
                        <td><?= $nr++ ?></td>
                        <td><?= esc($r->nama_jenis) ?></td>
                        <td class="text-center"><?= $r->jumlah ?></td>
                        <td class="text-center"><?= number_format($r->total_berat, 2, ',', '.') ?></td>
                        <td class="text-end">Rp <?= number_format($r->total_nilai, 0, ',', '.') ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php endif; ?>

    <!-- Detail Transaksi -->
    <div class="card shadow-sm mb-4">
        <div class="card-header fw-bold bg-dark text-white">
            Detail Transaksi — <?= date('d F Y', strtotime($tanggal)) ?>
        </div>
        <div class="card-body p-0">
            <?php if(empty($detail)): ?>
                <p class="text-muted p-3 mb-0">Tidak ada transaksi pada tanggal ini.</p>
            <?php else: ?>
            <table class="table table-bordered table-hover mb-0">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Waktu</th>
                        <th>Nasabah</th>
                        <th>Jenis Sampah</th>
                        <th class="text-center">Berat (kg)</th>
                        <th class="text-end">Subtotal</th>
                        <th class="text-center">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; foreach($detail as $d): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= date('H:i', strtotime($d->created_at)) ?></td>
                        <td>
                            <strong><?= esc($d->nama_nasabah) ?></strong><br>
                            <small class="text-muted"><?= esc($d->kode_nasabah) ?></small>
                        </td>
                        <td><?= esc($d->nama_jenis) ?></td>
                        <td class="text-center"><?= number_format($d->berat, 2, ',', '.') ?></td>
                        <td class="text-end">Rp <?= number_format($d->subtotal, 0, ',', '.') ?></td>
                        <td class="text-center">
                            <?php if($d->status == 'disetujui'): ?>
                                <span class="badge bg-success">Disetujui</span>
                            <?php elseif($d->status == 'ditolak'): ?>
                                <span class="badge bg-danger">Ditolak</span>
                            <?php else: ?>
                                <span class="badge bg-warning text-dark">Pending</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot style="background:#f8f9fa;font-weight:bold;">
                    <tr>
                        <td colspan="4" class="text-end">Total (Disetujui):</td>
                        <td class="text-center"><?= number_format($summary->total_berat, 2, ',', '.') ?> kg</td>
                        <td class="text-end">Rp <?= number_format($summary->total_pendapatan, 0, ',', '.') ?></td>
                        <td></td>
                    </tr>
                </tfoot>
            </table>
            <?php endif; ?>
        </div>
    </div>

    <!-- Tanda Tangan -->
    <div class="ttd-area mt-5">
        <div class="row text-center">
            <div class="col-6">
                <p class="mb-0">Mengetahui,</p>
                <p class="mb-0">Admin Bank Sampah Digital</p>
                <div style="height:70px;"></div>
                <div style="border-top:1px solid #000;width:60%;margin:0 auto;"></div>
                <p class="mt-1 mb-0 fw-bold"><?= esc($nama_admin) ?></p>
                <p class="mb-0"><small>Administrator</small></p>
            </div>
            <div class="col-6">
                <p class="mb-0">Dibuat oleh,</p>
                <p class="mb-0">Petugas Bank Sampah Digital</p>
                <div style="height:70px;"></div>
                <div style="border-top:1px solid #000;width:60%;margin:0 auto;"></div>
                <p class="mt-1 mb-0 fw-bold"><?= esc($nama_petugas) ?></p>
                <p class="mb-0"><small>Petugas</small></p>
            </div>
        </div>
        <div class="text-center mt-4 print-only" style="font-size:10px;color:#888;">
            Dicetak pada: <?= date('d F Y, H:i') ?> WIB &nbsp;|&nbsp; Sistem Bank Sampah Digital
        </div>
    </div>

</div><!-- end print-area -->

<style>
/* ===== PRINT STYLES ===== */
@media print {
    .no-print { display: none !important; }
    .print-only { display: block !important; }
    .sidebar, nav, header, .navbar { display: none !important; }
    body { background: white !important; font-size: 12px; }
    #print-area { padding: 10px 20px; }
    .card { border: 1px solid #ccc !important; box-shadow: none !important; break-inside: avoid; }
    .card-header { -webkit-print-color-adjust: exact; print-color-adjust: exact; }
    thead { -webkit-print-color-adjust: exact; print-color-adjust: exact; }
    .badge { -webkit-print-color-adjust: exact; print-color-adjust: exact; border: 1px solid #ccc; }
    .ttd-area { margin-top: 40px !important; }
    .kop-surat { margin-bottom: 15px !important; }
}

/* ===== WEB STYLES ===== */
.print-only { display: none; }
.kop-surat { display: none; }
@media print { .kop-surat { display: block !important; } }

.ttd-area {
    border-top: 2px dashed #dee2e6;
    padding-top: 20px;
}
.no-print .ttd-area { display: block; }
</style>

<?= view('templates/footer') ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<style>
    body { font-family: sans-serif; font-size: 11px; }
    h3 { margin-bottom: 2px; }
    .sub { color: #555; margin-bottom: 14px; }
    table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
    th, td { border: 1px solid #999; padding: 5px 8px; text-align: left; }
    th { background: #22c55e; color: #fff; }
    tfoot td { font-weight: bold; background: #f1f5f9; }
    h4 { margin-bottom: 6px; }
</style>
</head>
<body>
    <h3>Laporan Aktivitas Penyetoran - Bank Sampah Digital</h3>
    <div class="sub">
        Periode: <?= $dari ? date('d-m-Y', strtotime($dari)) : 'Semua' ?>
        s/d <?= $sampai ? date('d-m-Y', strtotime($sampai)) : 'Semua' ?>
        &nbsp;|&nbsp; Dicetak: <?= date('d-m-Y H:i') ?>
    </div>

    <?php if (!empty($rekap_petugas)): ?>
    <h4>Rekap Per Petugas</h4>
    <table>
        <thead>
            <tr>
                <th>Petugas</th>
                <th>Jumlah Transaksi</th>
                <th>Total Berat</th>
                <th>Total Nilai</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($rekap_petugas as $rp): ?>
            <tr>
                <td><?= esc($rp->nama_petugas ?? 'Tanpa Petugas') ?></td>
                <td><?= $rp->jumlah_transaksi ?></td>
                <td><?= number_format($rp->total_berat, 2) ?> kg</td>
                <td>Rp <?= number_format($rp->total_nilai, 0, ',', '.') ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php endif; ?>

    <h4>Riwayat Penyetoran</h4>
    <table>
        <thead>
            <tr>
                <th>Kode</th>
                <th>Nasabah</th>
                <th>Petugas</th>
                <th>Tanggal</th>
                <th>Total Berat</th>
                <th>Total Harga</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($laporan as $r): ?>
            <tr>
                <td><?= esc($r->kode_transaksi) ?></td>
                <td><?= esc($r->nama) ?></td>
                <td><?= esc($r->nama_petugas ?? '-') ?></td>
                <td><?= esc($r->tanggal) ?></td>
                <td><?= esc($r->total_berat) ?> kg</td>
                <td>Rp <?= number_format($r->total_harga, 0, ',', '.') ?></td>
                <td><?= esc($r->status) ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="4">TOTAL</td>
                <td><?= number_format($total_berat, 2) ?> kg</td>
                <td>Rp <?= number_format($total_uang, 0, ',', '.') ?></td>
                <td></td>
            </tr>
        </tfoot>
    </table>
</body>
</html>
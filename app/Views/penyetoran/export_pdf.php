<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: sans-serif; font-size: 11px; }
        h3 { margin-bottom: 2px; }
        .sub { color: #555; margin-bottom: 14px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #999; padding: 5px 8px; text-align: left; }
        th { background: #22c55e; color: #fff; }
        tfoot td { font-weight: bold; background: #f1f5f9; }
    </style>
</head>
<body>
    <h3>Laporan Penyetoran - Bank Sampah Digital</h3>
    <div class="sub">
        Periode:
        <?= $dari ? date('d-m-Y', strtotime($dari)) : 'Semua' ?>
        s/d
        <?= $sampai ? date('d-m-Y', strtotime($sampai)) : 'Semua' ?>
        &nbsp;|&nbsp; Dicetak: <?= date('d-m-Y H:i') ?>
    </div>

    <table>
        <thead>
            <tr>
                <th>kodo</th>
                <th>Nasabah</th>
                <th>Tanggal</th>
                <th>Total Berat</th>
                <th>Total Harga</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($penyetoran as $p): ?>
            <tr>
                <td><?= esc($p->kode_transaksi) ?></td>
                <td><?= esc($p->nama_nasabah) ?></td>
                <td><?= esc($p->tanggal) ?></td>
                <td><?= esc($p->total_berat) ?> kg</td>
                <td>Rp <?= number_format($p->total_harga, 0, ',', '.') ?></td>
                <td><?= esc($p->status) ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3">TOTAL</td>
                <td><?= number_format($total_berat, 2) ?> kg</td>
                <td>Rp <?= number_format($total_harga, 0, ',', '.') ?></td>
                <td></td>
            </tr>
        </tfoot>
    </table>
</body>
</html> 
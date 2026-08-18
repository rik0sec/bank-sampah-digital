<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nota Setoran - <?= esc($penyetoran->kode_transaksi) ?> | Bank Sampah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=JetBrains+Mono:wght@500&display=swap" rel="stylesheet">
    <style>
        :root{
            --primary: #0f9d58;
            --primary-dark: #0b7a44;
            --primary-light: #e6f7ee;
            --ink: #1a2b3c;
            --muted: #6b7a8d;
            --border: #e3e8ee;
        }

        *{ box-sizing: border-box; }

        body{
            background: #eef1f5;
            font-family: 'Plus Jakarta Sans', 'Segoe UI', sans-serif;
            color: var(--ink);
        }

        .page-wrap{
            max-width: 900px;
            margin: 0 auto;
            padding: 30px 15px 60px;
        }

        .toolbar{
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 22px;
        }

        .btn-soft{
            background: #fff;
            border: 1px solid var(--border);
            color: var(--ink);
            font-weight: 600;
            border-radius: 10px;
            padding: 9px 18px;
        }
        .btn-soft:hover{ background:#f5f7fa; color: var(--ink); }

        .btn-print{
            background: var(--primary);
            border: none;
            color: #fff;
            font-weight: 600;
            border-radius: 10px;
            padding: 9px 20px;
            box-shadow: 0 6px 16px rgba(15,157,88,.28);
        }
        .btn-print:hover{ background: var(--primary-dark); color:#fff; }

        /* ===== NOTA CARD ===== */
        .nota-card{
            background: #fff;
            border-radius: 18px;
            overflow: hidden;
            box-shadow: 0 10px 40px rgba(20,30,45,.08);
            border: 1px solid var(--border);
        }

        .nota-header{
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: #fff;
            padding: 34px 40px 28px;
            position: relative;
        }

        .brand{
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .brand-icon{
            width: 52px;
            height: 52px;
            border-radius: 14px;
            background: rgba(255,255,255,.18);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.6rem;
            flex-shrink: 0;
        }

        .brand h1{
            font-size: 1.35rem;
            font-weight: 800;
            letter-spacing: .3px;
            margin: 0;
            line-height: 1.2;
        }
        .brand p{
            margin: 2px 0 0;
            font-size: .82rem;
            opacity: .9;
            font-weight: 500;
        }

        .doc-tag{
            position: absolute;
            top: 34px;
            right: 40px;
            text-align: right;
        }
        .doc-tag .label{
            font-size: .68rem;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            opacity: .8;
            font-weight: 600;
        }
        .doc-tag .value{
            font-family: 'JetBrains Mono', monospace;
            font-size: .95rem;
            font-weight: 600;
            margin-top: 2px;
        }

        /* ===== INFO STRIP ===== */
        .info-strip{
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 24px;
            padding: 26px 40px;
            background: var(--primary-light);
            border-bottom: 1px solid var(--border);
        }

        .info-block .label{
            font-size: .7rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: var(--muted);
            font-weight: 700;
            margin-bottom: 4px;
        }
        .info-block .value{
            font-size: .98rem;
            font-weight: 700;
            color: var(--ink);
        }
        .info-block .sub{
            font-size: .8rem;
            color: var(--muted);
            font-weight: 500;
        }

        /* ===== BODY ===== */
        .nota-body{
            padding: 32px 40px 10px;
        }

        .table-modern{
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 4px;
        }
        .table-modern thead th{
            background: var(--ink);
            color: #fff;
            font-size: .74rem;
            text-transform: uppercase;
            letter-spacing: .6px;
            font-weight: 700;
            padding: 13px 16px;
            text-align: left;
            border: none;
        }
        .table-modern thead th:first-child{ border-radius: 10px 0 0 10px; text-align:center; width:50px; }
        .table-modern thead th:last-child{ border-radius: 0 10px 10px 0; text-align:right; }

        .table-modern tbody td{
            padding: 14px 16px;
            border-bottom: 1px solid var(--border);
            font-size: .92rem;
            font-weight: 500;
        }
        .table-modern tbody td:first-child{ text-align:center; color: var(--muted); }
        .table-modern tbody td:last-child{ text-align:right; font-weight: 700; }
        .table-modern tbody tr:last-child td{ border-bottom: none; }

        /* ===== TOTALS ===== */
        .totals-row{
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            padding: 20px 0 8px;
            border-top: 2px dashed var(--border);
            margin-top: 10px;
        }
        .totals-row .weight .label{
            font-size: .72rem;
            text-transform: uppercase;
            color: var(--muted);
            font-weight: 700;
            letter-spacing: .6px;
        }
        .totals-row .weight .value{
            font-size: 1.05rem;
            font-weight: 700;
        }
        .totals-row .grand{
            text-align: right;
        }
        .totals-row .grand .label{
            font-size: .72rem;
            text-transform: uppercase;
            color: var(--muted);
            font-weight: 700;
            letter-spacing: .6px;
        }
        .totals-row .grand .value{
            font-size: 2rem;
            font-weight: 800;
            color: var(--primary);
            line-height: 1.2;
        }

        /* ===== SIGNATURES ===== */
        .signatures{
            padding: 36px 40px 40px;
            border-top: 1px solid var(--border);
            margin-top: 20px;
        }
        .sig-grid{
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
        }
        .sig-box{
            text-align: center;
        }
        .sig-box .role{
            font-size: .74rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: var(--muted);
            font-weight: 700;
            margin-bottom: 60px;
        }
        .sig-box .line{
            border-top: 1.5px solid var(--ink);
            width: 78%;
            margin: 0 auto 8px;
        }
        .sig-box .name{
            font-weight: 700;
            font-size: .95rem;
        }
        .status-pill{
            display: inline-block;
            margin-top: 10px;
            padding: 5px 16px;
            border-radius: 999px;
            font-size: .76rem;
            font-weight: 700;
            letter-spacing: .3px;
        }
        .status-approved{ background:#e6f7ee; color:#0f9d58; }
        .status-pending{ background:#fff6e5; color:#c98a00; }
        .status-rejected{ background:#fde8e8; color:#d9363e; }

        .footer-note{
            text-align: center;
            font-size: .78rem;
            color: var(--muted);
            padding: 18px 40px 30px;
        }

        /* ===== PRINT ===== */
        @media print{
            body{ background:#fff; }
            .no-print{ display:none !important; }
            .page-wrap{ padding:0; max-width:100%; }
            .nota-card{ box-shadow:none; border:none; border-radius:0; }
        }
    </style>
</head>
<body>
    <div class="page-wrap">

        <div class="toolbar no-print">
            <a href="<?= base_url('nasabah-menu/cetak-nota/'.$nasabah->id) ?>" class="btn-soft">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
            <button onclick="window.print()" class="btn-print">
                <i class="bi bi-printer"></i> Cetak Nota
            </button>
        </div>

        <div class="nota-card">

            <!-- HEADER -->
            <div class="nota-header">
                <div class="brand">
                    <div class="brand-icon"><i class="bi bi-recycle"></i></div>
                    <div>
                        <h1>BANK SAMPAH DIGITAL</h1>
                        <p>Sistem Informasi Manajemen Bank Sampah</p>
                    </div>
                </div>
                <div class="doc-tag">
                    <div class="label">Nota Setoran</div>
                    <div class="value">#<?= esc($penyetoran->kode_transaksi) ?></div>
                </div>
            </div>

            <!-- INFO -->
            <div class="info-strip">
                <div class="info-block">
                    <div class="label">Kode Transaksi</div>
                    <div class="value"><?= esc($penyetoran->kode_transaksi) ?></div>
                    <div class="sub mt-1"><i class="bi bi-calendar3"></i> <?= date('d F Y', strtotime($penyetoran->tanggal)) ?></div>
                </div>
                <div class="info-block text-md-end">
                    <div class="label">Nasabah</div>
                    <div class="value"><?= esc($nasabah->nama) ?></div>
                    <div class="sub mt-1">Kode: <?= esc($nasabah->kode_nasabah) ?></div>
                </div>
            </div>

            <!-- BODY / TABLE -->
            <div class="nota-body">
                <table class="table-modern">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Jenis Sampah</th>
                            <th>Berat (kg)</th>
                            <th>Harga/Kg</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; foreach($detail as $d){ ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= esc($d->nama_jenis) ?></td>
                            <td><?= number_format($d->berat ?? 0, 2, ',', '.') ?></td>
                            <td>Rp <?= number_format($d->harga_per_kg ?? 0, 0, ',', '.') ?></td>
                            <td>Rp <?= number_format($d->subtotal ?? 0, 0, ',', '.') ?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>

                <div class="totals-row">
                    <div class="weight">
                        <div class="label">Total Berat</div>
                        <div class="value"><?= number_format($penyetoran->total_berat ?? 0, 2, ',', '.') ?> kg</div>
                    </div>
                    <div class="grand">
                        <div class="label">Total Pembayaran</div>
                        <div class="value">Rp <?= number_format($penyetoran->total_harga,0,',','.') ?></div>
                    </div>
                </div>
            </div>

            <!-- SIGNATURES -->
            <div class="signatures">
                <div class="sig-grid">
                    <div class="sig-box">
                        <div class="role">Petugas</div>
                        <div class="line"></div>
                        <div class="name"><?= $petugas ? esc($petugas->nama_lengkap) : '-' ?></div>
                    </div>
                    <div class="sig-box">
                        <div class="role">Nasabah</div>
                        <div class="line"></div>
                        <div class="name"><?= esc($nasabah->nama) ?></div>
                        <?php if($penyetoran->status=='disetujui'): ?>
                            <div><span class="status-pill status-approved"><i class="bi bi-check-circle-fill"></i> Disetujui</span></div>
                        <?php elseif($penyetoran->status=='pending'): ?>
                            <div><span class="status-pill status-pending"><i class="bi bi-clock-fill"></i> Pending</span></div>
                        <?php else: ?>
                            <div><span class="status-pill status-rejected"><i class="bi bi-x-circle-fill"></i> Ditolak</span></div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="footer-note">
                Nota ini dicetak secara otomatis oleh sistem Bank Sampah Digital dan sah tanpa tanda tangan basah.
            </div>

        </div>
    </div>
</body>
</html>
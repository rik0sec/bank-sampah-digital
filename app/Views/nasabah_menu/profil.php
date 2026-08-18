<?= view('templates/header', ['title' => 'Profil Nasabah']) ?>
<?= view('templates/sidebar') ?>

<style>
    .profil-hero{
        background: #fff;
        border-radius: 16px;
        border: 1px solid #e9edf1;
        padding: 36px 30px;
        text-align: center;
        height: 100%;
    }
    .profil-hero h4{
        color: #1e293b;
        font-weight: 700;
    }
    .profil-avatar-wrap{
        position: relative;
        width: 130px;
        height: 130px;
        margin: 0 auto 18px;
    }
    .profil-avatar-ring{
        position: absolute;
        inset: 0;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(25,135,84,.12) 0%, rgba(25,135,84,0) 70%);
    }
    .profil-avatar{
        position: absolute;
        top: 15px; left: 15px; right: 15px; bottom: 15px;
        border-radius: 50%;
        background: linear-gradient(135deg, #22b06b, #198754);
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2.4rem;
        font-weight: 700;
        box-shadow: 0 8px 20px rgba(25,135,84,.25);
    }
    .badge-nasabah{
        display: inline-flex;
        align-items: center;
        gap: 5px;
        background: #e6f7ee;
        color: #198754;
        font-weight: 600;
        font-size: .78rem;
        padding: 4px 12px;
        border-radius: 999px;
        margin-top: 4px;
    }
    .saldo-box{
        background: #f2fbf6;
        border: 1px solid #d7f0e2;
        border-radius: 12px;
        padding: 14px 18px;
        margin-top: 18px;
    }
    .saldo-box .label{
        font-size: .78rem;
        color: #6b7a8d;
        font-weight: 600;
    }
    .saldo-box .value{
        font-size: 1.6rem;
        font-weight: 700;
        color: #198754;
    }
    .meta-strip{
        display: flex;
        justify-content: space-around;
        margin-top: 22px;
        padding-top: 18px;
        border-top: 1px solid #eef1f4;
    }
    .meta-strip .item{ text-align: center; }
    .meta-strip .item .num{
        font-weight: 700;
        font-size: 1.05rem;
        color: #1e293b;
    }
    .meta-strip .item .lbl{ font-size: .75rem; color: #6b7a8d; }

    .info-card{
        background: #fff;
        border-radius: 16px;
        border: 1px solid #e9edf1;
        padding: 26px 28px;
        height: 100%;
    }
    .info-card h5{ font-weight: 700; margin-bottom: 18px; color: #1e293b; }
    .info-row{
        display: flex;
        align-items: flex-start;
        gap: 14px;
        padding: 13px 0;
        border-bottom: 1px solid #f1f3f6;
    }
    .info-row:last-of-type{ border-bottom: none; }
    .info-row .icon{
        width: 38px;
        height: 38px;
        border-radius: 10px;
        background: #f2fbf6;
        color: #198754;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }
    .info-row .lbl{ font-size: .78rem; color: #6b7a8d; font-weight: 600; }
    .info-row .val{ font-weight: 600; color: #1e293b; }

    /* Diganti dari .stat-card -> .mini-stat-card supaya tidak bentrok
       dengan .stat-card global (dashboard) yang memaksa teks putih */
    .mini-stat-card{
        border-radius: 14px;
        padding: 20px;
        height: 100%;
        border: 1px solid transparent;
    }
    .mini-stat-card .icon-wrap{
        width: 42px; height: 42px;
        border-radius: 10px;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.1rem;
        margin-bottom: 10px;
    }
    .mini-stat-card .num{
        font-size: 1.4rem;
        font-weight: 700;
        color: #1e293b;
    }
    .mini-stat-card .lbl{ font-size: .8rem; color: #4b5568; font-weight: 600; }

    .stat-green{ background:#f2fbf6; border-color:#d7f0e2; }
    .stat-green .icon-wrap{ background:#d7f0e2; color:#198754; }

    .stat-blue{ background:#eef5ff; border-color:#d5e6fb; }
    .stat-blue .icon-wrap{ background:#d5e6fb; color:#2563eb; }

    .stat-orange{ background:#fff8ec; border-color:#fbe8c8; }
    .stat-orange .icon-wrap{ background:#fbe8c8; color:#c98a00; }

    .stat-purple{ background:#f5f0ff; border-color:#e3d6fb; }
    .stat-purple .icon-wrap{ background:#e3d6fb; color:#7c3aed; }

    /* ===== DARK MODE - PROFIL NASABAH ===== */
    body.dark-mode .profil-hero{
        background: #1e293b;
        border-color: rgba(255,255,255,.08);
    }
    body.dark-mode .profil-hero h4{
        color: #f1f5f9;
    }
    body.dark-mode .profil-hero .text-muted{
        color: #94a3b8 !important;
    }
    body.dark-mode .profil-avatar-ring{
        background: radial-gradient(circle, rgba(34,197,94,.18) 0%, rgba(34,197,94,0) 70%);
    }
    body.dark-mode .badge-nasabah{
        background: rgba(34,197,94,.15);
        color: #4ade80;
    }
    body.dark-mode .saldo-box{
        background: rgba(34,197,94,.08);
        border-color: rgba(34,197,94,.25);
    }
    body.dark-mode .saldo-box .label{
        color: #94a3b8;
    }
    body.dark-mode .saldo-box .value{
        color: #4ade80;
    }
    body.dark-mode .meta-strip{
        border-top-color: rgba(255,255,255,.08);
    }
    body.dark-mode .meta-strip .item .num{
        color: #f1f5f9;
    }
    body.dark-mode .meta-strip .item .lbl{
        color: #94a3b8;
    }

    body.dark-mode .info-card{
        background: #1e293b;
        border-color: rgba(255,255,255,.08);
    }
    body.dark-mode .info-card h5{
        color: #f1f5f9;
    }
    body.dark-mode .info-row{
        border-bottom-color: rgba(255,255,255,.06);
    }
    body.dark-mode .info-row .icon{
        background: rgba(34,197,94,.12);
        color: #4ade80;
    }
    body.dark-mode .info-row .lbl{
        color: #94a3b8;
    }
    body.dark-mode .info-row .val{
        color: #f1f5f9;
    }

    body.dark-mode .mini-stat-card .num{
        color: #f1f5f9;
    }
    body.dark-mode .mini-stat-card .lbl{
        color: #cbd5e1;
    }
    body.dark-mode .stat-green{ background: rgba(34,197,94,.08); border-color: rgba(34,197,94,.25); }
    body.dark-mode .stat-green .icon-wrap{ background: rgba(34,197,94,.15); color: #4ade80; }

    body.dark-mode .stat-blue{ background: rgba(37,99,235,.08); border-color: rgba(37,99,235,.25); }
    body.dark-mode .stat-blue .icon-wrap{ background: rgba(37,99,235,.15); color: #60a5fa; }

    body.dark-mode .stat-orange{ background: rgba(201,138,0,.08); border-color: rgba(201,138,0,.25); }
    body.dark-mode .stat-orange .icon-wrap{ background: rgba(201,138,0,.15); color: #fbbf24; }

    body.dark-mode .stat-purple{ background: rgba(124,58,237,.08); border-color: rgba(124,58,237,.25); }
    body.dark-mode .stat-purple .icon-wrap{ background: rgba(124,58,237,.15); color: #a78bfa; }
    /* ===== END DARK MODE PROFIL ===== */
    .modal-body .form-label{
    font-weight:500;
    margin-bottom:8px;
}

.modal-body .form-control{
    border-radius:10px;
    padding:10px 14px;
}

.modal-body textarea.form-control{
    min-height:90px;
    resize:none;
}
.modal-content{
    border-radius:16px;
}

.modal-header{
    padding:20px 24px;
}

.modal-body{
    padding:22px 24px;
}

.modal-footer{
    padding:18px 24px;
}
</style>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <div>
        <h1 class="h2 mb-0">Profil Nasabah</h1>
        <small class="text-muted">Dashboard &gt; Profil Saya</small>
    </div>
    <div class="btn-group">
        <a href="<?= base_url('nasabah-menu/dashboard/'.$nasabah->id) ?>" class="btn btn-success btn-sm">
            <i class="bi bi-speedometer2"></i> Dashboard
        </a>
    </div>
</div>

<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success alert-dismissible fade show shadow-sm rounded-3">
        <i class="bi bi-check-circle-fill me-2"></i>
        <?= session()->getFlashdata('success') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>

<div class="row g-3 mb-3">
    <!-- KARTU PROFIL -->
    <div class="col-md-4">
        <div class="profil-hero">
            <div class="profil-avatar-wrap">
                <div class="profil-avatar-ring"></div>
                <div class="profil-avatar"><?= strtoupper(substr($nasabah->nama, 0, 1)) ?></div>
            </div>
            <h4 class="mb-0"><?= esc($nasabah->nama) ?></h4>
            <p class="text-muted mb-1"><?= esc($nasabah->kode_nasabah) ?></p>
            <span class="badge-nasabah"><i class="bi bi-patch-check-fill"></i> NASABAH</span>

            <div class="saldo-box">
                <div class="label">Saldo Tabungan</div>
                <div class="value">Rp <?= number_format($nasabah->saldo ?? 0, 0, ',', '.') ?></div>
            </div>

            <div class="meta-strip">
                <div class="item">
                    <div class="num"><?= $summary->jumlah_transaksi ?></div>
                    <div class="lbl">Total Setoran</div>
                </div>
                <div class="item">
                    <div class="num"><?= number_format($summary->total_berat, 1, ',', '.') ?> kg</div>
                    <div class="lbl">Total Berat</div>
                </div>
            </div>
        </div>
    </div>

    <!-- INFORMASI PRIBADI -->
    <div class="col-md-8">
        <div class="info-card">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <h5 class="mb-0">Informasi Pribadi</h5>
                <button class="btn btn-outline-success btn-sm"
        data-bs-toggle="modal"
        data-bs-target="#editProfilModal">
    <i class="bi bi-pencil-square"></i> Edit Data Diri
</button>
            </div>

            <div class="info-row">
                <div class="icon"><i class="bi bi-person-badge"></i></div>
                <div>
                    <div class="lbl">Username</div>
                    <div class="val"><?= esc($nasabah->username) ?></div>
                </div>
            </div>
            <div class="info-row">
                <div class="icon"><i class="bi bi-telephone"></i></div>
                <div>
                    <div class="lbl">No. Telepon</div>
                    <div class="val"><?= esc($nasabah->no_telp ?: '-') ?></div>
                </div>
            </div>
            <div class="info-row">
                <div class="icon"><i class="bi bi-envelope"></i></div>
                <div>
                    <div class="lbl">Email</div>
                    <div class="val"><?= esc($nasabah->email ?: '-') ?></div>
                </div>
            </div>
            <div class="info-row">
                <div class="icon"><i class="bi bi-geo-alt"></i></div>
                <div>
                    <div class="lbl">Alamat</div>
                    <div class="val"><?= esc($nasabah->alamat ?: '-') ?></div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- RINGKASAN SETORAN -->
<div class="row g-3 mb-3">
    <div class="col-12">
        <h5 class="fw-bold mb-0">Ringkasan Setoran</h5>
    </div>

    <div class="col-6 col-md-3">
        <div class="mini-stat-card stat-green">
            <div class="icon-wrap"><i class="bi bi-basket2-fill"></i></div>
            <div class="num">Rp <?= number_format($summary->total_setoran, 0, ',', '.') ?></div>
            <div class="lbl">Total Setoran</div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="mini-stat-card stat-blue">
            <div class="icon-wrap"><i class="bi bi-speedometer"></i></div>
            <div class="num"><?= number_format($summary->total_berat, 1, ',', '.') ?> kg</div>
            <div class="lbl">Total Berat Terkumpul</div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="mini-stat-card stat-orange">
            <div class="icon-wrap"><i class="bi bi-bar-chart-fill"></i></div>
            <div class="num">Rp <?= number_format($summary->rata_rata, 0, ',', '.') ?></div>
            <div class="lbl">Rata-rata / Setor</div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="mini-stat-card stat-purple">
            <div class="icon-wrap"><i class="bi bi-graph-up-arrow"></i></div>
            <div class="num"><?= $summary->jumlah_transaksi ?> Kali</div>
            <div class="lbl">Frekuensi Transaksi</div>
        </div>
    </div>
</div>

<!-- Modal Edit Profil -->
<div class="modal fade" id="editProfilModal" tabindex="-1">
    <div class="modal-dialog">
        <form action="<?= base_url('nasabah-menu/update/'.$nasabah->id) ?>" method="post">

            <?= csrf_field() ?>

            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Edit Data Diri</h5>

                    <button type="button"
                            class="btn-close"
                            data-bs-dismiss="modal">
                    </button>
                </div>

                <div class="modal-body">

                    <div class="mb-3">
                        <label class="form-label">Nama Lengkap</label>
                        <input
                            type="text"
                            class="form-control"
                            name="nama"
                            value="<?= esc($nasabah->nama) ?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input
                            type="email"
                            class="form-control"
                            name="email"
                            value="<?= esc($nasabah->email) ?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">No. Telepon</label>
                        <input
                            type="text"
                            class="form-control"
                            name="no_telp"
                            value="<?= esc($nasabah->no_telp) ?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Alamat</label>
                        <textarea
                            class="form-control"
                            name="alamat"
                            rows="3"><?= esc($nasabah->alamat) ?></textarea>
                    </div>

                </div>

                <div class="modal-footer">

                    <button
                        type="button"
                        class="btn btn-outline-secondary"
                        data-bs-dismiss="modal">
                        Batal
                    </button>

                    <button
                        type="submit"
                        class="btn btn-success">
                        Simpan Perubahan
                    </button>

                </div>

            </div>

        </form>
    </div>
</div>

<?= view('templates/footer') ?>
<?= view('templates/header', ['title' => 'Profil Petugas']) ?>
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
    .profil-hero h4{ color: #1e293b; font-weight: 700; }
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
        background: radial-gradient(circle, rgba(37,99,235,.12) 0%, rgba(37,99,235,0) 70%);
    }
    .profil-avatar{
        position: absolute;
        top: 15px; left: 15px; right: 15px; bottom: 15px;
        border-radius: 50%;
        background: linear-gradient(135deg, #3b82f6, #2563eb);
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2.4rem;
        font-weight: 700;
        box-shadow: 0 8px 20px rgba(37,99,235,.25);
        overflow: hidden;
    }
    .profil-avatar img{
        width: 100%; height: 100%; object-fit: cover;
    }
    .badge-petugas{
        display: inline-flex;
        align-items: center;
        gap: 5px;
        background: #eef5ff;
        color: #2563eb;
        font-weight: 600;
        font-size: .78rem;
        padding: 4px 12px;
        border-radius: 999px;
        margin-top: 4px;
    }
    .status-box{
        background: #f2fbf6;
        border: 1px solid #d7f0e2;
        border-radius: 12px;
        padding: 14px 18px;
        margin-top: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }
    .status-box.inactive{
        background: #fef2f2;
        border-color: #fbd5d5;
    }
    .status-box .label{
        font-size: .85rem;
        font-weight: 700;
        color: #198754;
    }
    .status-box.inactive .label{ color: #dc2626; }

    .meta-strip{
        display: flex;
        justify-content: space-around;
        margin-top: 22px;
        padding-top: 18px;
        border-top: 1px solid #eef1f4;
    }
    .meta-strip .item{ text-align: center; }
    .meta-strip .item .num{ font-weight: 700; font-size: .95rem; color: #1e293b; }
    .meta-strip .item .lbl{ font-size: .72rem; color: #6b7a8d; }

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
        background: #eef5ff;
        color: #2563eb;
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
    .mini-stat-card .num{ font-size: 1.4rem; font-weight: 700; color: #1e293b; }
    .mini-stat-card .lbl{ font-size: .8rem; color: #4b5568; font-weight: 600; }

    .stat-blue{ background:#eef5ff; border-color:#d5e6fb; }
    .stat-blue .icon-wrap{ background:#d5e6fb; color:#2563eb; }

    .stat-green{ background:#f2fbf6; border-color:#d7f0e2; }
    .stat-green .icon-wrap{ background:#d7f0e2; color:#198754; }

    .stat-orange{ background:#fff8ec; border-color:#fbe8c8; }
    .stat-orange .icon-wrap{ background:#fbe8c8; color:#c98a00; }

    .stat-purple{ background:#f5f0ff; border-color:#e3d6fb; }
    .stat-purple .icon-wrap{ background:#e3d6fb; color:#7c3aed; }

    /* ===== DARK MODE - PROFIL PETUGAS ===== */
    body.dark-mode .profil-hero{ background: #1e293b; border-color: rgba(255,255,255,.08); }
    body.dark-mode .profil-hero h4{ color: #f1f5f9; }
    body.dark-mode .profil-hero .text-muted{ color: #94a3b8 !important; }
    body.dark-mode .profil-avatar-ring{ background: radial-gradient(circle, rgba(59,130,246,.18) 0%, rgba(59,130,246,0) 70%); }
    body.dark-mode .badge-petugas{ background: rgba(59,130,246,.15); color: #60a5fa; }
    body.dark-mode .status-box{ background: rgba(34,197,94,.08); border-color: rgba(34,197,94,.25); }
    body.dark-mode .status-box.inactive{ background: rgba(220,38,38,.08); border-color: rgba(220,38,38,.25); }
    body.dark-mode .status-box .label{ color: #4ade80; }
    body.dark-mode .status-box.inactive .label{ color: #f87171; }
    body.dark-mode .meta-strip{ border-top-color: rgba(255,255,255,.08); }
    body.dark-mode .meta-strip .item .num{ color: #f1f5f9; }
    body.dark-mode .meta-strip .item .lbl{ color: #94a3b8; }

    body.dark-mode .info-card{ background: #1e293b; border-color: rgba(255,255,255,.08); }
    body.dark-mode .info-card h5{ color: #f1f5f9; }
    body.dark-mode .info-row{ border-bottom-color: rgba(255,255,255,.06); }
    body.dark-mode .info-row .icon{ background: rgba(59,130,246,.12); color: #60a5fa; }
    body.dark-mode .info-row .lbl{ color: #94a3b8; }
    body.dark-mode .info-row .val{ color: #f1f5f9; }

    body.dark-mode .mini-stat-card .num{ color: #f1f5f9; }
    body.dark-mode .mini-stat-card .lbl{ color: #cbd5e1; }
    body.dark-mode .stat-blue{ background: rgba(37,99,235,.08); border-color: rgba(37,99,235,.25); }
    body.dark-mode .stat-blue .icon-wrap{ background: rgba(37,99,235,.15); color: #60a5fa; }
    body.dark-mode .stat-green{ background: rgba(34,197,94,.08); border-color: rgba(34,197,94,.25); }
    body.dark-mode .stat-green .icon-wrap{ background: rgba(34,197,94,.15); color: #4ade80; }
    body.dark-mode .stat-orange{ background: rgba(201,138,0,.08); border-color: rgba(201,138,0,.25); }
    body.dark-mode .stat-orange .icon-wrap{ background: rgba(201,138,0,.15); color: #fbbf24; }
    body.dark-mode .stat-purple{ background: rgba(124,58,237,.08); border-color: rgba(124,58,237,.25); }
    body.dark-mode .stat-purple .icon-wrap{ background: rgba(124,58,237,.15); color: #a78bfa; }
    /* ===== END DARK MODE ===== */
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
}
</style>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <div>
        <h1 class="h2 mb-0">Profil Petugas</h1>
        <small class="text-muted">Dashboard &gt; Profil Saya</small>
    </div>
    <div class="btn-group">
        <a href="<?= base_url('dashboard-petugas') ?>" class="btn btn-success btn-sm">
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
                <div class="profil-avatar">
                    <?php if (!empty($user->foto)): ?>
                        <img src="<?= base_url('uploads/foto/'.$user->foto) ?>" alt="Foto Profil">
                    <?php else: ?>
                        <?= strtoupper(substr($user->nama_lengkap, 0, 1)) ?>
                    <?php endif; ?>
                </div>
            </div>
            <h4 class="mb-0"><?= esc($user->nama_lengkap) ?></h4>
            <p class="text-muted mb-1">@<?= esc($user->username) ?></p>
            <span class="badge-petugas"><i class="bi bi-shield-check"></i> PETUGAS</span>

            <div class="status-box <?= $user->is_verified ? '' : 'inactive' ?>">
                <i class="bi <?= $user->is_verified ? 'bi-patch-check-fill' : 'bi-exclamation-circle-fill' ?>"></i>
                <span class="label"><?= $user->is_verified ? 'Akun Terverifikasi' : 'Belum Terverifikasi' ?></span>
            </div>

            <div class="meta-strip">
                <div class="item">
                    <div class="num"><?= $user->last_login ? date('d M Y', strtotime($user->last_login)) : '-' ?></div>
                    <div class="lbl">Login Terakhir</div>
                </div>
                <div class="item">
                    <div class="num"><?= $user->last_login ? date('H:i', strtotime($user->last_login)) : '-' ?></div>
                    <div class="lbl">Jam</div>
                </div>
            </div>
        </div>
    </div>

    <!-- INFORMASI PRIBADI -->
    <div class="col-md-8">
        <div class="info-card">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <h5 class="mb-0">Informasi Pribadi</h5>
                <button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editProfilModal">
                    <i class="bi bi-pencil-square"></i> Edit Data Diri
                </button>
            </div>

            <div class="info-row">
                <div class="icon"><i class="bi bi-person-badge"></i></div>
                <div>
                    <div class="lbl">Username</div>
                    <div class="val"><?= esc($user->username) ?></div>
                </div>
            </div>
            <div class="info-row">
                <div class="icon"><i class="bi bi-telephone"></i></div>
                <div>
                    <div class="lbl">No. Telepon</div>
                    <div class="val"><?= esc($user->no_telp ?: '-') ?></div>
                </div>
            </div>
            <div class="info-row">
                <div class="icon"><i class="bi bi-envelope"></i></div>
                <div>
                    <div class="lbl">Email</div>
                    <div class="val"><?= esc($user->email ?: '-') ?></div>
                </div>
            </div>
            <div class="info-row">
                <div class="icon"><i class="bi bi-geo-alt"></i></div>
                <div>
                    <div class="lbl">Alamat</div>
                    <div class="val"><?= esc($user->alamat ?: '-') ?></div>
                </div>
            </div>
            
            <div class="info-row">
                <div class="icon"><i class="bi bi-laptop"></i></div>
                <div>
                    <div class="lbl">Perangkat Login Terakhir</div>
                    <div class="val"><?= esc($user->last_device ?: '-') ?></div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- RINGKASAN KINERJA -->
<div class="row g-3 mb-3">
    <div class="col-12">
        <h5 class="fw-bold mb-0">Ringkasan Sistem</h5>
        <small class="text-muted">Data operasional Bank Sampah saat ini</small>
    </div>

    <div class="col-6 col-md-3">
        <div class="mini-stat-card stat-blue">
            <div class="icon-wrap"><i class="bi bi-people-fill"></i></div>
            <div class="num"><?= $totalNasabahDilayani ?></div>
            <div class="lbl">Total Nasabah</div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="mini-stat-card stat-green">
            <div class="icon-wrap"><i class="bi bi-check-circle-fill"></i></div>
            <div class="num"><?= $totalSetoranDiproses ?></div>
            <div class="lbl">Setoran Disetujui</div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="mini-stat-card stat-orange">
            <div class="icon-wrap"><i class="bi bi-speedometer"></i></div>
            <div class="num"><?= number_format($totalBeratDiproses, 1, ',', '.') ?> kg</div>
            <div class="lbl">Total Berat Diproses</div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="mini-stat-card stat-purple">
            <div class="icon-wrap"><i class="bi bi-hourglass-split"></i></div>
            <div class="num"><?= $pengajuanPending ?></div>
            <div class="lbl">Pengajuan Pending</div>
        </div>
    </div>
</div>

<!-- MODAL EDIT PROFIL -->
<div class="modal fade" id="editProfilModal" tabindex="-1">
    <div class="modal-dialog">
        <form action="<?= base_url('profil-petugas/update') ?>" method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Data Diri</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
    <label class="form-label">Nama Lengkap</label>
    <input type="text"
           class="form-control"
           name="nama_lengkap"
           value="<?= esc($user->nama_lengkap) ?>">
</div>

<div class="mb-3">
    <label class="form-label">Email</label>
    <input type="email"
           class="form-control"
           name="email"
           value="<?= esc($user->email) ?>">
</div>

<div class="mb-3">
    <label class="form-label">No. Telepon</label>
    <input type="text"
           class="form-control"
           name="no_telp"
           value="<?= esc($user->no_telp) ?>">
</div>

<div class="mb-3">
    <label class="form-label">Alamat</label>
    <textarea
        class="form-control"
        name="alamat"
        rows="3"
        style="resize:none;"><?= esc($user->alamat) ?></textarea>
</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </div>
        </form>
    </div>
</div>

<?= view('templates/footer') ?>
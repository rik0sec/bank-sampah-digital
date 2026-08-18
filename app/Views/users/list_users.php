<?= view('templates/header') ?>
<?= view('templates/sidebar') ?>

<style>
/* ===== Manajemen User — page-specific styles ===== */
.us-avatar {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: .85rem;
    font-weight: 600;
    flex-shrink: 0;
    color: #fff;
}
.us-av-nasabah  { background: #3b82f6; }
.us-av-petugas  { background: #22c55e; }
.us-av-admin    { background: #a855f7; }

.us-role-badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 5px 12px;
    border-radius: 20px;
    font-size: .78rem;
    font-weight: 600;
}
.us-role-nasabah { background: rgba(59,130,246,.12); color: #2563eb; }
.us-role-petugas { background: rgba(34,197,94,.12);  color: #16a34a; }
.us-role-admin   { background: rgba(168,85,247,.12); color: #9333ea; }

body.dark-mode .us-role-nasabah { background: rgba(59,130,246,.18); color: #93c5fd; }
body.dark-mode .us-role-petugas { background: rgba(34,197,94,.18);  color: #86efac; }
body.dark-mode .us-role-admin   { background: rgba(168,85,247,.18); color: #d8b4fe; }

.us-status-dot {
    width: 7px;
    height: 7px;
    border-radius: 50%;
    display: inline-block;
    margin-right: 6px;
}
.us-dot-active   { background: #22c55e; }
.us-dot-inactive { background: #94a3b8; }

.us-stat-card {
    border: none;
    border-radius: 18px;
    box-shadow: 0 4px 20px rgba(0,0,0,.06);
    padding: 18px 20px;
    height: 100%;
}
.us-stat-label { font-size: .8rem; color: #64748b; margin-bottom: 6px; font-weight: 600; text-transform: uppercase; letter-spacing: .04em; }
body.dark-mode .us-stat-label { color: #94a3b8; }
.us-stat-value { font-size: 1.7rem; font-weight: 700; }
.us-stat-icon {
    width: 46px;
    height: 46px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.2rem;
}

.us-search-wrap {
    position: relative;
    max-width: 280px;
}
.us-search-wrap i {
    position: absolute;
    left: 14px;
    top: 50%;
    transform: translateY(-50%);
    color: #94a3b8;
    font-size: .9rem;
}
.us-search-wrap input {
    border-radius: 10px;
    padding-left: 38px;
}

.us-act-btn {
    border-radius: 8px;
    font-size: .8rem;
    font-weight: 600;
    padding: 6px 12px;
}

@media (max-width: 768px) {
    .us-hide-sm { display: none; }
}
</style>

<!-- Flash messages -->
<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success border-0 shadow-sm rounded-3 d-flex align-items-center gap-2">
        <i class="bi bi-check-circle-fill"></i> <?= esc(session()->getFlashdata('success')) ?>
    </div>
<?php endif; ?>
<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger border-0 shadow-sm rounded-3 d-flex align-items-center gap-2">
        <i class="bi bi-exclamation-circle-fill"></i> <?= esc(session()->getFlashdata('error')) ?>
    </div>
<?php endif; ?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h3 class="mb-1">Daftar Users</h3>
    <div class="btn-group me-2">
        <?php
            $pendingCountPage = db_connect()->query("SELECT COUNT(*) as total FROM users WHERE is_verified = 0")->getRow()->total ?? 0;
        ?>
        <a href="<?= base_url('user/pending_registrations') ?>" class="btn btn-outline-danger position-relative me-2">
            <i class="bi bi-person-check"></i> Verifikasi Pendaftar
            <?php if ($pendingCountPage > 0): ?>
            <span class="badge rounded-pill bg-danger position-absolute top-0 start-100 translate-middle">
                <?= $pendingCountPage ?>
            </span>
            <?php endif; ?>
        </a>
        <a href="<?= base_url('user/tambah') ?>" class="btn btn-success">
            <i class="bi bi-plus-circle"></i> Tambah User
        </a>
    </div>
</div>

<?php
    // Hitung statistik per role
    $totalUser   = count($users);
    $totalNasabah = count(array_filter($users, fn($u) => $u->role === 'nasabah'));
    $totalPetugas = count(array_filter($users, fn($u) => $u->role === 'petugas'));
    $totalAdmin   = count(array_filter($users, fn($u) => $u->role === 'admin'));
?>

<!-- Stat cards -->
<div class="row g-3 mb-4">
    <div class="col-6 col-md-3">
        <div class="card us-stat-card">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <div class="us-stat-label">Total User</div>
                    <div class="us-stat-value"><?= $totalUser ?></div>
                </div>
                <div class="us-stat-icon" style="background:rgba(100,116,139,.12); color:#475569;">
                    <i class="bi bi-people-fill"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card us-stat-card">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <div class="us-stat-label">Nasabah</div>
                    <div class="us-stat-value"><?= $totalNasabah ?></div>
                </div>
                <div class="us-stat-icon" style="background:rgba(59,130,246,.12); color:#2563eb;">
                    <i class="bi bi-person-fill"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card us-stat-card">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <div class="us-stat-label">Petugas</div>
                    <div class="us-stat-value"><?= $totalPetugas ?></div>
                </div>
                <div class="us-stat-icon" style="background:rgba(34,197,94,.12); color:#16a34a;">
                    <i class="bi bi-person-badge-fill"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card us-stat-card">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <div class="us-stat-label">Admin</div>
                    <div class="us-stat-value"><?= $totalAdmin ?></div>
                </div>
                <div class="us-stat-icon" style="background:rgba(168,85,247,.12); color:#9333ea;">
                    <i class="bi bi-shield-fill-check"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- User table card -->
<div class="card">
    <div class="card-body p-0">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 p-3 px-4">
            <h6 class="fw-bold mb-0">Daftar Pengguna</h6>
            <div class="us-search-wrap">
                <i class="bi bi-search"></i>
                <input type="text" id="userSearch" class="form-control form-control-sm" placeholder="Cari username atau nama...">
            </div>
        </div>
        <div class="table-responsive">
            <table class="table align-middle mb-0" id="userTable">
                <thead>
                    <tr>
                        <th class="ps-4">User</th>
                        <th>Username</th>
                        <th>Role</th>
                        <th class="us-hide-sm">Status</th>
                        <th class="text-end pe-4">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $u): ?>
                        <?php
                            $namaParts = explode(' ', trim($u->nama_lengkap ?? $u->username));
                            $initials  = strtoupper(substr($namaParts[0], 0, 1) . substr($namaParts[count($namaParts) - 1], 0, 1));
                            if (count($namaParts) === 1) {
                                $initials = strtoupper(substr($namaParts[0], 0, 2));
                            }
                            $roleClass = 'us-role-' . $u->role;
                            $avClass   = 'us-av-' . $u->role;
                            $roleIcon  = $u->role === 'admin' ? 'bi-shield-fill-check' : ($u->role === 'petugas' ? 'bi-person-badge-fill' : 'bi-person-fill');
                            $isActive  = (int)($u->is_verified ?? 1) === 1;
                        ?>
                        <tr>
                            <td class="ps-4">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="us-avatar <?= $avClass ?>"><?= esc($initials) ?></div>
                                    <div>
                                        <div class="fw-semibold"><?= esc($u->nama_lengkap) ?></div>
                                        <div class="text-muted small d-md-none">@<?= esc($u->username) ?></div>
                                    </div>
                                </div>
                            </td>
                            <td class="text-muted"><?= esc($u->username) ?></td>
                            <td>
                                <span class="us-role-badge <?= $roleClass ?>">
                                    <i class="bi <?= $roleIcon ?>"></i> <?= ucfirst($u->role) ?>
                                </span>
                            </td>
                            <td class="us-hide-sm">
                                <span class="us-status-dot <?= $isActive ? 'us-dot-active' : 'us-dot-inactive' ?>"></span>
                                <span class="small <?= $isActive ? 'text-success' : 'text-muted' ?>">
                                    <?= $isActive ? 'Aktif' : 'Belum Verifikasi' ?>
                                </span>
                            </td>
                            <td class="text-end pe-4">
                                <a href="<?= base_url('user/edit/' . $u->id) ?>" class="btn btn-sm btn-outline-primary us-act-btn">
                                    <i class="bi bi-pencil-fill"></i> Edit
                                </a>
                                <?php if ($u->role !== 'admin'): ?>
                                    <a href="<?= base_url('user/delete/' . $u->id) ?>"
                                       class="btn btn-sm btn-outline-danger us-act-btn"
                                       onclick="return confirm('Yakin hapus user ini?')">
                                        <i class="bi bi-trash-fill"></i> Hapus
                                    </a>
                                <?php else: ?>
                                    <button type="button" class="btn btn-sm btn-outline-secondary us-act-btn" disabled>
                                        <i class="bi bi-trash-fill"></i> Hapus
                                    </button>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>

                    <?php if (count($users) === 0): ?>
                        <tr>
                            <td colspan="5" class="text-center text-muted py-5">
                                <i class="bi bi-inbox fs-3 d-block mb-2"></i>
                                Belum ada data pengguna.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-between align-items-center p-3 px-4 border-top">
            <small class="text-muted">Menampilkan <span id="userCount"><?= $totalUser ?></span> dari <?= $totalUser ?> pengguna</small>
        </div>
    </div>
</div>

<script>
// Live search filter — username & nama lengkap
document.getElementById('userSearch').addEventListener('input', function () {
    const q = this.value.toLowerCase();
    const rows = document.querySelectorAll('#userTable tbody tr');
    let visible = 0;
    rows.forEach(row => {
        const text = row.textContent.toLowerCase();
        const match = text.includes(q);
        row.style.display = match ? '' : 'none';
        if (match) visible++;
    });
    document.getElementById('userCount').textContent = visible;
});
</script>

<?= view('templates/footer') ?>
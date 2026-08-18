<?= view('templates/header') ?>
<?= view('templates/sidebar') ?>


    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h3 class="mb-1">Verifikasi Pendaftar</h3>
        <a href="<?= base_url('user') ?>" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Kembali ke Users
        </a>
    </div>

    <?php if (session('error')): ?>
    <div class="alert alert-danger"><?= session('error') ?></div>
    <?php endif; ?>
    <?php if (session('success')): ?>
    <div class="alert alert-success"><?= session('success') ?></div>
    <?php endif; ?>

    <?php $otpInfo = session()->getFlashdata('otp_info'); ?>
    <?php if (!empty($otpInfo)): ?>
    <div class="card border-success mb-3">
        <div class="card-body d-flex flex-wrap align-items-center justify-content-between gap-3">
            <div>
                <small class="text-muted d-block">Kode OTP untuk <?= esc($otpInfo['nama']) ?></small>
                <span class="fs-3 fw-bold text-success" style="letter-spacing:4px;"><?= esc($otpInfo['otp']) ?></span>
                <small class="text-muted d-block mt-1">Berlaku 15 menit. Sampaikan kode ini ke nasabah secara manual.</small>
            </div>
            <?php if (!empty($otpInfo['wa_link'])): ?>
            <a href="<?= esc($otpInfo['wa_link']) ?>" target="_blank" class="btn btn-success">
                <i class="bi bi-whatsapp"></i> Kirim via WhatsApp
            </a>
            <?php else: ?>
            <span class="text-danger small">Nomor telepon nasabah tidak tersedia, sampaikan kode secara manual.</span>
            <?php endif; ?>
        </div>
    </div>
    <?php endif; ?>

    <div class="card">
        <div class="card-body">
            <?php if (empty($pending_users)): ?>
                <p class="text-center text-muted py-4">Tidak ada pendaftar baru yang menunggu verifikasi.</p>
            <?php else: ?>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Lengkap</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>No Telp</th>
                                <th>Role</th>
                                <th>Tanggal Daftar</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; foreach ($pending_users as $u): ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= esc($u->nama_lengkap) ?></td>
                                <td><?= esc($u->username) ?></td>
                                <td><?= esc($u->email) ?></td>
                                <td><?= esc($u->no_telp) ?></td>
                                <td>
                                    <span class="badge bg-<?= $u->role == 'nasabah' ? 'primary' : 'warning' ?>">
                                        <?= ucfirst($u->role) ?>
                                    </span>
                                </td>
                                <td><?= date('d/m/Y H:i', strtotime($u->created_at)) ?></td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <a href="<?= base_url('user/send-otp/'.$u->id) ?>" class="btn btn-success" title="Buat Kode OTP" onclick="return confirm('Buat kode OTP baru untuk <?= esc($u->nama_lengkap) ?>?')">
                                            <i class="bi bi-key"></i> Buat Kode OTP
                                        </a>
                                        <a href="<?= base_url('user/approve-direct/'.$u->id) ?>" class="btn btn-primary" title="Verifikasi Langsung" onclick="return confirm('Verifikasi akun <?= esc($u->username) ?> tanpa OTP?')">
                                            <i class="bi bi-check-lg"></i> Approve
                                        </a>
                                        <a href="<?= base_url('user/reject/'.$u->id) ?>" class="btn btn-danger" title="Tolak" onclick="return confirm('Tolak dan hapus pendaftaran <?= esc($u->username) ?>?')">
                                            <i class="bi bi-x-lg"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </div>
</main>

<?= view('templates/footer') ?>
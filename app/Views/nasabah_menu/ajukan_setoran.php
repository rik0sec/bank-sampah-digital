<?= view('templates/header') ?>
<?= view('templates/sidebar') ?>

<div class="pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2 mb-1">Setor Sampah</h1>
    <p class="text-muted mb-0">Ajukan setoran sampah untuk diproses petugas.</p>
</div>

    <?php if(session()->getFlashdata('success')): ?>
    <div class="alert alert-success alert-dismissible fade show">
        <?= session()->getFlashdata('success') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    <?php endif; ?>

    <!-- Form Ajukan -->
    <div class="card mb-4 shadow-sm">
        <div class="card-body">
            <form method="post">
                <?= csrf_field() ?>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Jenis Sampah</label>
                    <select name="jenis_sampah" class="form-select" required>
                        <option value="">Pilih Jenis Sampah</option>
                        <?php foreach($jenis as $j): ?>
                        <option value="<?= $j->id ?>">
                            <?= esc($j->nama_jenis) ?> - Rp <?= number_format($j->harga_per_kg, 0, ',', '.') ?>/kg
                        </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Berat (kg)</label>
                    <input type="number" step="0.1" min="0.1" name="berat" class="form-control" placeholder="Contoh: 2.5" required>
                </div>
                <button type="submit" class="btn btn-success">
                    <i class="bi bi-send"></i> Ajukan Setoran
                </button>
            </form>
        </div>
    </div>

    <!-- Riwayat Pengajuan -->
    <h5 class="mb-3 fw-bold">Riwayat Pengajuan</h5>

    <?php if(empty($riwayat)): ?>
        <p class="text-muted">Belum ada pengajuan setoran.</p>
    <?php else: ?>
    <div class="row g-3">
        <?php foreach($riwayat as $r): ?>
        <div class="col-md-4 col-sm-6">
            <div class="card h-100 shadow-sm border-0
                <?= $r->status == 'disetujui' ? 'border-start border-success border-4' : 
                   ($r->status == 'ditolak'   ? 'border-start border-danger border-4' : 
                                                'border-start border-warning border-4') ?>">
                <div class="card-body">
                    <p class="text-muted small mb-1">
                        <?= date('d M Y, H:i', strtotime($r->created_at)) ?>
                    </p>
                    <h6 class="fw-bold"><?= esc($r->nama_jenis) ?></h6>
                    <p class="mb-1">Berat: <strong><?= number_format($r->berat, 2, ',', '.') ?> kg</strong></p>
                    <p class="mb-1">Harga/kg: <strong>Rp <?= number_format($r->harga_per_kg, 0, ',', '.') ?></strong></p>
                    <p class="mb-2">Subtotal: <strong class="text-success">Rp <?= number_format($r->subtotal, 0, ',', '.') ?></strong></p>
                    <?php if($r->status == 'disetujui'): ?>
                        <span class="badge bg-success"><i class="bi bi-check-circle"></i> Disetujui</span>
                    <?php elseif($r->status == 'ditolak'): ?>
                        <span class="badge bg-danger"><i class="bi bi-x-circle"></i> Ditolak</span>
                    <?php else: ?>
                        <span class="badge bg-warning text-dark"><i class="bi bi-clock"></i> Pending</span>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>
</div>

<?= view('templates/footer') ?>
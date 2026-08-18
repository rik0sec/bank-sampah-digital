<?= view('templates/header') ?>
<?= view('templates/sidebar') ?>

<?php if(session()->getFlashdata('success')): ?>
<div class="alert alert-success alert-dismissible fade show">
<i class="bi bi-check-circle"></i> <?= session()->getFlashdata('success') ?>
<button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
<?php endif; ?>

<?php if(session()->getFlashdata('error')): ?>
<div class="alert alert-danger alert-dismissible fade show">
<i class="bi bi-x-circle"></i> <?= session()->getFlashdata('error') ?>
<button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
<?php endif; ?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <div>
        <h1 class="h2 mb-1">Harga Sampah</h1>
        <p class="text-muted mb-0">Kelola data harga sampah yang dapat disetorkan.</p>
    </div>

    <?php if (session()->get('role') != 'nasabah') : ?>
    <a href="<?= base_url('harga-sampah/tambah') ?>" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Tambah Harga Sampah
    </a>
    <?php endif; ?>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Jenis Sampah</th>
                        <th>Harga/Kg</th>
                        <th>Periode Berlaku</th>
                        <th>Status</th>
                        <?php if (session()->get('role') != 'nasabah') : ?>
                        <th width="120">Aksi</th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($harga_sampah as $h):
                    $today = date('Y-m-d');
                    $aktif = ($h->berlaku_mulai <= $today && $h->berlaku_sampai >= $today);
                ?>
                    <tr>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <div class="icon-jenis-sampah" style="background:#f0fdf4; color:#16a34a;">
                                    <i class="bi bi-recycle"></i>
                                </div>
                                <strong><?= esc($h->nama_jenis) ?></strong>
                            </div>
                        </td>
                        <td>
                            <span class="harga-value">Rp <?= number_format($h->harga_per_kg, 0, ',', '.') ?></span>
                            <small class="text-muted">/ kg</small>
                        </td>
                        <td>
                            <div class="periode-pill">
                                <i class="bi bi-calendar3"></i>
                                <?= date('d M Y', strtotime($h->berlaku_mulai)) ?>
                                <span class="mx-1">&rarr;</span>
                                <?= date('d M Y', strtotime($h->berlaku_sampai)) ?>
                            </div>
                        </td>
                        <td>
                            <?php if ($aktif): ?>
                                <span class="badge status-aktif"><i class="bi bi-check-circle-fill"></i> Aktif</span>
                            <?php else: ?>
                                <span class="badge status-berakhir"><i class="bi bi-x-circle-fill"></i> Berakhir</span>
                            <?php endif; ?>
                        </td>

                        <?php if (session()->get('role') != 'nasabah') : ?>
                        <td>
                            <a href="<?= base_url('harga-sampah/edit/'.$h->id) ?>" class="btn btn-warning btn-sm">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <a href="<?= base_url('harga-sampah/delete/'.$h->id) ?>"
                               class="btn btn-danger btn-sm"
                               onclick="return confirm('Yakin hapus data?')">
                                <i class="bi bi-trash"></i>
                            </a>
                        </td>
                        <?php endif; ?>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= view('templates/footer') ?>
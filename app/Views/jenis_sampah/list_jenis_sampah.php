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
        <h1 class="h2 mb-1">Jenis Sampah</h1>
        <p class="text-muted mb-0">Kelola data jenis sampah yang dapat disetorkan.</p>
        
    </div>

    <?php if (session()->get('role') != 'nasabah') : ?>
    <a href="<?= base_url('jenis-sampah/tambah') ?>" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Tambah Jenis Sampah
    </a>
    <?php endif; ?>
</div>

<?php
$iconMap = [
    'kertas'     => ['bi-file-earmark-text', '#92400e', '#fef3c7'],
    'plastik'    => ['bi-cup-straw',          '#1d4ed8', '#dbeafe'],
    'logam'      => ['bi-nut',                '#334155', '#e2e8f0'],
    'kaca'       => ['bi-cup',                '#0e7490', '#cffafe'],
    'elektronik' => ['bi-cpu',                '#6d28d9', '#ede9fe'],
];
?>

<div class="card shadow-sm border-0">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th style="width:60px"></th>
                        <th>Kode</th>
                        <th>Nama Jenis</th>
                        <th>Kategori</th>
                        <th>Deskripsi</th>
                        <?php if (session()->get('role') != 'nasabah') : ?>
                        <th width="120">Aksi</th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($jenis_sampah as $j):
                    $kat = strtolower($j->kategori);
                    $iconClass = $iconMap[$kat][0] ?? 'bi-recycle';
                    $iconColor = $iconMap[$kat][1] ?? '#475569';
                    $iconBg    = $iconMap[$kat][2] ?? '#f1f5f9';
                    $badgeClass = 'badge-' . (array_key_exists($kat, $iconMap) ? $kat : 'lainnya');
                ?>
                    <tr>
                        <td>
                            <div class="icon-jenis-sampah" style="background:<?= $iconBg ?>; color:<?= $iconColor ?>;">
                                <i class="bi <?= $iconClass ?>"></i>
                            </div>
                        </td>
                        <td><span class="kode-jenis-pill"><?= esc($j->kode_jenis) ?></span></td>
                        <td><strong><?= esc($j->nama_jenis) ?></strong></td>
                        <td><span class="badge badge-kategori <?= $badgeClass ?>"><?= esc($j->kategori) ?></span></td>
                        <td class="text-muted"><?= esc($j->deskripsi) ?></td>

                        <?php if (session()->get('role') != 'nasabah') : ?>
                        <td>
                            <a href="<?= base_url('jenis-sampah/edit/'.$j->id) ?>" class="btn btn-warning btn-sm">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <a href="<?= base_url('jenis-sampah/delete/'.$j->id) ?>"
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
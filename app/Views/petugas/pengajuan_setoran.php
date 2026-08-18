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

<div class="container-fluid">

    <h2 class="mt-3">
        Pengajuan Setoran Sampah
    </h2>

    <table class="table table-bordered">

        <thead>
            <tr>
                <th>Nasabah</th>
                <th>Jenis Sampah</th>
                <th>Berat</th>
                <th>Subtotal</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>

        <?php foreach($pengajuan as $p): ?>

            <tr>
                <td><?= $p->nama ?></td>
                <td><?= $p->nama_jenis ?></td>
                <td><?= $p->berat ?> Kg</td>
                <td>Rp <?= number_format($p->subtotal) ?></td>
                <td><?= $p->status ?></td>
                <td>

<?php if($p->status == 'pending'): ?>

<a href="<?= base_url('pengajuan-setoran/setujui/'.$p->id) ?>"
   class="btn btn-success btn-sm">
    Setujui
</a>

<a href="<?= base_url('pengajuan-setoran/tolak/'.$p->id) ?>"
   class="btn btn-danger btn-sm">
    Tolak
</a>

<?php else: ?>

<span class="badge bg-secondary">
    <?= ucfirst($p->status) ?>
</span>

<?php endif; ?>

</td>
                
            </tr>

        <?php endforeach; ?>

        </tbody>

    </table>

</div>

<?= view('templates/footer') ?>
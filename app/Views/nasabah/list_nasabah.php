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
        <h3 class="mb-1">Daftar Nasabah</h3>
        <p class="text-muted mb-0">
            Kelola data nasabah Bank Sampah Digital.
        </p>
    </div>

    <a href="<?= base_url('nasabah/tambah') ?>" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i>
        Tambah Nasabah
    </a>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body">

        <div class="mb-3">
            <input type="text" id="searchNasabah" class="form-control" placeholder="Cari nama atau kode nasabah...">
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle" id="tableNasabah">

                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Kode Nasabah</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>No Telp</th>
                        <th>Email</th>
                        <th>Saldo</th>
                        <th width="120">Aksi</th>
                    </tr>
                </thead>

                <tbody>

                <?php $no=1; foreach($nasabah as $n){ ?>

                    <tr>

                        <td><?= $no++ ?></td>

                        <td>
                            <?= !empty($n->kode_nasabah) ? esc($n->kode_nasabah) : '-' ?>
                        </td>

                        <td>
                            <strong><?= esc($n->nama) ?></strong>
                        </td>

                        <td><?= esc($n->alamat) ?></td>

                        <td><?= esc($n->no_telp) ?></td>

                        <td><?= esc($n->email) ?></td>

                        <td>
                            <span class="badge bg-success fs-6">
                                Rp <?= number_format($n->saldo ?? 0,0,',','.') ?>
                            </span>
                        </td>

                        <td>

                            <a href="<?= base_url('nasabah/edit/'.$n->id) ?>" class="btn btn-warning btn-sm">
                                <i class="bi bi-pencil"></i>
                            </a>

                            <a href="<?= base_url('nasabah/delete/'.$n->id) ?>"
                               class="btn btn-danger btn-sm"
                               onclick="return confirm('Yakin ingin menghapus data?')">
                                <i class="bi bi-trash"></i>
                            </a>

                        </td>

                    </tr>

                <?php } ?>

                </tbody>

            </table>
        </div>
    </div>
</div>

<script>
document.getElementById("searchNasabah").addEventListener("keyup", function(){

    let keyword = this.value.toLowerCase();

    let rows = document.querySelectorAll("#tableNasabah tbody tr");

    rows.forEach(function(row){

        let text = row.innerText.toLowerCase();

        row.style.display = text.includes(keyword) ? "" : "none";

    });

});
</script>

<?= view('templates/footer') ?>
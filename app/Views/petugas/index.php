<?= view('templates/header') ?>
<?= view('templates/sidebar') ?>


        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Menu Nasabah</h1>
        </div>

        <div class="row mb-4">
            <div class="col-md-12">
                <div class="card p-4">
                    <h5 class="mb-3">Silakan Pilih Nasabah</h5>
                    <form method="GET" action="<?= base_url('nasabah-menu/select') ?>">
                        <div class="input-group">
                            <select class="form-select" name="id" required>
                                <option value="">-- Pilih Nasabah --</option>
                                <?php foreach($nasabah as $n){ ?>
                                <option value="<?= $n->id ?>">
                                    <?= esc($n->kode_nasabah) ?> - <?= esc($n->nama) ?>
                                </option>
                                <?php } ?>
                            </select>
                            <button class="btn btn-success" type="submit">Masuk</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="row g-3">
            <div class="col-md-3">
                <div class="card stat-card bg-primary h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-white-50">Lihat Saldo</h6>
                                <h3 class="mb-0">Dashboard</h3>
                            </div>
                            <div class="icon"><i class="bi bi-speedometer2"></i></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card stat-card bg-info h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-white-50">Profil</h6>
                                <h3 class="mb-0">Profil Nasabah</h3>
                            </div>
                            <div class="icon"><i class="bi bi-person"></i></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card stat-card bg-warning h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-white-50">Data Diri</h6>
                                <h3 class="mb-0">Update Data</h3>
                            </div>
                            <div class="icon"><i class="bi bi-pencil-square"></i></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card stat-card bg-success h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-white-50">Cetak</h6>
                                <h3 class="mb-0">Nota Setoran</h3>
                            </div>
                            <div class="icon"><i class="bi bi-printer"></i></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= view('templates/footer') ?>

</body>
</html>

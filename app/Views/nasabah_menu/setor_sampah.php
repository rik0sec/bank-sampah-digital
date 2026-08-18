<?= view('templates/header') ?>
<?= view('templates/sidebar') ?>

        <div class="pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2 mb-1">Setor Sampah</h1>
            <p class="text-muted mb-0">Ajukan setoran sampah untuk diproses petugas.</p>
        </div>

    <form action="<?= base_url('setor-sampah/simpan') ?>" method="post">

        <div class="mb-3">
            <label>Jenis Sampah</label>

            <select class="form-control" name="jenis_sampah_id" required>
                   <option value="">-- Pilih Jenis Sampah --</option>

    <?php foreach($jenis as $j){ ?>

        <option value="<?= $j->id ?>">
            <?= $j->nama_jenis ?> - Rp <?= number_format($j->harga_per_kg) ?>/kg
        </option>

    <?php } ?>

</select>
        </div>

        <div class="mb-3">
            <label>Berat (kg)</label>
            <input
    type="number"
    step="0.01"
    min="0.01"
    class="form-control"
    name="berat"
    required>
        </div>

        <button class="btn btn-success">
            Ajukan Setoran
        </button>

    </form>
</div>

<?= view('templates/footer') ?>
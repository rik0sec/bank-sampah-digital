<?= view('templates/header') ?>
<?= view('templates/sidebar') ?>
        <div class="col-md-7 col-lg-8">
          <h4 class="mb-3">Tambah User</h4>
          <form method="POST" action="<?= base_url('user/tambah') ?>">
            <div class="row g-3">
              <div class="col-sm-6"><label class="form-label">Username</label><input type="text" class="form-control" name="username" required/></div>
              <div class="col-sm-6"><label class="form-label">Password</label><input type="password" class="form-control" name="password" required/></div>
              <div class="col-sm-6"><label class="form-label">Nama Lengkap</label><input type="text" class="form-control" name="nama_lengkap" required/></div>
              <div class="col-12">
    <label class="form-label">Alamat</label>
    <textarea
        class="form-control"
        name="alamat"
        rows="3"
        placeholder="Masukkan alamat lengkap"></textarea>
</div>
              <div class="col-sm-6"><label class="form-label">Role</label>
                <select class="form-control" name="role" required>
                  <option value="">-- Pilih --</option>
                  <option value="admin">Admin</option><option value="petugas">Petugas</option><option value="nasabah">Nasabah</option>
                </select>
              </div>
              <hr class="my-4" /><button class="w-100 btn btn-primary btn-lg" type="submit">Simpan</button>
            </div>
          </form>
        </div>
      </main>
    </div></div>
   
  <?= view('templates/footer') ?>
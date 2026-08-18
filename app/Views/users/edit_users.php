<?= view('templates/header') ?>
<?= view('templates/sidebar') ?>


  
    <div class="col-md-7 col-lg-8">
        <h4 class="mb-3">Edit User</h4>
          <form method="POST" action="<?= current_url() ?>">
            <div class="row g-3">
              <div class="col-sm-6"><label class="form-label">Username</label><input type="text" class="form-control" name="username" value="<?=$user->username?>" required/></div>
              <div class="col-sm-6"><label class="form-label">Password (kosongkan jika tidak diganti)</label><input type="password" class="form-control" name="password"/></div>
              <div class="col-sm-6"><label class="form-label">Nama Lengkap</label><input type="text" class="form-control" name="nama_lengkap" value="<?=$user->nama_lengkap?>" required/></div>
              <div class="col-12">
    <label class="form-label">Alamat</label>
    <textarea
        class="form-control"
        name="alamat"
        rows="3"><?=$user->alamat?></textarea>
</div>
              <div class="col-sm-6"><label class="form-label">Role</label>
                <select class="form-control" name="role" required>
                  <option value="admin" <?=$user->role=='admin'?'selected':''?>>Admin</option>
                  <option value="petugas" <?=$user->role=='petugas'?'selected':''?>>Petugas</option>
                  <option value="nasabah" <?=$user->role=='nasabah'?'selected':''?>>Nasabah</option>
                </select>
              </div>
              <hr class="my-4" /><button class="w-100 btn btn-primary btn-lg" type="submit">Simpan</button>
            </div>
          </form>
        </div>
     </main>   
<?= view('templates/footer') ?>
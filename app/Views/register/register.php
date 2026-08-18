<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'Registrasi') ?> | Bank Sampah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <style>
        :root {
            --primary: #2c3e50;
            --accent: #27ae60;
        }
        * { box-sizing: border-box; }
        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #2c3e50 0%, #27ae60 100%);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding: 20px;
        }
        .register-wrapper {
            width: 100%;
            max-width: 600px;
        }
        .register-card {
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            overflow: hidden;
        }
        .register-header {
            background: var(--primary);
            padding: 24px 30px 16px;
            text-align: center;
            color: #fff;
        }
        .register-header h4 {
            font-weight: 700;
        }
        .register-body {
            padding: 30px;
        }
        .form-control:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 0.2rem rgba(39, 174, 96, 0.25);
        }
        .btn-register {
            background: var(--accent);
            border: none;
            color: #fff;
            font-weight: 600;
            padding: 12px;
            border-radius: 8px;
            width: 100%;
            transition: all 0.3s;
        }
        .btn-register:hover {
            background: #219a52;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(39, 174, 96, 0.4);
        }
        .login-link {
            text-align: center;
            margin-top: 16px;
            font-size: 0.9rem;
        }
        .login-link a {
            color: var(--accent);
            text-decoration: none;
            font-weight: 600;
        }
        .login-link a:hover {
            text-decoration: underline;
        }
        .alert {
            border-radius: 8px;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>
    <div class="register-wrapper">
        <div class="register-card">
            <div class="register-header">
                <h4>Registrasi Akun Bank Sampah</h4>
                <p>Silakan isi data diri Anda dengan benar</p>
            </div>
            <div class="register-body">
                <?php if (session('error')): ?>
                <div class="alert alert-danger d-flex align-items-center" role="alert">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                    <div><?= session('error') ?></div>
                </div>
                <?php endif; ?>

                <?php if (session('success')): ?>
                <div class="alert alert-success d-flex align-items-center" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i>
                    <div><?= session('success') ?></div>
                </div>
                <?php endif; ?>

                <?php if (isset($validation)): ?>
                <div class="alert alert-danger">
                    <?= $validation->listErrors() ?>
                </div>
                <?php endif; ?>

                <form action="<?= base_url('register/submit') ?>" method="post">
                    <?= csrf_field() ?>
                    <div class="mb-3">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" name="nama_lengkap" placeholder="Nama lengkap Anda" required autofocus
                               value="<?= old('nama_lengkap') ?>">
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Username</label>
                            <input type="text" class="form-control" name="username" placeholder="Username untuk login" required
                                   value="<?= old('username') ?>">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" class="form-control" name="password" placeholder="Minimal 6 karakter" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" placeholder="contoh@email.com" required
                                   value="<?= old('email') ?>">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">No Telpon</label>
                            <input type="text" class="form-control" name="no_telp" placeholder="Masuka No Telpon Anda" required 
                                   value="<?= old('no_telp') ?>">
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Daftar Sebagai</label>
                        <select class="form-select" name="role" required>
                            <option value="nasabah" selected>-- Nasabah --</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-register">
                        <i class="bi bi-person-plus me-2"></i>Daftar Sekarang
                    </button>
                </form>

                <div class="login-link">
                    Sudah punya akun? <a href="<?= base_url('login') ?>">Login di sini</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

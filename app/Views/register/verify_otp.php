<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'Verifikasi OTP') ?> | Bank Sampah</title>
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
        .verify-wrapper {
            width: 100%;
            max-width: 480px;
        }
        .verify-card {
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            overflow: hidden;
        }
        .verify-header {
            background: var(--primary);
            padding: 24px 30px 16px;
            text-align: center;
            color: #fff;
        }
        .verify-header .icon {
            font-size: 2.5rem;
            color: var(--accent);
            margin-bottom: 8px;
        }
        .verify-header h4 {
            font-weight: 700;
        }
        .verify-body {
            padding: 30px;
        }
        .otp-input {
            letter-spacing: 8px;
            font-size: 1.5rem;
            text-align: center;
            font-weight: 700;
        }
        .form-control:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 0.2rem rgba(39, 174, 96, 0.25);
        }
        .btn-verify {
            background: var(--accent);
            border: none;
            color: #fff;
            font-weight: 600;
            padding: 12px;
            border-radius: 8px;
            width: 100%;
            transition: all 0.3s;
        }
        .btn-verify:hover {
            background: #219a52;
        }
        .alert {
            border-radius: 8px;
            font-size: 0.9rem;
        }
        .back-link {
            text-align: center;
            margin-top: 16px;
            font-size: 0.9rem;
        }
        .back-link a {
            color: var(--accent);
            text-decoration: none;
            font-weight: 600;
        }
        .info-box {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 16px;
            margin-bottom: 20px;
            font-size: 0.9rem;
            color: #555;
        }
        .info-box i {
            color: var(--accent);
        }
    </style>
</head>
<body>
    <div class="verify-wrapper">
        <div class="verify-card">
            <div class="verify-header">
                <div class="icon"><i class="bi bi-shield-check"></i></div>
                <h4>Verifikasi OTP</h4>
                <p>Masukkan kode OTP yang dikirim admin</p>
            </div>
            <div class="verify-body">
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

                <div class="info-box">
                    <i class="bi bi-whatsapp me-1"></i>
                    Kode OTP <strong>tidak dikirim otomatis lewat email</strong>. Admin akan menghubungi Anda lewat WhatsApp untuk memberikan kode verifikasi. Kode berlaku selama 15 menit setelah dibuat oleh admin.
                </div>

                <?php if (session('reg_email')): ?>
                <div class="alert alert-info">
                    <i class="bi bi-person-check me-1"></i>
                    Pendaftaran atas nama email <strong><?= session('reg_email') ?></strong> sedang menunggu verifikasi admin.
                </div>
                <?php endif; ?>

                <form action="<?= base_url('register/verify-submit') ?>" method="post">
                    <?= csrf_field() ?>
                    <div class="mb-4">
                        <label class="form-label">Kode OTP</label>
                        <input type="text" class="form-control otp-input" name="otp_code" placeholder="000000" required maxlength="6" pattern="[0-9]{6}" autofocus>
                    </div>
                    <button type="submit" class="btn btn-verify">
                        <i class="bi bi-check-lg me-2"></i>Verifikasi
                    </button>
                </form>

                <div class="mt-3 text-center text-muted small">
                    <i class="bi bi-info-circle"></i> Belum menerima kode? Hubungi admin Bank Sampah lewat WhatsApp. (0895704448306)
                </div>

                <div class="back-link">
                    <a href="<?= base_url('login') ?>"><i class="bi bi-arrow-left me-1"></i>Kembali ke Login</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
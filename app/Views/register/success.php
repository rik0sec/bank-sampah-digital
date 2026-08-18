<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi Berhasil | Bank Sampah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <style>
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
        .success-card {
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            padding: 40px;
            max-width: 500px;
            text-align: center;
            width: 100%;
        }
        .success-icon {
            font-size: 4rem;
            color: #27ae60;
            margin-bottom: 16px;
        }
        .btn-success-custom {
            background: #27ae60;
            border: none;
            color: #fff;
            font-weight: 600;
            padding: 12px 30px;
            border-radius: 8px;
            transition: all 0.3s;
        }
        .btn-success-custom:hover {
            background: #219a52;
            color: #fff;
        }
    </style>
</head>
<body>
    <div class="success-card">
        <div class="success-icon"><i class="bi bi-check-circle-fill"></i></div>
        <h4>Registrasi Berhasil!</h4>
        <p>Akun Anda telah terdaftar dan menunggu verifikasi OTP dari admin.</p>
        <p class="text-muted">Silakan hubungi admin untuk mendapatkan kode OTP, lalu verifikasi akun Anda.</p>
        <a href="<?= base_url('register/verify') ?>" class="btn btn-success-custom">
            <i class="bi bi-shield-check me-2"></i>Verifikasi OTP
        </a>
        <div class="mt-3">
            <a href="<?= base_url('login') ?>" class="text-decoration-none text-muted">
                Kembali ke Login
            </a>
        </div>
    </div>
</body>
</html>

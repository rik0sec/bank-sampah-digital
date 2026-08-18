<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Bank Sampah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <style>
        :root {
            --primary: #2c3e50;
            --primary-light: #34495e;
            --accent: #27ae60;
        }
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #2c3e50 0%, #27ae60 100%);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .login-wrapper {
            width: 100%;
            max-width: 440px;
            padding: 20px;
        }
        .login-card {
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            overflow: hidden;
        }
        .login-header {
            background: var(--primary);
            padding: 30px 30px 20px;
            text-align: center;
            color: #fff;
        }
        .login-header .logo-icon {
            font-size: 3rem;
            color: var(--accent);
            margin-bottom: 10px;
        }
        .login-header h4 {
            font-weight: 700;
            letter-spacing: 0.5px;
        }
        .login-header p {
            font-size: 0.85rem;
            opacity: 0.8;
            margin: 0;
        }
        .login-body {
            padding: 30px;
        }
        .form-floating > label {
            color: #6c757d;
        }
        .form-control:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 0.2rem rgba(39, 174, 96, 0.25);
        }
        .btn-login {
            background: var(--accent);
            border: none;
            color: #fff;
            font-weight: 600;
            padding: 12px;
            border-radius: 8px;
            width: 100%;
            transition: all 0.3s;
        }
        .btn-login:hover {
            background: #219a52;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(39, 174, 96, 0.4);
        }
        .alert {
            border-radius: 8px;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>
    <div class="login-wrapper">
        <div class="login-card">
            <div class="login-header">
                <div class="logo-icon">
                    <i class="bi bi-recycle"></i>
                </div>
                <h4>Bank Sampah</h4>
                <p>Silakan login untuk melanjutkan</p>
            </div>
            <div class="login-body">
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

                <form action="<?= base_url('login') ?>" method="post">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="username" name="username" placeholder="Username" required autofocus>
                        <label for="username"><i class="bi bi-person me-1"></i>Username</label>
                    </div>
                    <div class="form-floating mb-4">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                        <label for="password"><i class="bi bi-lock me-1"></i>Password</label>
                    </div>
                    <button type="submit" class="btn btn-login">
                        <i class="bi bi-box-arrow-in-right me-2"></i>Login
                    </button>
                </form>
                <div class="text-center mt-3">
                    <small>Belum punya akun? <a href="<?= base_url('register') ?>">Daftar di sini</a></small>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
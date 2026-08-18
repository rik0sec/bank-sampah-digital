<?php

namespace App\Controllers;

use App\Models\M_register;

class Register extends BaseController
{
    protected $mregister;

    function __construct()
    {
        $this->mregister = new M_register();
    }

    public function index()
    {
        if (session('logged_in')) {
            return redirect()->to(base_url('dashboard'));
        }

        $data['title'] = 'Registrasi Akun';
        return view('register/register', $data);
    }

    public function submit()
    {
        if (!$this->request->is('post')) {
            return redirect()->to(base_url('register'));
        }

        $rules = [
            'nama_lengkap' => 'required|min_length[3]|max_length[100]',
            'username' => 'required|min_length[3]|max_length[50]|is_unique[users.username]',
            'password' => 'required|min_length[6]',
            'email' => 'required|valid_email|max_length[100]|is_unique[users.email]',
            'no_telp' => 'permit_empty|max_length[20]',
        ];

        if (!$this->validate($rules)) {
            $data['title'] = 'Registrasi Akun';
            $data['validation'] = $this->validator;
            return view('register/register', $data);
        }

        $username = $this->request->getVar('username');
        $nama_lengkap = $this->request->getVar('nama_lengkap');
        $password = password_hash($this->request->getVar('password'), PASSWORD_DEFAULT);
        $email = $this->request->getVar('email');
        $no_telp = $this->request->getVar('no_telp');
        $role = 'nasabah';

        $otp_code = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        $otp_expires = date('Y-m-d H:i:s', strtotime('+15 minutes'));

        $data = [
            'username' => $username,
            'password' => $password,
            'nama_lengkap' => $nama_lengkap,
            'role' => $role,
            'email' => $email,
            'no_telp' => $no_telp,
            'otp_code' => $otp_code,
            'otp_expires' => $otp_expires,
        ];

        $this->mregister->register($data);

        session()->setFlashdata('success', 'Registrasi berhasil! Admin akan mengirimkan kode OTP verifikasi ke nomor WhatsApp Anda.');
        session()->setFlashdata('reg_email', $email);

        return redirect()->to(base_url('register/verify'));
    }

    public function verify()
    {
        if (session('logged_in')) {
            return redirect()->to(base_url('dashboard'));
        }

        $data['title'] = 'Verifikasi OTP';
        return view('register/verify_otp', $data);
    }

    public function verifySubmit()
{
    if (!$this->request->is('post')) {
        return redirect()->to(base_url('register/verify'));
    }

    $rules = [
        'otp_code' => 'required|exact_length[6]',
    ];

    if (!$this->validate($rules)) {
        $data['title'] = 'Verifikasi OTP';
        $data['validation'] = $this->validator;
        return view('register/verify_otp', $data);
    }

    $otpCode = $this->request->getVar('otp_code');
    $user    = $this->mregister->verifyUserByOTP($otpCode);

    if ($user) {
        $this->mregister->activateUser($user->id);

        // Auto-insert ke tabel nasabah
        $db = db_connect();

        // Cek dulu supaya tidak duplikat
        $existing = $db->query("SELECT id FROM nasabah WHERE user_id = ?", [$user->id])->getRow();
        if (!$existing) {
            // Generate kode nasabah unik
            $count     = $db->query("SELECT COUNT(*) as total FROM nasabah")->getRow()->total;
            $kode      = 'NSB-' . str_pad($count + 1, 3, '0', STR_PAD_LEFT);

            // Pastikan kode unik
            while ($db->query("SELECT id FROM nasabah WHERE kode_nasabah = ?", [$kode])->getRow()) {
                $count++;
                $kode = 'NSB-' . str_pad($count + 1, 3, '0', STR_PAD_LEFT);
            }

            $db->table('nasabah')->insert([
                'user_id'      => $user->id,
                'kode_nasabah' => $kode,
                'nama'         => $user->nama_lengkap,
                'alamat'       => '',
                'no_telp'      => $user->no_telp ?? '',
                'email'        => $user->email,
                'saldo'        => 0,
                'created_at'   => date('Y-m-d H:i:s'),
                'updated_at'   => date('Y-m-d H:i:s'),
            ]);
        }

        session()->setFlashdata('success', 'Verifikasi berhasil! Anda sekarang dapat login.');
        return redirect()->to(base_url('login'));
    } else {
        session()->setFlashdata('error', 'Kode OTP salah atau sudah kadaluarsa.');
        return redirect()->to(base_url('register/verify'));
    }
}

    public function resendOTP()
    {
        if (!$this->request->is('post')) {
            return redirect()->to(base_url('register/verify'));
        }

        $email = $this->request->getVar('email');
        $user = $this->mregister->getUserByEmail($email);

        if (!$user || $user->is_verified != 0) {
            session()->setFlashdata('error', 'Email tidak ditemukan atau akun sudah terverifikasi.');
            return redirect()->to(base_url('register/verify'));
        }

        $otp_code = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        $otp_expires = date('Y-m-d H:i:s', strtotime('+15 minutes'));
        $this->mregister->updateOTP($user->id, $otp_code, $otp_expires);

        $emailService = \Config\Services::email();
        $emailService->setFrom('bank.sampah@example.com', 'Bank Sampah');
        $emailService->setTo($email);
        $emailService->setSubject('Kode OTP Baru - Bank Sampah');
        $emailService->setMessage("
            <h3>Kode OTP Baru Anda</h3>
            <p>Kode OTP Anda adalah: <strong>{$otp_code}</strong></p>
            <p>Kode ini berlaku selama 15 menit.</p>
            <p>Hubungi admin untuk mendapatkan kode verifikasi ini.</p>
        ");
        $emailService->setMailType('html');

        try {
            $emailSent = $emailService->send();
            if ($emailSent) {
                session()->setFlashdata('success', 'Kode OTP baru telah dikirim ke email Anda.');
                session()->setFlashdata('reg_email', $email);
            } else {
                $errors = $emailService->printDebugger(['headers']);
                session()->setFlashdata('error', 'Gagal mengirim email. Hubungi admin untuk verifikasi manual. (' . $email . ' OTP: ' . $otp_code . ')');
            }
        } catch (\Exception $e) {
            session()->setFlashdata('error', 'Gagal mengirim email. Hubungi admin untuk verifikasi manual. (' . $email . ' OTP: ' . $otp_code . ')');
        }

        return redirect()->to(base_url('register/verify'));
    }
}

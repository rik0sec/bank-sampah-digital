<?php

namespace App\Controllers;

use App\Models\M_users;
use App\Models\M_register;

class Auth extends BaseController
{
    protected $musers;
    protected $mregister;

    function __construct()
    {
        $this->musers = new M_users();
        $this->mregister = new M_register();
    }

    public function index()
    {
        if (session('logged_in')) {
            return redirect()->to(base_url('dashboard'));
        }
        return view('auth/login');
    }

    public function login()
    {
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');

        $user = $this->musers->login_user($username);

        if ($user) {
            if ($user->is_verified != 1) {
                session()->setFlashdata('error', 'Akun Anda belum diverifikasi. Silakan verifikasi OTP terlebih dahulu atau hubungi admin.');
                return redirect()->to(base_url('login'));
            }

            if (password_verify($password, $user->password)) {
                $sessionData = [
                    'id'        => $user->id,
                    'username'  => $user->username,
                    'nama'      => $user->nama_lengkap,
                    'role'      => $user->role,
                    'logged_in' => true,
                ];
                session()->set($sessionData);

                session()->set($sessionData);
                $device = (string) $this->request->getUserAgent();
                $this->musers->updateLastLogin($user->id, $device);

                $mactivity = new \App\Models\M_activity_log();
                $mactivity->catat($user->id, 'Login ke sistem', 'Login berhasil dari ' . $device);

if ($user->role == 'admin') 

                if ($user->role == 'admin') {

    return redirect()->to(base_url('dashboard'));

} elseif ($user->role == 'petugas') {

    return redirect()->to(base_url('dashboard-petugas'));

} elseif ($user->role == 'nasabah') {

    $db = db_connect();

    $nasabah = $db->query(
        "SELECT id FROM nasabah WHERE user_id = ?",
        [$user->id]
    )->getRow();

    if ($nasabah) {
        return redirect()->to(
            base_url('nasabah-menu/dashboard/'.$nasabah->id)
        );
    }

    session()->setFlashdata('error', 'Data nasabah tidak ditemukan.');
    return redirect()->to(base_url('login'));
}
            }
            
        }

        session()->setFlashdata('error', 'Username atau password salah!');
        return redirect()->to(base_url('login'));
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url('login'));
    }
}
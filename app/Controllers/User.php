<?php

namespace App\Controllers;

use App\Models\M_users;
use App\Models\M_register;

class User extends BaseController
{
    protected $musers;
    protected $mregister;

    function __construct()
    {
        $this->musers = new M_users();
        $this->mregister = new M_register();
    }

    public function index(): string
    {
        $data['users'] = $this->musers->list_all();
        return view('users/list_users', $data);
    }

    public function tambah()
{
    if ($_POST) {

        $dataPost["username"] = $this->request->getVar("username");
        $dataPost["password"] = password_hash(
            $this->request->getVar("password"),
            PASSWORD_DEFAULT
        );

        $dataPost["nama_lengkap"] = $this->request->getVar("nama_lengkap");
        $dataPost["role"] = $this->request->getVar("role");

        $dataPost["is_verified"] = 1;
        $dataPost["otp_code"] = null;
        $dataPost["otp_expires"] = null;

        $tambah = $this->musers->add($dataPost);

        if ($dataPost["role"] == "nasabah") {

            $db = db_connect();

            $user = $db->query(
                "SELECT * FROM users WHERE username = ?",
                [$dataPost["username"]]
            )->getRow();

            if ($user) {
    $last = $db->query(
        "SELECT kode_nasabah FROM nasabah WHERE kode_nasabah LIKE 'NSB-%' ORDER BY id DESC LIMIT 1"
    )->getRow();

    if ($last && preg_match('/NSB-(\d+)/', $last->kode_nasabah, $matches)) {
        $number = (int)$matches[1] + 1;
    } else {
        $number = 1;
    }

    $kode_nasabah = 'NSB-' . str_pad($number, 3, '0', STR_PAD_LEFT);

    $db->table('nasabah')->insert([
        'user_id'      => $user->id,
        'kode_nasabah' => $kode_nasabah,
        'nama'         => $dataPost["nama_lengkap"],
        'saldo'        => 0,
        'created_at'   => date('Y-m-d H:i:s'),
        'updated_at'   => date('Y-m-d H:i:s')
    ]);
            }
        }

        session()->setFlashdata(
            'success',
            'User berhasil dibuat'
        );

        return redirect()->to(base_url('user'));
    }

    // WAJIB ADA
    return view('users/tambah_users');
}

    public function edit($id)
{
    if ($_POST) {
        $username     = $this->request->getVar("username");
        $password     = $this->request->getVar("password");
        $nama_lengkap = $this->request->getVar("nama_lengkap");
        $role         = $this->request->getVar("role");
        $alamat       = $this->request->getVar("alamat");

        if (!empty($password)) {
            $password = password_hash($password, PASSWORD_DEFAULT);
        }

        $update = $this->musers->updateData($id, $username, $password, $nama_lengkap, $role, $alamat);

        if ($update == "success") {
            session()->setFlashdata('success', 'Data user berhasil diperbarui!');
        } else {
            session()->setFlashdata('error', 'Gagal memperbarui data user!');
        }
        return redirect()->to(base_url("user"));
    }

    $data["user"] = $this->musers->getData($id);
    return view('users/edit_users', $data);
}

    public function delete($id)
    {
        $delete = $this->musers->deleteData($id);
        return redirect()->to(base_url("user"));
    }

    public function pending_registrations()
    {
        if (!session('logged_in') || session('role') != 'admin') {
            session()->setFlashdata('error', 'Akses ditolak. Hanya admin yang dapat mengakses halaman ini.');
            return redirect()->to(base_url('login'));
        }

        $data['pending_users'] = $this->mregister->getPendingRegistrations();
        $data['title'] = 'Verifikasi Pendaftar';
        return view('users/pending_registrations', $data);
    }

    public function sendOTP($id)
    {
        if (!session('logged_in') || session('role') != 'admin') {
            session()->setFlashdata('error', 'Akses ditolak.');
            return redirect()->to(base_url('login'));
        }

        $user = $this->mregister->getUserById($id);
        if (!$user) {
            session()->setFlashdata('error', 'Pengguna tidak ditemukan.');
            return redirect()->to(base_url('user/pending_registrations'));
        }

        $otp_code = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        $otp_expires = date('Y-m-d H:i:s', strtotime('+15 minutes'));
        $this->mregister->updateOTP($id, $otp_code, $otp_expires);

        // Susun pesan WhatsApp yang siap dikirim ke nasabah
        $pesanWA = "Halo {$user->nama_lengkap},\n\n"
            . "Berikut kode OTP untuk verifikasi akun Bank Sampah Anda:\n\n"
            . "*{$otp_code}*\n\n"
            . "Kode ini berlaku selama 15 menit. Masukkan kode ini di halaman verifikasi pendaftaran.\n"
            . base_url('register/verify');

        session()->setFlashdata('otp_info', [
            'nama'     => $user->nama_lengkap,
            'otp'      => $otp_code,
            'wa_link'  => $this->buildWhatsAppLink($user->no_telp, $pesanWA),
            'no_telp'  => $user->no_telp,
        ]);
        session()->setFlashdata('success', "Kode OTP untuk {$user->nama_lengkap} berhasil dibuat: {$otp_code}");

        return redirect()->to(base_url('user/pending_registrations'));
    }

    /**
     * Membentuk link wa.me dari nomor telepon lokal (misal 08xxxx) + pesan.
     */
    private function buildWhatsAppLink(?string $noTelp, string $pesan): ?string
    {
        if (empty($noTelp)) {
            return null;
        }

        $nomor = preg_replace('/[^0-9]/', '', $noTelp);

        if (substr($nomor, 0, 1) === '0') {
            $nomor = '62' . substr($nomor, 1);
        } elseif (substr($nomor, 0, 2) !== '62') {
            $nomor = '62' . $nomor;
        }

        return 'https://wa.me/' . $nomor . '?text=' . rawurlencode($pesan);
    }

    public function approveDirect($id)
    {
        if (!session('logged_in') || session('role') != 'admin') {
            session()->setFlashdata('error', 'Akses ditolak.');
            return redirect()->to(base_url('login'));
        }

        $user = $this->mregister->getUserById($id);
        if (!$user) {
            session()->setFlashdata('error', 'Pengguna tidak ditemukan.');
            return redirect()->to(base_url('user/pending_registrations'));
        }

        $this->mregister->activateUser($id);
        session()->setFlashdata('success', "Akun {$user->username} berhasil diverifikasi dan diaktifkan.");
        return redirect()->to(base_url('user/pending_registrations'));
    }

    public function reject($id)
    {
        if (!session('logged_in') || session('role') != 'admin') {
            session()->setFlashdata('error', 'Akses ditolak.');
            return redirect()->to(base_url('login'));
        }

        $this->musers->deleteData($id);
        session()->setFlashdata('success', 'Pendaftaran berhasil ditolak dan dihapus.');
        return redirect()->to(base_url('user/pending_registrations'));
    }
}
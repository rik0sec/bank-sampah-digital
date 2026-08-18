<?php
namespace App\Controllers;

use App\Models\M_users;
use App\Models\M_activity_log;

class Profil extends BaseController
{
    protected $musers;
    protected $mactivity;

    function __construct()
    {
        $this->musers = new M_users();
        $this->mactivity = new M_activity_log();
    }

    public function admin()
    {
        if (!session('logged_in') || session('role') != 'admin') {
            session()->setFlashdata('error', 'Akses ditolak.');
            return redirect()->to(base_url('login'));
        }

        $db = db_connect();
        $userId = session('id');

        $data['user'] = $this->musers->getData($userId);
        $data['total_user'] = $db->table('users')->countAllResults();

        $data['penyetoran_hari'] = $db->table('penyetoran')
            ->where('tanggal', date('Y-m-d'))
            ->where('status', 'disetujui')
            ->countAllResults();

        $pemasukan = $db->table('penyetoran')
            ->selectSum('total_harga')
            ->where('status', 'disetujui')
            ->get()->getRow();
        $data['total_pemasukan'] = $pemasukan->total_harga ?? 0;

        $data['pending_pengajuan'] = $db->table('penyetoran')
            ->where('status', 'pending')
            ->countAllResults();

        $data['activities'] = $this->mactivity->getByUser($userId, 10);
        $data['title'] = 'Profil Admin';

return view('profil/admin', $data);
    }

    public function petugas()
    {
        if (!session('logged_in') || session('role') != 'petugas') {
            session()->setFlashdata('error', 'Akses ditolak.');
            return redirect()->to(base_url('login'));
        }

        $db = db_connect();
        $userId = session('id');

        $data['user'] = $this->musers->getData($userId);

        $data['penyetoran_diproses'] = $db->table('penyetoran')
            ->where('petugas_id', $userId)
            ->where('tanggal', date('Y-m-d'))
            ->countAllResults();

        $data['pending_pengajuan'] = $db->table('penyetoran')
            ->where('status', 'pending')
            ->countAllResults();

        $totalBerat = $db->table('penyetoran')
            ->selectSum('total_berat')
            ->where('petugas_id', $userId)
            ->where('status', 'disetujui')
            ->get()->getRow();
        $data['total_berat'] = $totalBerat->total_berat ?? 0;

        $data['activities'] = $this->mactivity->getByUser($userId, 10);
        $data['title'] = 'Profil Petugas';

        return view('profil/petugas', $data);
    }

    public function update()
{
    if (!session('logged_in')) {
        return redirect()->to(base_url('login'));
    }

    $userId = session('id');
    $role   = session('role');

    $data = [
        'nama_lengkap' => $this->request->getVar('nama_lengkap'),
        'email'        => $this->request->getVar('email'),
        'no_telp'      => $this->request->getVar('no_telp'),
        'alamat'       => $this->request->getVar('alamat'),
    ];

    $this->musers->updateProfil($userId, $data);
    session()->set('nama', $data['nama_lengkap']);
    $this->mactivity->catat($userId, 'Update profil', 'Mengubah data diri');

    session()->setFlashdata('success', 'Profil berhasil diperbarui!');
    return redirect()->to(base_url($role == 'admin' ? 'profil-admin' : 'profil-petugas'));
}

    public function gantiPassword()
    {
        if (!session('logged_in')) {
            return redirect()->to(base_url('login'));
        }

        $userId = session('id');
        $role   = session('role');

        $passwordLama = $this->request->getVar('password_lama');
        $passwordBaru = $this->request->getVar('password_baru');
        $konfirmasi   = $this->request->getVar('konfirmasi_password');

        $user = $this->musers->getData($userId);

        if (!password_verify($passwordLama, $user->password)) {
            session()->setFlashdata('error', 'Password lama salah!');
            return redirect()->back();
        }

        if ($passwordBaru !== $konfirmasi) {
            session()->setFlashdata('error', 'Konfirmasi password baru tidak cocok!');
            return redirect()->back();
        }

        if (strlen($passwordBaru) < 6) {
            session()->setFlashdata('error', 'Password baru minimal 6 karakter!');
            return redirect()->back();
        }

        $this->musers->updatePasswordOnly($userId, password_hash($passwordBaru, PASSWORD_DEFAULT));
        $this->mactivity->catat($userId, 'Ganti password', 'Password berhasil diubah');

        session()->setFlashdata('success', 'Password berhasil diubah!');
        return redirect()->to(base_url($role == 'admin' ? 'profil-admin' : 'profil-petugas'));
    }
}
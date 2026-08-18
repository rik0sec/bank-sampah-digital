<?php
namespace App\Controllers;

use App\Models\M_users;

class ProfilPetugas extends BaseController
{
    protected $M_users;

    public function __construct()
    {
        $this->M_users = new M_users();
    }

    public function index()
    {
        $id = session('id');

        if (!$id) {
            return redirect()->to(base_url('login'));
        }

        $user = $this->M_users->getData($id);

        if (!$user) {
            return redirect()->to(base_url('login'))->with('error', 'Data user tidak ditemukan');
        }

        // ==== Statistik ringkas (global sistem, karena tabel penyetoran
        // belum punya kolom relasi ke petugas yang memverifikasi) ====
        $db = db_connect();

        $data['user'] = $user;
        $data['totalNasabahDilayani'] = $db->table('nasabah')->countAllResults();
        $data['totalSetoranDiproses'] = $db->table('penyetoran')
            ->where('status', 'disetujui')
            ->countAllResults();
        $data['totalBeratDiproses'] = $db->query("
            SELECT SUM(total_berat) AS total
            FROM penyetoran
            WHERE status='disetujui'
        ")->getRow()->total ?? 0;
        $data['pengajuanPending'] = $db->table('pengajuan_setoran')
            ->where('status', 'pending')
            ->countAllResults();

        return view('petugas/profil', $data);
    }

    public function update()
    {
        $id = session('id');

        if (!$id) {
            return redirect()->to(base_url('login'));
        }

        $data = [
    'nama_lengkap' => $this->request->getPost('nama_lengkap'),
    'email'        => $this->request->getPost('email'),
    'no_telp'      => $this->request->getPost('no_telp'),
    'alamat'       => $this->request->getPost('alamat'),
];

        $result = $this->M_users->updateProfil($id, $data);

        if ($result) {
            session()->set('nama', $data['nama_lengkap']);
            return redirect()->to(base_url('profil-petugas'))->with('success', 'Data diri berhasil diperbarui');
        }
        
        return redirect()->back()->with('error', 'Gagal memperbarui data');
    }
}
<?php

namespace App\Controllers;

use App\Models\M_nasabah;
use App\Models\M_penyetoran;

class NasabahMenu extends BaseController
{
    protected $mnasabah;
    protected $mpenyetoran;

    function __construct()
    {
        $this->mnasabah = new M_nasabah();
        $this->mpenyetoran = new M_penyetoran();
    }

    public function index(): string
    {
        $data['nasabah'] = $this->mnasabah->list_all();
        return view('nasabah_menu/index', $data);
    }

    public function dashboard($id = null)
    {
        if (!$id) {
            return redirect()->to(base_url('nasabah-menu'));
        }

        $db = db_connect();

$nasabah = $db->query("
    SELECT
        n.*,
        u.username,
        u.nama_lengkap,
        u.role
    FROM nasabah n
    LEFT JOIN users u
        ON u.id = n.user_id
    WHERE n.id = ?
", [$id])->getRow();

if (!$nasabah) {
    return redirect()->to(base_url('nasabah-menu'));
}

$data['nasabah'] = $nasabah;

        $db = db_connect();
        $query = $db->query("
            SELECT 
                COALESCE(SUM(total_harga), 0) as total_setoran,
                COUNT(*) as jumlah_transaksi
            FROM penyetoran 
            WHERE nasabah_id = '$id'
        ");
        $data['summary'] = $query->getRow();

        $query2 = $db->query("
            SELECT p.* 
            FROM penyetoran p
            WHERE p.nasabah_id = '$id'
            ORDER BY p.tanggal DESC
            LIMIT 5
        ");
        $data['riwayat'] = $query2->getResult();

        return view('nasabah_menu/dashboard', $data);
    }

    public function select()
    {
        $id = $this->request->getGet('id');
        if ($id) {
            return redirect()->to(base_url('nasabah-menu/dashboard/'.$id));
        }
        return redirect()->to(base_url('nasabah-menu'));
    }

    public function profil($id = null)
    {
        if (!$id) {
            return redirect()->to(base_url('nasabah-menu'));
        }

        $db = db_connect();

$nasabah = $db->query("
    SELECT
        n.*,
        u.username,
        u.nama_lengkap,
        u.role
    FROM nasabah n
    LEFT JOIN users u
        ON u.id = n.user_id
    WHERE n.id = ?
", [$id])->getRow();

if (!$nasabah) {
    return redirect()->to(base_url('nasabah-menu'));
}

$data['nasabah'] = $nasabah;
        $db = db_connect();
        $summary = $db->query(
            "SELECT 
                COALESCE(SUM(total_harga), 0) as total_setoran,
                COALESCE(SUM(total_berat), 0) as total_berat,
                COUNT(*) as jumlah_transaksi
            FROM penyetoran 
            WHERE nasabah_id = ?",
            [$id]
        )->getRow();

        $summary->rata_rata = $summary->jumlah_transaksi > 0
            ? $summary->total_setoran / $summary->jumlah_transaksi
            : 0;

        $data['summary'] = $summary;

        return view('nasabah_menu/profil', $data);
    }

    public function update($id = null)
    {
        if (!$id) {
            return redirect()->to(base_url('nasabah-menu'));
        }

        $db = db_connect();

$nasabah = $db->query("
    SELECT
        n.*,
        u.username,
        u.nama_lengkap,
        u.role
    FROM nasabah n
    LEFT JOIN users u
        ON u.id = n.user_id
    WHERE n.id = ?
", [$id])->getRow();

if (!$nasabah) {
    return redirect()->to(base_url('nasabah-menu'));
}

$data['nasabah'] = $nasabah;

        if ($_POST) {
            $nama    = $this->request->getVar("nama");
            $alamat  = $this->request->getVar("alamat");
            $no_telp = $this->request->getVar("no_telp");
            $email   = $this->request->getVar("email");

            $db = db_connect();
            try {
                $db->simpleQuery("
                    UPDATE nasabah 
                    SET nama       = '$nama',
                        alamat     = '$alamat',
                        no_telp    = '$no_telp',
                        email      = '$email',
                        updated_at = NOW()
                    WHERE id = '$id'
                ");
                session()->setFlashdata('success', 'Data berhasil diperbarui!');
                return redirect()->to(base_url("nasabah-menu/profil/$id"));
            } catch (\Exception $e) {
                session()->setFlashdata('error', $e->getMessage());
                return redirect()->back();
            }
        }

        $data['nasabah'] = $nasabah;
        return view('nasabah_menu/update', $data);
    }

    public function cetak_nota($id = null)
    {
        if (!$id) {
            return redirect()->to(base_url('nasabah-menu'));
        }

        $db = db_connect();

$nasabah = $db->query("
    SELECT
        n.*,
        u.username,
        u.nama_lengkap,
        u.role
    FROM nasabah n
    LEFT JOIN users u
        ON u.id = n.user_id
    WHERE n.id = ?
", [$id])->getRow();

if (!$nasabah) {
    return redirect()->to(base_url('nasabah-menu'));
}

$data['nasabah'] = $nasabah;

        $db = db_connect();
        $query = $db->query("
            SELECT * FROM penyetoran 
            WHERE nasabah_id = '$id' 
            ORDER BY tanggal DESC
        ");
        $data['penyetoran'] = $query->getResult();

        return view('nasabah_menu/cetak_nota', $data);
    }

    public function nota_detail($nasabah_id = null, $penyetoran_id = null)
    {
        if (!$nasabah_id || !$penyetoran_id) {
            return redirect()->to(base_url('nasabah-menu'));
        }

        $nasabah    = $this->mnasabah->getData($nasabah_id);
        $penyetoran = $this->mpenyetoran->getData($penyetoran_id);

        if (!$nasabah || !$penyetoran || $penyetoran->nasabah_id != $nasabah_id) {
            return redirect()->to(base_url('nasabah-menu'));
        }

        $db      = db_connect();
        $petugas = null;
        if (!empty($penyetoran->petugas_id)) {
            $petugas = $db->query(
                "SELECT nama_lengkap FROM users WHERE id = ?",
                [$penyetoran->petugas_id]
            )->getRow();
        }

        $data['nasabah']    = $nasabah;
        $data['penyetoran'] = $penyetoran;
        $data['detail']     = $this->mpenyetoran->getDetail($penyetoran_id);
        $data['petugas']    = $petugas;

        return view('nasabah_menu/nota_detail', $data);
    }

    public function dashboardSaya()
    {
        $userId  = session('id');
        $db      = db_connect();
        $nasabah = $db->query("SELECT * FROM nasabah WHERE user_id = ?", [$userId])->getRow();

        if (!$nasabah) {
            session()->setFlashdata('error', 'Data nasabah tidak ditemukan');
            return redirect()->to(base_url('dashboard'));
        }

        return redirect()->to(base_url('nasabah-menu/dashboard/' . $nasabah->id));
    }

    public function ajukan_setoran()
    {
        $db      = db_connect();
        $userId  = session('id');
        $nasabah = $db->query("SELECT * FROM nasabah WHERE user_id = ?", [$userId])->getRow();

        if ($_POST) {
            $jenis = $this->request->getVar('jenis_sampah');
            $berat = $this->request->getVar('berat');

            $harga    = $db->query(
                "SELECT * FROM harga_sampah WHERE jenis_sampah_id = ?",
                [$jenis]
            )->getRow();

            $subtotal = $berat * $harga->harga_per_kg;

            $db->table('pengajuan_setoran')->insert([
                'nasabah_id'      => $nasabah->id,
                'jenis_sampah_id' => $jenis,
                'berat'           => $berat,
                'harga_per_kg'    => $harga->harga_per_kg,
                'subtotal'        => $subtotal,
                'status'          => 'pending',
                'created_at'      => date('Y-m-d H:i:s'),
            ]);

            session()->setFlashdata('success', 'Pengajuan berhasil dikirim!');
            return redirect()->back();
        }

        $data['jenis'] = $db->query("
            SELECT js.id, js.nama_jenis, hs.harga_per_kg
            FROM jenis_sampah js
            LEFT JOIN harga_sampah hs ON hs.jenis_sampah_id = js.id
            ORDER BY js.nama_jenis ASC
        ")->getResult();

        $data['riwayat'] = $db->query("
            SELECT ps.*, js.nama_jenis, hs.harga_per_kg
            FROM pengajuan_setoran ps
            LEFT JOIN jenis_sampah js ON js.id = ps.jenis_sampah_id
            LEFT JOIN harga_sampah hs ON hs.jenis_sampah_id = ps.jenis_sampah_id
            WHERE ps.nasabah_id = ?
            ORDER BY ps.created_at DESC
        ", [$nasabah->id])->getResult();

        return view('nasabah_menu/ajukan_setoran', $data);
    }
}
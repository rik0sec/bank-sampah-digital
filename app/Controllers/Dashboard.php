<?php

namespace App\Controllers;

use App\Models\M_nasabah;
use App\Models\M_jenis_sampah;
use App\Models\M_penyetoran;

class Dashboard extends BaseController
{
    protected $mnasabah;    
    protected $mjenis;
    protected $mpenyetoran;

    function __construct()
    {
        $this->mnasabah = new M_nasabah();
        $this->mjenis = new M_jenis_sampah();
        $this->mpenyetoran = new M_penyetoran();
    }

    public function index()
{
    if (!session('logged_in')) {
        return redirect()->to(base_url('login'));
    }
    // Cegah selain admin masuk ke dashboard admin
if (session('role') != 'admin') {

    if (session('role') == 'petugas') {
        return redirect()->to(base_url('dashboard-petugas'));
    }

    if (session('role') == 'nasabah') {

        $db = db_connect();

        $nasabah = $db->query(
            "SELECT id FROM nasabah WHERE user_id = ?",
            [session('id')]
        )->getRow();

        if ($nasabah) {
            return redirect()->to(
                base_url('nasabah-menu/dashboard/'.$nasabah->id)
            );
        }

        return redirect()->to(base_url('login'));
    }
}

    $db = db_connect();

    $data['total_nasabah']     = $db->query("SELECT COUNT(*) as total FROM nasabah")->getRow()->total;
    $data['total_jenis_sampah']= $db->query("SELECT COUNT(*) as total FROM jenis_sampah")->getRow()->total;
    $data['total_penyetoran']  = $db->query("SELECT COUNT(*) as total FROM penyetoran WHERE status = 'disetujui'")->getRow()->total;
    $data['total_berat_masuk'] = $db->query("SELECT COALESCE(SUM(total_berat), 0) as total FROM penyetoran WHERE status = 'disetujui'")->getRow()->total;

    // ✅ FIX: Total pemasukan dari penyetoran
    $data['total_pemasukan'] = $db->query("
        SELECT COALESCE(SUM(total_harga), 0) AS total 
        FROM penyetoran 
        WHERE status = 'disetujui'
    ")->getRow()->total;

    $data['total_saldo']   = $db->query("SELECT COALESCE(SUM(saldo),0) AS total FROM nasabah")->getRow()->total;
    $data['total_pending'] = $db->query("SELECT COUNT(*) AS total FROM pengajuan_setoran WHERE status='pending'")->getRow()->total;
    $data['total_ditolak'] = $db->query("SELECT COUNT(*) AS total FROM pengajuan_setoran WHERE status='ditolak'")->getRow()->total;

    // ✅ FIX: Grafik dari data nyata per bulan
    $grafik = $db->query("
        SELECT 
            MONTH(tanggal) AS bulan,
            SUM(total_berat) AS berat
        FROM penyetoran
        WHERE status = 'disetujui'
        GROUP BY MONTH(tanggal)
        ORDER BY MONTH(tanggal)
    ")->getResult();

    $bulanLabel = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'];
    $beratData  = array_fill(0, 12, 0);

    foreach ($grafik as $g) {
        $beratData[(int)$g->bulan - 1] = (float)$g->berat;
    }

    $data['grafik_bulan'] = json_encode($bulanLabel);
    $data['grafik_berat'] = json_encode($beratData);

    // ✅ FIX: Grafik per kategori jenis sampah
    $kategori = $db->query("
        SELECT js.kategori, COALESCE(SUM(ps.berat), 0) AS total
        FROM pengajuan_setoran ps
        JOIN jenis_sampah js ON js.id = ps.jenis_sampah_id
        WHERE ps.status = 'disetujui'
        GROUP BY js.kategori
    ")->getResult();

    $kLabels = [];
    $kData   = [];
    foreach ($kategori as $k) {
        $kLabels[] = $k->kategori;
        $kData[]   = (float)$k->total;
    }

    $data['grafik_kategori_labels'] = json_encode($kLabels);
    $data['grafik_kategori_data']   = json_encode($kData);

    return view('dashboard', $data);
}
}
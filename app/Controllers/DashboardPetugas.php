<?php

namespace App\Controllers;

class DashboardPetugas extends BaseController
{
    public function index()
    {
        $db = db_connect();

        // =========================
        // Statistik Dashboard
        // =========================

        $data['totalNasabah'] = $db->table('nasabah')->countAllResults();

        $data['totalJenis'] = $db->table('jenis_sampah')->countAllResults();

        $data['totalSetoran'] = $db->table('penyetoran')
            ->where('status', 'disetujui')
            ->countAllResults();

        $data['totalBeratMasuk'] = $db->query("
            SELECT SUM(total_berat) AS total
            FROM penyetoran
            WHERE status='disetujui'
        ")->getRow()->total ?? 0;

        $data['totalPemasukan'] = $db->query("
            SELECT SUM(total_harga) AS total
            FROM penyetoran
            WHERE status='disetujui'
        ")->getRow()->total ?? 0;

        $data['totalBeratJual'] = 0;
        $data['totalPengeluaran'] = 0;

        // =========================
        // Grafik Berat Masuk per Bulan
        // =========================

        $grafik = $db->query("
            SELECT
                MONTH(tanggal) AS bulan,
                SUM(total_berat) AS berat
            FROM penyetoran
            WHERE status='disetujui'
            GROUP BY MONTH(tanggal)
            ORDER BY MONTH(tanggal)
        ")->getResult();

        $bulan = [];
        $berat = [];

        foreach ($grafik as $g) {
            $bulan[] = date('M', mktime(0, 0, 0, $g->bulan, 1));
            $berat[] = (float) $g->berat;
        }

        $data['bulan'] = json_encode($bulan);
        $data['berat'] = json_encode($berat);

        // =========================
        // Data Pengajuan
    // =========================
$data['pendingSetoran'] = $db->table('pengajuan_setoran')
    ->where('status', 'pending')
    ->countAllResults();

// ✅ DIUBAH: dari pengajuan_setoran → penyetoran (konsisten dengan admin)
$data['setoranDisetujui'] = $db->table('penyetoran')
    ->where('status', 'disetujui')
    ->countAllResults();

$data['totalBerat'] = $db->query("
    SELECT SUM(total_berat) AS total
    FROM penyetoran
    WHERE status='disetujui'
")->getRow()->total ?? 0;

$data['riwayat'] = $db->query("
    SELECT
        ps.*,
        n.nama,
        js.nama_jenis
    FROM pengajuan_setoran ps
    JOIN nasabah n
        ON n.id = ps.nasabah_id
    JOIN jenis_sampah js
        ON js.id = ps.jenis_sampah_id
    ORDER BY ps.id DESC
    LIMIT 5
")->getResult();

        // ===================================================
        // Mapping variabel agar sesuai dengan dashboard.php
        // ===================================================

        $data['total_nasabah']       = $data['totalNasabah'];
        $data['total_jenis_sampah']  = $data['totalJenis'];
        $data['total_penyetoran']    = $data['totalSetoran'];

        $data['total_berat_masuk']   = $data['totalBeratMasuk'];
        $data['total_berat_jual']    = $data['totalBeratJual'];

        $data['total_rupiah_masuk']  = $data['totalPemasukan'];
        $data['total_rupiah_jual']   = $data['totalPengeluaran'];

        // Nilai penjualan (Rp)
        $data['total_penjualan']     = $data['totalPengeluaran'];

        $data['grafik_bulan']        = $data['bulan'];
        $data['grafik_berat']        = $data['berat'];

        return view('petugas/dashboard', $data);
    }
}
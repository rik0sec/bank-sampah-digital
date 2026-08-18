<?php

namespace App\Controllers;

class LaporanPetugas extends BaseController
{
    public function index()
    {
        $db     = db_connect();
        $tanggal = $this->request->getGet('tanggal') ?? date('Y-m-d');

        $data['tanggal'] = $tanggal;

        // Total semua pengajuan hari ini
        $data['summary'] = $db->query("
            SELECT 
                COUNT(*) as total_pengajuan,
                SUM(CASE WHEN status='disetujui' THEN 1 ELSE 0 END) as total_disetujui,
                SUM(CASE WHEN status='ditolak'   THEN 1 ELSE 0 END) as total_ditolak,
                SUM(CASE WHEN status='pending'   THEN 1 ELSE 0 END) as total_pending,
                COALESCE(SUM(CASE WHEN status='disetujui' THEN berat   ELSE 0 END), 0) as total_berat,
                COALESCE(SUM(CASE WHEN status='disetujui' THEN subtotal ELSE 0 END), 0) as total_pendapatan
            FROM pengajuan_setoran
            WHERE DATE(created_at) = ?
        ", [$tanggal])->getRow();

        // Detail per transaksi
        $data['detail'] = $db->query("
            SELECT 
                ps.*,
                n.nama as nama_nasabah,
                n.kode_nasabah,
                js.nama_jenis
            FROM pengajuan_setoran ps
            LEFT JOIN nasabah n  ON n.id  = ps.nasabah_id
            LEFT JOIN jenis_sampah js ON js.id = ps.jenis_sampah_id
            WHERE DATE(ps.created_at) = ?
            ORDER BY ps.created_at ASC
        ", [$tanggal])->getResult();

        // Rekap per jenis sampah (hanya disetujui)
        $data['rekap_jenis'] = $db->query("
            SELECT 
                js.nama_jenis,
                COUNT(*) as jumlah,
                SUM(ps.berat) as total_berat,
                SUM(ps.subtotal) as total_nilai
            FROM pengajuan_setoran ps
            LEFT JOIN jenis_sampah js ON js.id = ps.jenis_sampah_id
            WHERE DATE(ps.created_at) = ? AND ps.status = 'disetujui'
            GROUP BY js.id, js.nama_jenis
            ORDER BY total_berat DESC
        ", [$tanggal])->getResult();

            $admin = $db->query("SELECT nama_lengkap FROM users WHERE role = 'admin' LIMIT 1")->getRow();
            $data['nama_admin'] = $admin->nama_lengkap ?? 'Admin';

            $data['nama_petugas'] = session('nama_lengkap') ?? session('username') ?? 'Petugas';

        return view('laporan/laporan_petugas', $data);
    }
}
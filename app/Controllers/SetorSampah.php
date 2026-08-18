<?php

namespace App\Controllers;

class SetorSampah extends BaseController
{
    public function index()
    {
        $db = db_connect();

        // HANYA tampilkan jenis sampah yang harganya sedang berlaku (periode aktif hari ini).
        // INNER JOIN + filter tanggal -> jenis dengan harga "Berakhir" otomatis tidak ikut tampil.
        $data['jenis'] = $db->query("
            SELECT js.*, hs.harga_per_kg, hs.berlaku_mulai, hs.berlaku_sampai
            FROM jenis_sampah js
            INNER JOIN harga_sampah hs
                ON js.id = hs.jenis_sampah_id
            WHERE CURDATE() BETWEEN hs.berlaku_mulai AND hs.berlaku_sampai
            GROUP BY js.id
        ")->getResult();

        return view('nasabah_menu/setor_sampah', $data);
    }

    public function simpan()
    {
        $db = db_connect();

        $jenis = $this->request->getPost('jenis_sampah_id');
        $berat = $this->request->getPost('berat');

        if (empty($jenis) || empty($berat) || $berat <= 0) {
            session()->setFlashdata('error', 'Data yang diisi tidak valid.');
            return redirect()->back()->withInput();
        }

        // Ambil harga HANYA jika periode masih aktif hari ini.
        // Ini validasi ulang di server, jangan cuma andalkan filter dropdown di frontend.
        // Pakai parameter binding (?) untuk cegah SQL Injection.
        $harga = $db->query("
            SELECT harga_per_kg
            FROM harga_sampah
            WHERE jenis_sampah_id = ?
              AND CURDATE() BETWEEN berlaku_mulai AND berlaku_sampai
            ORDER BY berlaku_mulai DESC
            LIMIT 1
        ", [$jenis])->getRow();

        if (!$harga) {
            session()->setFlashdata('error', 'Jenis sampah ini sedang tidak tersedia (periode harga sudah berakhir). Silakan pilih jenis sampah lain atau hubungi admin.');
            return redirect()->back()->withInput();
        }

        $subtotal = $berat * $harga->harga_per_kg;

        $nasabah = $db->query("
            SELECT * FROM nasabah WHERE user_id = ?
        ", [session('id')])->getRow();

        if (!$nasabah) {
            session()->setFlashdata('error', 'Data nasabah tidak ditemukan.');
            return redirect()->back();
        }

        $db->table('pengajuan_setoran')->insert([
            'nasabah_id'      => $nasabah->id,
            'jenis_sampah_id' => $jenis,
            'berat'           => $berat,
            'harga_per_kg'    => $harga->harga_per_kg,
            'subtotal'        => $subtotal,
            'status'          => 'pending'
        ]);

        session()->setFlashdata('success', 'Pengajuan setoran berhasil dikirim, menunggu persetujuan petugas.');
        return redirect()->back();
    }
}
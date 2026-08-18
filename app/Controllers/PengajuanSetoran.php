<?php
namespace App\Controllers;

class PengajuanSetoran extends BaseController
{
    public function index()
    {
        $db = db_connect();
        $data['pengajuan'] = $db->table('pengajuan_setoran')
            ->select('pengajuan_setoran.*, nasabah.nama, jenis_sampah.nama_jenis')
            ->join('nasabah', 'nasabah.id = pengajuan_setoran.nasabah_id')
            ->join('jenis_sampah', 'jenis_sampah.id = pengajuan_setoran.jenis_sampah_id')
            ->orderBy('pengajuan_setoran.created_at', 'DESC')
            ->get()
            ->getResult();

        return view('petugas/pengajuan_setoran', $data);
    }

    public function setujui($id)
    {
        $db        = db_connect();
        $pengajuan = $db->table('pengajuan_setoran')->where('id', $id)->get()->getRow();

        if (!$pengajuan) {
            session()->setFlashdata('error', 'Data pengajuan tidak ditemukan!');
            return redirect()->to(base_url('pengajuan-setoran'));
        }

        // Cek sudah diproses sebelumnya
        if ($pengajuan->status !== 'pending') {
            session()->setFlashdata('error', 'Pengajuan ini sudah diproses sebelumnya!');
            return redirect()->to(base_url('pengajuan-setoran'));
        }

        $kode = 'STR' . date('YmdHis');

        // Simpan ke tabel penyetoran
        $db->table('penyetoran')->insert([
            'kode_transaksi' => $kode,
            'nasabah_id'     => $pengajuan->nasabah_id,
            'petugas_id'     => session('id'),
            'tanggal'        => date('Y-m-d'),
            'total_berat'    => $pengajuan->berat,
            'total_harga'    => $pengajuan->subtotal,
            'status'         => 'disetujui',
        ]);
        $penyetoranId = $db->insertID();

        // Simpan ke detail penyetoran
        $db->table('detail_penyetoran')->insert([
            'penyetoran_id'   => $penyetoranId,
            'jenis_sampah_id' => $pengajuan->jenis_sampah_id,
            'berat'           => $pengajuan->berat,
            'harga_per_kg'    => $pengajuan->harga_per_kg,
            'subtotal'        => $pengajuan->subtotal,
        ]);

        // Tambah saldo nasabah
        $db->query("UPDATE nasabah SET saldo = saldo + ? WHERE id = ?", [
            $pengajuan->subtotal,
            $pengajuan->nasabah_id,
        ]);

        // Update status pengajuan
        $db->table('pengajuan_setoran')->where('id', $id)->update(['status' => 'disetujui']);

        session()->setFlashdata('success', 'Pengajuan berhasil disetujui!');
        return redirect()->to(base_url('pengajuan-setoran'));
    }

    public function tolak($id)
    {
        $db        = db_connect();
        $pengajuan = $db->table('pengajuan_setoran')->where('id', $id)->get()->getRow();

        if (!$pengajuan) {
            session()->setFlashdata('error', 'Data pengajuan tidak ditemukan!');
            return redirect()->to(base_url('pengajuan-setoran'));
        }

        if ($pengajuan->status !== 'pending') {
            session()->setFlashdata('error', 'Pengajuan ini sudah diproses sebelumnya!');
            return redirect()->to(base_url('pengajuan-setoran'));
        }

        $db->table('pengajuan_setoran')->where('id', $id)->update(['status' => 'ditolak']);

        session()->setFlashdata('success', 'Pengajuan berhasil ditolak.');
        return redirect()->to(base_url('pengajuan-setoran'));
    }
}
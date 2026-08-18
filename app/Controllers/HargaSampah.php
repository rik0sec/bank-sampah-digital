<?php
namespace App\Controllers;
use App\Models\M_harga_sampah;

class HargaSampah extends BaseController
{
    protected $mhargasampah;

    function __construct()
    {
        $this->mhargasampah = new M_harga_sampah();
    }

    public function index(): string
    {
        $data['harga_sampah'] = $this->mhargasampah->list_all();
        return view('harga_sampah/list_harga_sampah', $data);
    }

    public function tambah()
    {
        $data['jenis_sampah'] = $this->mhargasampah->getJenisSampah();

        if ($_POST) {
            $dataPost["jenis_sampah_id"] = $this->request->getVar("jenis_sampah_id");
            $dataPost["harga_per_kg"]    = $this->request->getVar("harga_per_kg");
            $dataPost["berlaku_mulai"]   = $this->request->getVar("berlaku_mulai");
            $dataPost["berlaku_sampai"]  = $this->request->getVar("berlaku_sampai");

            $hasil = $this->mhargasampah->add($dataPost);

            if ($hasil == "success") {
                session()->setFlashdata('success', 'Harga sampah berhasil ditambahkan!');
            } else {
                // $hasil berisi pesan error spesifik (mis. validasi tanggal) atau "failed"
                $pesan = ($hasil == "failed") ? 'Gagal menambahkan harga sampah!' : $hasil;
                session()->setFlashdata('error', $pesan);
                return redirect()->back()->withInput();
            }
            return redirect()->to(base_url("harga-sampah"));
        }

        return view('harga_sampah/tambah_harga_sampah', $data);
    }

    public function edit($id)
    {
        $data['jenis_sampah'] = $this->mhargasampah->getJenisSampah();

        if ($_POST) {
            $jenis_sampah_id = $this->request->getVar("jenis_sampah_id");
            $harga_per_kg    = $this->request->getVar("harga_per_kg");
            $berlaku_mulai   = $this->request->getVar("berlaku_mulai");
            $berlaku_sampai  = $this->request->getVar("berlaku_sampai");

            $hasil = $this->mhargasampah->updateData($id, $jenis_sampah_id, $harga_per_kg, $berlaku_mulai, $berlaku_sampai);

            if ($hasil == "success") {
                session()->setFlashdata('success', 'Harga sampah berhasil diperbarui!');
            } else {
                // $hasil berisi pesan error spesifik (mis. validasi tanggal) atau pesan error DB
                session()->setFlashdata('error', $hasil);
                return redirect()->back()->withInput();
            }
            return redirect()->to(base_url("harga-sampah"));
        }

        $data["harga_sampah"] = $this->mhargasampah->getData($id);
        return view('harga_sampah/edit_harga_sampah', $data);
    }

    public function delete($id)
    {
        $this->mhargasampah->deleteData($id);
        session()->setFlashdata('success', 'Harga sampah berhasil dihapus!');
        return redirect()->to(base_url("harga-sampah"));
    }
}   
<?php
namespace App\Controllers;
use App\Models\M_jenis_sampah;

class JenisSampah extends BaseController
{
    protected $mjenissampah;

    function __construct()
    {
        $this->mjenissampah = new M_jenis_sampah();
    }

    public function index(): string
    {
        $data['jenis_sampah'] = $this->mjenissampah->list_all();
        return view('jenis_sampah/list_jenis_sampah', $data);
    }

    public function tambah()
    {
        if ($_POST) {
            $dataPost["kode_jenis"] = $this->request->getVar("kode_jenis");
            $dataPost["nama_jenis"] = $this->request->getVar("nama_jenis");
            $dataPost["kategori"]   = $this->request->getVar("kategori");
            $dataPost["deskripsi"]  = $this->request->getVar("deskripsi");

            $tambah = $this->mjenissampah->add($dataPost);

            if ($tambah == "success") {
                session()->setFlashdata('success', 'Jenis sampah berhasil ditambahkan!');
            } else {
                session()->setFlashdata('error', 'Gagal menambahkan jenis sampah!');
            }
            return redirect()->to(base_url("jenis-sampah"));
        }

        return view('jenis_sampah/tambah_jenis_sampah');
    }

    public function edit($id)
    {
        if ($_POST) {
            $kode_jenis = $this->request->getVar("kode_jenis");
            $nama_jenis = $this->request->getVar("nama_jenis");
            $kategori   = $this->request->getVar("kategori");
            $deskripsi  = $this->request->getVar("deskripsi");

            $update = $this->mjenissampah->updateData($id, $kode_jenis, $nama_jenis, $kategori, $deskripsi);

            if ($update == "success") {
                session()->setFlashdata('success', 'Jenis sampah berhasil diperbarui!');
            } else {
                session()->setFlashdata('error', 'Gagal memperbarui jenis sampah!');
            }
            return redirect()->to(base_url("jenis-sampah"));
        }

        $data["jenis_sampah"] = $this->mjenissampah->getData($id);
        return view('jenis_sampah/edit_jenis_sampah', $data);
    }

    public function delete($id)
    {
        $delete = $this->mjenissampah->deleteData($id);
        session()->setFlashdata('success', 'Jenis sampah berhasil dihapus!');
        return redirect()->to(base_url("jenis-sampah"));
    }
}
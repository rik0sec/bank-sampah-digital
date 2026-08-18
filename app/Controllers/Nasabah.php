<?php
namespace App\Controllers;
use App\Models\M_nasabah;

class Nasabah extends BaseController
{
    protected $mnasabah;

    function __construct()
    {
        $this->mnasabah = new M_nasabah();
    }

    public function index(): string
    {
        $data['nasabah'] = $this->mnasabah->list_all();
        return view('nasabah/list_nasabah', $data);
    }

    public function tambah()
    {
        if ($_POST) {
            $dataPost["user_id"]    = session('id') ?? 0;
            $dataPost["kode_nasabah"] = $this->request->getVar("kode_nasabah");
            $dataPost["nama"]       = $this->request->getVar("nama");
            $dataPost["alamat"]     = $this->request->getVar("alamat");
            $dataPost["no_telp"]    = $this->request->getVar("no_telp");
            $dataPost["email"]      = $this->request->getVar("email");
            $dataPost["saldo"]      = $this->request->getVar("saldo") ?? 0;
            $dataPost["created_at"] = date('Y-m-d H:i:s');
            $dataPost["updated_at"] = date('Y-m-d H:i:s');

            $tambah = $this->mnasabah->add($dataPost);

            if ($tambah == "success") {
                session()->setFlashdata('success', 'Nasabah berhasil ditambahkan!');
            } else {
                session()->setFlashdata('error', 'Gagal menambahkan nasabah!');
            }
            return redirect()->to(base_url("nasabah"));
        }

        return view('nasabah/tambah_nasabah');
    }

    public function edit($id)
    {
        if ($_POST) {
            $kode_nasabah = $this->request->getVar("kode_nasabah");
            $nama         = $this->request->getVar("nama");
            $alamat       = $this->request->getVar("alamat");
            $no_telp      = $this->request->getVar("no_telp");
            $email        = $this->request->getVar("email");
            $saldo        = $this->request->getVar("saldo") ?? 0;

            $update = $this->mnasabah->updateData($id, $kode_nasabah, $nama, $alamat, $no_telp, $email, $saldo);

            if ($update == "success") {
                session()->setFlashdata('success', 'Data nasabah berhasil diperbarui!');
            } else {
                session()->setFlashdata('error', 'Gagal memperbarui data nasabah!');
            }
            return redirect()->to(base_url("nasabah"));
        }

        $data["nasabah"] = $this->mnasabah->getData($id);
        return view('nasabah/edit_nasabah', $data);
    }

    public function delete($id)
    {
        $this->mnasabah->deleteData($id);
        session()->setFlashdata('success', 'Nasabah berhasil dihapus!');
        return redirect()->to(base_url("nasabah"));
    }
}
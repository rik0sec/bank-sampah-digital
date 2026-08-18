<?php

namespace App\Controllers;

use App\Models\M_buku;

class Buku extends BaseController
{
    protected $mbuku;

    function __construct()
    {
        $this->mbuku = new M_buku();
    }

    public function index(): string
    {
        $data['buku'] = $this->mbuku->list_all();
        return view('buku/list_buku', $data);
    }

    public function tambah()
    {
        if($_POST){

            $dataPost["nama_buku"] = $this->request->getVar("nama_buku");
            $dataPost["deskripsi_buku"] = $this->request->getVar("deskripsi_buku");
            $dataPost["harga_buku"] = $this->request->getVar("harga_buku");
            $dataPost["penulis_buku"] = $this->request->getVar("penulis_buku");
            $dataPost["penerbit_buku"] = $this->request->getVar("penerbit_buku");
            $dataPost["tahun_terbit"] = $this->request->getVar("tahun_terbit");

            $tambah = $this->mbuku->add($dataPost);
        }

        return view('buku/tambah_buku');
    }

    public function edit($idBuku)
    {
        if($_POST){

            $nama = $this->request->getVar("nama_buku");
            $desc = $this->request->getVar("deskripsi_buku");
            $harga = $this->request->getVar("harga_buku");
            $penulis = $this->request->getVar("penulis_buku");
            $penerbit = $this->request->getVar("penerbit_buku");
            $tahun = $this->request->getVar("tahun_terbit");

            $update = $this->mbuku->updateData(
                $idBuku,
                $nama,
                $desc,
                $harga,
                $penulis,
                $penerbit,
                $tahun
            );
        }

        $getData = $this->mbuku->getData($idBuku);

        $data["buku"] = $getData;

        return view('buku/edit_buku', $data);
    }

    public function delete($idBuku)
    {
        $delete = $this->mbuku->deleteData($idBuku);

        return redirect()->to(base_url("buku"));
    }
}
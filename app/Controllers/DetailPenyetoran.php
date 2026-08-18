<?php

namespace App\Controllers;

use App\Models\M_detail_penyetoran;

class DetailPenyetoran extends BaseController
{
    protected $mdetail;

    function __construct()
    {
        $this->mdetail = new M_detail_penyetoran();
    }

    public function index(): string
    {
        $data['detail_penyetoran'] = $this->mdetail->list_all();
        return view('detail_penyetoran/list_detail_penyetoran', $data);
    }

    public function tambah()
    {
        $data['jenis_sampah'] = $this->mdetail->getJenisSampah();
        $data['penyetoran'] = $this->mdetail->getPenyetoran();

        if ($_POST) {
            $dataPost["penyetoran_id"] = $this->request->getVar("penyetoran_id");
            $dataPost["jenis_sampah_id"] = $this->request->getVar("jenis_sampah_id");
            $dataPost["berat"] = $this->request->getVar("berat");
            $dataPost["harga_per_kg"] = $this->request->getVar("harga_per_kg");
            $dataPost["subtotal"] = $this->request->getVar("subtotal");

            $tambah = $this->mdetail->add($dataPost);
        }

        return view('detail_penyetoran/tambah_detail_penyetoran', $data);
    }

    public function edit($id)
    {
        $data['jenis_sampah'] = $this->mdetail->getJenisSampah();
        $data['penyetoran'] = $this->mdetail->getPenyetoran();

        if ($_POST) {
            $penyetoran_id = $this->request->getVar("penyetoran_id");
            $jenis_sampah_id = $this->request->getVar("jenis_sampah_id");
            $berat = $this->request->getVar("berat");
            $harga_per_kg = $this->request->getVar("harga_per_kg");
            $subtotal = $this->request->getVar("subtotal");

            $update = $this->mdetail->updateData(
                $id,
                $penyetoran_id,
                $jenis_sampah_id,
                $berat,
                $harga_per_kg,
                $subtotal
            );
        }

        $getData = $this->mdetail->getData($id);
        $data["detail"] = $getData;

        return view('detail_penyetoran/edit_detail_penyetoran', $data);
    }

    public function delete($id)
    {
        $delete = $this->mdetail->deleteData($id);
        return redirect()->to(base_url("detail-penyetoran"));
    }
}
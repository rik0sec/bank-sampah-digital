<?php

namespace App\Models;

use CodeIgniter\Model;

class M_jenis_sampah extends Model
{
    protected $table = "jenis_sampah";
    protected $primaryKey = "id";
    protected $orderBy = "nama_jenis";
    protected $orderByType = "asc";

    protected $dbs;

    function __construct()
    {
        parent::__construct();
        $this->dbs = \Config\Database::connect();
        $this->dbs = $this->dbs->table($this->table);
    }

    function list_all()
    {
        $this->dbs->orderBy($this->orderBy, $this->orderByType);
        $query = $this->dbs->get();
        return $query->getResult();
    }

    function add($data)
    {
        if ($this->dbs->insert($data)) {
            return "success";
        } else {
            return "failed";
        }
    }

    function getData($id)
    {
        $db = db_connect();
        $query = $db->query("SELECT * FROM jenis_sampah WHERE id='$id'; ");
        $respon = $query->getRow();
        return $respon;
    }

    function updateData($id, $kode_jenis, $nama_jenis, $kategori, $deskripsi)
    {
        $message = "";
        $db = db_connect();
        try {
            if (
                !$db->simpleQuery("
                UPDATE jenis_sampah 
                SET 
                    kode_jenis = '$kode_jenis',
                    nama_jenis = '$nama_jenis',
                    kategori = '$kategori',
                    deskripsi = '$deskripsi'
                WHERE id = '$id';
            ")
            ) {
                $message = $db->error();
            } else {
                $message = "success";
            }
        } catch (\Exception $e) {
            $message = $e->getMessage();
        }
        return $message;
    }

    function deleteData($id)
    {
        $message = "";
        $db = db_connect();
        try {
            if (!$db->simpleQuery("DELETE FROM jenis_sampah WHERE id = '$id'")) {
                $message = $db->error();
            } else {
                $message = "success";
            }
        } catch (\Exception $e) {
            $message = $e->getMessage();
        }
        return $message;
    }
}
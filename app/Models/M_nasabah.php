<?php

namespace App\Models;

use CodeIgniter\Model;

class M_nasabah extends Model
{
    protected $table = "nasabah";
    protected $primaryKey = "id";
    protected $orderBy = "nama";
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
        $query = $db->query("SELECT * FROM nasabah WHERE id='$id'; ");
        $respon = $query->getRow();
        return $respon;
    }

    function updateData($id, $kode_nasabah, $nama, $alamat, $no_telp, $email, $saldo)
    {
        $message = "";
        $db = db_connect();
        try {
            if (
                !$db->simpleQuery("
                UPDATE nasabah 
                SET 
                    kode_nasabah = '$kode_nasabah',
                    nama = '$nama',
                    alamat = '$alamat',
                    no_telp = '$no_telp',
                    email = '$email',
                    saldo = '$saldo'
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
            if (!$db->simpleQuery("DELETE FROM nasabah WHERE id = '$id'")) {
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
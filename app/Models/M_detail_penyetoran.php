<?php

namespace App\Models;

use CodeIgniter\Model;

class M_detail_penyetoran extends Model
{
    protected $table = "detail_penyetoran";
    protected $primaryKey = "id";
    protected $orderBy = "id";
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
        $this->dbs->select('detail_penyetoran.*, jenis_sampah.nama_jenis');
        $this->dbs->join('jenis_sampah', 'jenis_sampah.id = detail_penyetoran.jenis_sampah_id', 'left');
        $this->dbs->orderBy($this->orderBy, $this->orderByType);
        $query = $this->dbs->get();
        return $query->getResult();
    }

    function list_by_penyetoran($penyetoran_id)
    {
        $this->dbs->select('detail_penyetoran.*, jenis_sampah.nama_jenis');
        $this->dbs->join('jenis_sampah', 'jenis_sampah.id = detail_penyetoran.jenis_sampah_id', 'left');
        $this->dbs->where('detail_penyetoran.penyetoran_id', $penyetoran_id);
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
        $query = $db->query("
            SELECT detail_penyetoran.*, jenis_sampah.nama_jenis 
            FROM detail_penyetoran 
            LEFT JOIN jenis_sampah ON jenis_sampah.id = detail_penyetoran.jenis_sampah_id 
            WHERE detail_penyetoran.id='$id'
        ");
        $respon = $query->getRow();
        return $respon;
    }

    function updateData($id, $penyetoran_id, $jenis_sampah_id, $berat, $harga_per_kg, $subtotal)
    {
        $message = "";
        $db = db_connect();
        try {
            if (
                !$db->simpleQuery("
                UPDATE detail_penyetoran 
                SET 
                    penyetoran_id = '$penyetoran_id',
                    jenis_sampah_id = '$jenis_sampah_id',
                    berat = '$berat',
                    harga_per_kg = '$harga_per_kg',
                    subtotal = '$subtotal'
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
            if (!$db->simpleQuery("DELETE FROM detail_penyetoran WHERE id = '$id'")) {
                $message = $db->error();
            } else {
                $message = "success";
            }
        } catch (\Exception $e) {
            $message = $e->getMessage();
        }
        return $message;
    }

    function getJenisSampah()
    {
        $db = db_connect();
        $query = $db->query("SELECT id, nama_jenis FROM jenis_sampah ORDER BY nama_jenis ASC");
        return $query->getResult();
    }

    function getPenyetoran()
    {
        $db = db_connect();
        $query = $db->query("SELECT id, kode_transaksi FROM penyetoran ORDER BY id DESC");
        return $query->getResult();
    }
}
<?php

namespace App\Models;

use CodeIgniter\Model;

class M_penyetoran extends Model
{
    protected $table = "penyetoran";
    protected $primaryKey = "id";
    protected $orderBy = "id";
    protected $orderByType = "desc";

    protected $dbs;

    function __construct()
    {
        parent::__construct();
        $this->dbs = \Config\Database::connect();
        $this->dbs = $this->dbs->table($this->table);
    }

    function list_all()
    {
        $this->dbs->select('penyetoran.*, nasabah.nama as nama_nasabah');
        $this->dbs->join('nasabah', 'nasabah.id = penyetoran.nasabah_id', 'left');
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
        $query = $db->query("SELECT * FROM penyetoran WHERE id='$id'; ");
        $respon = $query->getRow();
        return $respon;
    }

    function updateData($id, $kode_transaksi, $nasabah_id, $tanggal, $total_berat, $total_harga, $status)
{
    $message = "";
    $db = db_connect();
    
    // Ambil petugas_id dari session user yang sedang login
    $petugas_id = session('id');
    
    try {
        if (!$db->simpleQuery("
            UPDATE penyetoran 
            SET 
                kode_transaksi = '$kode_transaksi',
                nasabah_id     = '$nasabah_id',
                tanggal        = '$tanggal',
                total_berat    = '$total_berat',
                total_harga    = '$total_harga',
                status         = '$status',
                petugas_id     = '$petugas_id'
            WHERE id = '$id';
        ")) {
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
            if (!$db->simpleQuery("DELETE FROM penyetoran WHERE id = '$id'")) {
                $message = $db->error();
            } else {
                $message = "success";
            }
        } catch (\Exception $e) {
            $message = $e->getMessage();
        }
        return $message;
    }

    function getNasabah()
    {
        $db = db_connect();
        $query = $db->query("SELECT id, nama FROM nasabah ORDER BY nama ASC");
        return $query->getResult();
    }

    function getDetail($penyetoran_id)
    {
        $db = db_connect();
        $query = $db->query("
            SELECT detail_penyetoran.*, jenis_sampah.nama_jenis 
            FROM detail_penyetoran 
            LEFT JOIN jenis_sampah ON jenis_sampah.id = detail_penyetoran.jenis_sampah_id 
            WHERE detail_penyetoran.penyetoran_id = '$penyetoran_id'
            ORDER BY detail_penyetoran.id ASC
        ");
        return $query->getResult();
    }

    function filterPeriode($dari = null, $sampai = null)
{
    $db = db_connect();
    $builder = $db->table('penyetoran');
    $builder->select('penyetoran.*, nasabah.nama as nama_nasabah');
    $builder->join('nasabah', 'nasabah.id = penyetoran.nasabah_id', 'left');

    if (!empty($dari)) {
        $builder->where('penyetoran.tanggal >=', $dari);
    }
    if (!empty($sampai)) {
        $builder->where('penyetoran.tanggal <=', $sampai);
    }

    $builder->orderBy('penyetoran.tanggal', 'desc');
    return $builder->get()->getResult();
}

}
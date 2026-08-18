<?php

namespace App\Models;

use CodeIgniter\Model;

class M_harga_sampah extends Model
{
    protected $table = "harga_sampah";
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
        $this->dbs->select('harga_sampah.*, jenis_sampah.nama_jenis');
        $this->dbs->join('jenis_sampah', 'jenis_sampah.id = harga_sampah.jenis_sampah_id', 'left');
        $this->dbs->orderBy($this->orderBy, $this->orderByType);
        $query = $this->dbs->get();
        return $query->getResult();
    }

    /**
     * Validasi: tanggal "berlaku_mulai" wajib <= "berlaku_sampai".
     * Kembalikan null kalau valid, atau pesan error kalau tidak valid.
     */
    private function validasiPeriode($berlaku_mulai, $berlaku_sampai)
    {
        if (empty($berlaku_mulai)) {
            return "Tanggal mulai wajib diisi.";
        }

        // berlaku_sampai boleh kosong (artinya berlaku selamanya), skip cek kalau kosong
        if (!empty($berlaku_sampai) && strtotime($berlaku_sampai) < strtotime($berlaku_mulai)) {
            return "Tanggal berakhir tidak boleh sebelum tanggal mulai.";
        }

        return null;
    }

    function add($data)
    {
        $error = $this->validasiPeriode($data['berlaku_mulai'] ?? null, $data['berlaku_sampai'] ?? null);
        if ($error) {
            return $error;
        }

        if ($this->dbs->insert($data)) {
            return "success";
        } else {
            return "failed";
        }
    }

    function getData($id)
    {
        $db = db_connect();
        $query = $db->query("SELECT * FROM harga_sampah WHERE id = ?", [$id]);
        return $query->getRow();
    }

    function updateData($id, $jenis_sampah_id, $harga_per_kg, $berlaku_mulai, $berlaku_sampai)
    {
        $error = $this->validasiPeriode($berlaku_mulai, $berlaku_sampai);
        if ($error) {
            return $error;
        }

        $db = db_connect();
        try {
            $ok = $db->query("
                UPDATE harga_sampah
                SET
                    jenis_sampah_id = ?,
                    harga_per_kg = ?,
                    berlaku_mulai = ?,
                    berlaku_sampai = ?
                WHERE id = ?
            ", [$jenis_sampah_id, $harga_per_kg, $berlaku_mulai, $berlaku_sampai, $id]);

            return $ok ? "success" : $db->error()['message'];
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    function deleteData($id)
    {
        $db = db_connect();
        try {
            $ok = $db->query("DELETE FROM harga_sampah WHERE id = ?", [$id]);
            return $ok ? "success" : $db->error()['message'];
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    function getJenisSampah()
    {
        $db = db_connect();
        $query = $db->query("SELECT id, nama_jenis FROM jenis_sampah ORDER BY nama_jenis ASC");
        return $query->getResult();
    }
}
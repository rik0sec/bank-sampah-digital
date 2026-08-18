<?php

namespace App\Models;

use CodeIgniter\Model;

class M_users extends Model
{
    protected $table = "users";
    protected $primaryKey = "id";
    protected $orderBy = "nama_lengkap";
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
        $query = $db->query("SELECT * FROM users WHERE id='$id'; ");
        $respon = $query->getRow();
        return $respon;
    }

    function login_user($username)
    {
        $db = db_connect();
        $query = $db->query("SELECT * FROM users WHERE username = ?", [$username]);
        return $query->getRow();
    }

    function updateData($id, $username, $password, $nama_lengkap, $role, $alamat)
    {
        $message = "";
        $db = db_connect();
        try {
            if (!empty($password)) {
                if (
                    !$db->simpleQuery("
                    UPDATE users 
                    SET 
                        username = '$username',
                        password = '$password',
                        nama_lengkap = '$nama_lengkap',
                        alamat = '$alamat',
                        role = '$role'
                    WHERE id = '$id';
                ")
                ) {
                    $message = $db->error();
                } else {
                    $message = "success";
                }
            } else {
                if (
                    !$db->simpleQuery("
                    UPDATE users 
                    SET 
                        username = '$username',
                        nama_lengkap = '$nama_lengkap',
                        alamat = '$alamat',
                        role = '$role'
                    WHERE id = '$id';
                ")
                ) {
                    $message = $db->error();
                } else {
                    $message = "success";
                }
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
            if (!$db->simpleQuery("DELETE FROM users WHERE id = '$id'")) {
                $message = $db->error();
            } else {
                $message = "success";
            }
        } catch (\Exception $e) {
            $message = $e->getMessage();
        }
        return $message;
    }

    function updateLastLogin($id, $device)
{
    $db = db_connect();
    $db->query("UPDATE users SET last_login = NOW(), last_device = ? WHERE id = ?", [$device, $id]);
}

function updateProfil($id, $data)
{
    $db = db_connect();
    return $db->table($this->table)->where('id', $id)->update($data);
}

function updatePasswordOnly($id, $passwordHash)
{
    $db = db_connect();
    return $db->table($this->table)->where('id', $id)->update(['password' => $passwordHash]);
}



}
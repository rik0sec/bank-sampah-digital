<?php

namespace App\Models;

use CodeIgniter\Model;

class M_register extends Model
{
    protected $table = "users";
    protected $primaryKey = "id";
    protected $allowedFields = [
        'username', 'password', 'nama_lengkap', 'role', 'foto',
        'email', 'no_telp', 'is_verified', 'otp_code', 'otp_expires',
        'created_at', 'updated_at'
    ];

    protected $dbs;

    function __construct()
    {
        parent::__construct();
        $this->dbs = \Config\Database::connect();
    }

    public function register($data)
{
    $db = db_connect();

    $db->table('users')->insert([
        'username'      => $data['username'],
        'password'      => $data['password'],
        'nama_lengkap'  => $data['nama_lengkap'],
        'role'          => $data['role'],
        'email'         => $data['email'],
        'no_telp'       => $data['no_telp'],
        'is_verified'   => 0,
        'otp_code'      => $data['otp_code'],
        'otp_expires'   => $data['otp_expires']
    ]);

    $userId = $db->insertID();

    $kodeNasabah = 'NSB-' . str_pad($userId, 3, '0', STR_PAD_LEFT);

    $db->table('nasabah')->insert([
        'user_id'       => $userId,
        'kode_nasabah'  => $kodeNasabah,
        'nama'          => $data['nama_lengkap'],
        'alamat'        => '',
        'no_telp'       => $data['no_telp'],
        'email'         => $data['email'],
        'saldo'         => 0
    ]);

    return true;
}

    public function getPendingRegistrations()
    {
        $db = db_connect();
        $query = $db->query("SELECT * FROM users WHERE is_verified = 0 ORDER BY created_at DESC");
        return $query->getResult();
    }

    public function getUserByEmail($email)
    {
        $db = db_connect();
        $query = $db->query("SELECT * FROM users WHERE email = ?", [$email]);
        return $query->getRow();
    }

    public function updateOTP($id, $otpCode, $otpExpires)
    {
        $db = db_connect();
        $sql = "UPDATE users SET otp_code = ?, otp_expires = ?, updated_at = ? WHERE id = ?";
        $bind = [$otpCode, $otpExpires, date('Y-m-d H:i:s'), $id];
        return $db->query($sql, $bind);
    }

    public function verifyUserByOTP($otpCode)
    {
        $db = db_connect();
        $query = $db->query("SELECT * FROM users WHERE otp_code = ? AND is_verified = 0 AND otp_expires > NOW()", [$otpCode]);
        return $query->getRow();
    }

    public function activateUser($id)
    {
        $db = db_connect();
        $sql = "UPDATE users SET is_verified = 1, otp_code = NULL, otp_expires = NULL, updated_at = ? WHERE id = ?";
        $bind = [date('Y-m-d H:i:s'), $id];
        return $db->query($sql, $bind);
    }

    public function getUserById($id)
    {
        $db = db_connect();
        $query = $db->query("SELECT * FROM users WHERE id = ?", [$id]);
        return $query->getRow();
    }

    public function isUsernameExist($username)
    {
        $db = db_connect();
        $query = $db->query("SELECT COUNT(*) as total FROM users WHERE username = ?", [$username]);
        return $query->getRow()->total > 0;
    }

    public function isEmailExist($email)
    {
        $db = db_connect();
        $query = $db->query("SELECT COUNT(*) as total FROM users WHERE email = ?", [$email]);
        return $query->getRow()->total > 0;
    }
}

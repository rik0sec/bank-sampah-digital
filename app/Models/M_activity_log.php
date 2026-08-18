<?php
namespace App\Models;
use CodeIgniter\Model;

class M_activity_log extends Model
{
    protected $table = 'activity_logs';
    protected $primaryKey = 'id';

    function catat($userId, $activity, $description = null)
    {
        $db = db_connect();
        $db->table($this->table)->insert([
            'user_id'     => $userId,
            'activity'    => $activity,
            'description' => $description,
            'ip_address'  => service('request')->getIPAddress(),
            'created_at'  => date('Y-m-d H:i:s'),
        ]);
    }

    function getByUser($userId, $limit = 10)
    {
        $db = db_connect();
        return $db->table($this->table)
            ->where('user_id', $userId)
            ->orderBy('created_at', 'DESC')
            ->limit($limit)
            ->get()
            ->getResult();
    }
}
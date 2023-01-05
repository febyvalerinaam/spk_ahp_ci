<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'users';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function tampil()
    {
        $query = $this->db->table('user')->get();
        return $query->getResult();
    }

    public function getTotal()
    {
        return $this->db->table('user')->countAll();
    }

    public function insertt($data = [])
    {
        $result = $this->db->table('user')->insert($data);
        return $result;
    }

    public function show($id_user)
    {
        $query = $this->db->table('user')
            ->where('id_user', $id_user)->get();
        return $query->getRow();
    }

    public function updatee($id_user, $data = [])
    {
        $ubah = array(
            'id_user_level' => $data['id_user_level'],
            'email' => $data['email'],
            'nama'  => $data['nama'],
            'username'  => $data['username'],
            'password'  => $data['password']
        );

        $this->db->table('user')
            ->where('id_user', $id_user)
            ->update($ubah);
    }

    public function deletee($id_user)
    {
        $this->db
            ->table('user')
            ->where('id_user', $id_user)
            ->delete();
    }

    public function get_user()
    {
        $query = $this->db->table('user')->get();
        return $query->getResult();
    }
    public function user_level()
    {
        $query = $this->db->table('user_level')->get();
        return $query->getResult();
    }
}

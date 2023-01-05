<?php

namespace App\Models;

use CodeIgniter\Model;
use http\QueryString;

class AlternatifModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'alternatif';
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

    public function tampil(){
        $query = $this->db->table('alternatif')->get();
        return $query->getResult();
    }
    public function getTotal()
    {
        return $this->db->table('alternatif')->get();
    }

    public function insertt($data = [])
    {
        $result = $this->db->table('alternatif')->insert($data);
        return $result;
    }

    public function show($id_alternatif)
    {
        $query = $this->db->table('alternatif')->where('id_alternatif', $id_alternatif);
        return $query->get()->getRow();
    }

    public function updatee($id_alternatif, $data = [])
    {
        $ubah = array(
            'nama'  => $data['nama']
        );

        $this->db->table('alternatif')
            ->where('id_alternatif', $id_alternatif)
            ->update($data);
    }

    public function deletee($id_alternatif)
    {
        $this->db->table('alternatif')
            ->where('id_alternatif', $id_alternatif)
            ->delete();
    }
}

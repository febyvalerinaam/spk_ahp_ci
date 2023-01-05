<?php

namespace App\Models;

use CodeIgniter\Model;

class KategoriModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'nilai_kategori';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['nama_nilai'];

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
        $query = $this->db->table('nilai_kategori')->get();
        return $query->getResult();
    }

    public function insertt($data = [])
    {
        $nama = $data['nama_nilai'];
        $result = $this->db->query("INSERT INTO nilai_kategori(nama_nilai) VALUES ('$nama')");
        return $result;
    }

    public function show($id_nilai)
    {
        $query = $this->db->table('nilai_kategori')
            ->where('id_nilai', $id_nilai)->get();
        return $query->getRow();
    }

    public function updatee($id_nilai, $data = [])
    {
        $ubah = array(
            'nama_nilai'  => $data['nama_nilai']
        );


        $this->db->table('nilai_kategori')
            ->where('id_nilai', $id_nilai)
            ->update($ubah);
    }


    public function deletee($id_nilai)
    {
        $this->db->table('nilai_kategori')
            ->where('id_nilai', $id_nilai)
            ->delete();
    }
}

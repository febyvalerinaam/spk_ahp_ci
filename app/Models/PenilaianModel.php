<?php

namespace App\Models;

use CodeIgniter\Model;

class PenilaianModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'penilaian';
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

    public function tambah_penilaian($id_alternatif,$id_kriteria,$id_sub_kriteria)
    {
        $query = $this->db->query("INSERT INTO penilaian VALUES (DEFAULT,'$id_alternatif','$id_kriteria',$id_sub_kriteria);");
        return $query;
    }

    public function edit_penilaian($id_alternatif,$id_kriteria,$id_sub_kriteria)
    {
        $query = $this->db->query("UPDATE penilaian SET id_sub_kriteria=$id_sub_kriteria WHERE id_alternatif='$id_alternatif' AND id_kriteria='$id_kriteria';");
        return $query;
    }

    public function deletee($id_penilaian)
    {
        $this->db->table('penilaian')
            ->where('id_penilaian', $id_penilaian)
            ->delete();
    }

    public function get_kriteria()
    {
        $query = $this->db->table('kriteria')->get();
        return $query->getResult();
    }

    public function get_alternatif()
    {
        $query = $this->db->query("SELECT * FROM alternatif");
        return $query->getResult();
    }

    public function data_penilaian($id_alternatif,$id_kriteria)
    {
        $query = $this->db->query("SELECT * FROM penilaian WHERE id_alternatif='$id_alternatif' AND id_kriteria='$id_kriteria';");
        return $query->getRowArray();
    }

    public function untuk_tombol($id_alternatif)
    {
        $query = $this->db->query("SELECT * FROM penilaian WHERE id_alternatif='$id_alternatif';");
        return $query->getNumRows();
    }

    public function data_sub_kriteria($id_kriteria)
    {
        $query = $this->db->query("SELECT * FROM sub_kriteria JOIN nilai_kategori ON sub_kriteria.id_nilai=nilai_kategori.id_nilai WHERE sub_kriteria.id_kriteria='$id_kriteria' ORDER BY sub_kriteria.id_nilai ASC;");
        return $query->getResultArray();
    }
}

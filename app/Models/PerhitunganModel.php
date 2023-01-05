<?php

namespace App\Models;

use CodeIgniter\Model;

class PerhitunganModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'perhitungans';
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

    public function get_kriteria()
    {
        $query = $this->db->query("SELECT * FROM kriteria JOIN kriteria_hasil ON kriteria.id_kriteria=kriteria_hasil.id_kriteria;");
        return $query->getResult();
    }

    public function get_alternatif()
    {
        $query = $this->db->table('alternatif')->get();
        return $query->getResult();
    }

    public function get_sub_kriteria($id_kriteria)
    {
        $query = $this->db->query("SELECT * FROM sub_kriteria WHERE id_kriteria='$id_kriteria';");
        return $query->getResult();
    }

    public function get_nilai_kategori()
    {
        $query = $this->db->table('nilai_kategori')->get();
        return $query->getResult();
    }

    public function prioritas_subkrit($id_nilai,$id_kriteria,$id_sub_kriteria)
    {
        $query = $this->db->query("SELECT * FROM sub_kriteria_hasil JOIN sub_kriteria ON sub_kriteria_hasil.id_sub_kriteria=sub_kriteria.id_sub_kriteria JOIN nilai_kategori ON sub_kriteria.id_nilai=nilai_kategori.id_nilai WHERE sub_kriteria_hasil.id_kriteria='$id_kriteria' AND sub_kriteria_hasil.id_sub_kriteria='$id_sub_kriteria' AND nilai_kategori.id_nilai='$id_nilai'");
        return $query->getRowArray();
    }

    public function data_nilai($id_alternatif,$id_kriteria)
    {
        $query = $this->db->query("SELECT * FROM penilaian JOIN sub_kriteria ON penilaian.id_sub_kriteria=sub_kriteria.id_sub_kriteria JOIN nilai_kategori ON sub_kriteria.id_nilai=nilai_kategori.id_nilai JOIN sub_kriteria_hasil ON penilaian.id_sub_kriteria=sub_kriteria_hasil.id_sub_kriteria WHERE penilaian.id_alternatif='$id_alternatif' AND penilaian.id_kriteria='$id_kriteria';");
        return $query->getRowArray();
    }

    public function nilai_subkrit($id_kriteria,$id_sub_kriteria)
    {
        $query = $this->db->query("SELECT * FROM sub_kriteria_hasil JOIN sub_kriteria ON sub_kriteria_hasil.id_sub_kriteria=sub_kriteria.id_sub_kriteria  WHERE sub_kriteria_hasil.id_kriteria='$id_kriteria' AND sub_kriteria_hasil.id_sub_kriteria='$id_sub_kriteria'");
        return $query->getRowArray();
    }

    public function insert_hasil($hasil_akhir = [])
    {
        $result = $this->db->table('hasil')
            ->insert($hasil_akhir);
        return $result;
    }

    public function hapus_hasil()
    {
        $query = $this->db->query("TRUNCATE TABLE hasil;");
        return $query;
    }

    public function get_hasil()
    {
        $query = $this->db->query("SELECT * FROM hasil ORDER BY nilai DESC;");
        return $query->getResult();
    }

    public function get_hasil_alternatif($id_alternatif)
    {
        $query = $this->db->query("SELECT * FROM alternatif WHERE id_alternatif='$id_alternatif';");
        return $query->getRowArray();
    }
}

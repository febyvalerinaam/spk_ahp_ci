<?php

namespace App\Models;

use CodeIgniter\Model;

class SubKriteriaModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'subkriterias';
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
        $query = $this->db->table('sub_kriteria')->get();
        return $query->getResult();
    }

    public function tambah_perioritas($id_kriteria,$id_sub_kriteria,$perioritas)
    {
        $query = $this->db->query("INSERT INTO sub_kriteria_hasil VALUES (DEFAULT,'$id_kriteria','$id_sub_kriteria','$perioritas');");
        return $query;
    }

    public function hapus_perioritas($id_kriteria)
    {
        $this->db->table('sub_kriteria_hasil')
            ->where('id_kriteria', $id_kriteria)
            ->delete();
    }

    public function nilai()
    {
        $query = $this->db->table('nilai_kategori')->get();
        return $query->getResult();
    }

    public function getTotal()
    {
        return $this->db->table('sub_kriteria')->countAll();
    }

    public function insertt($data = [])
    {
        $result = $this->db->table('sub_kriteria')
            ->insert($data);
        return $result;
    }

    public function show($id_sub_kriteria)
    {
        $query = $this->db->table('sub_kriteria')
            ->where('id_sub_kriteria', $id_sub_kriteria)->get();
        return $query->getRow();
    }

    public function updatee($id_sub_kriteria, $data = [])
    {
        $ubah = array(
            'id_kriteria' => $data['id_kriteria'],
            'nama_sub_kriteria' => $data['nama_sub_kriteria'],
            'id_nilai'  => $data['id_nilai']
        );

        $this->db->table('sub_kriteria')
            ->where('id_sub_kriteria', $id_sub_kriteria)
            ->update($ubah);
    }

    public function deletee($id_sub_kriteria)
    {
        $this->db->table('sub_kriteria')
            ->where('id_sub_kriteria', $id_sub_kriteria)
            ->delete();
    }

    public function get_kriteria()
    {
        $query = $this->db->table('kriteria')->get();
        return $query->getResult();
    }

    public function count_kriteria(){
        $query =  $this->db->query("SELECT id_kriteria,COUNT(nama_sub_kriteria) AS jml_setoran FROM sub_kriteria GROUP BY id_kriteria")->getResult();
        return $query;
    }

    public function data_sub_kriteria($id_kriteria)
    {
        $query = $this->db->query("SELECT * FROM sub_kriteria JOIN nilai_kategori ON sub_kriteria.id_nilai=nilai_kategori.id_nilai WHERE sub_kriteria.id_kriteria='$id_kriteria' ORDER BY sub_kriteria.id_nilai ASC;");
        return $query->getResultArray();
    }

    public function kriteria_info($id_kriteria)
    {
        $query = $this->db->query("SELECT nama_kriteria FROM kriteria WHERE id_kriteria='$id_kriteria';");
        return $query->getRowArray();
    }

    public function subkriteria_child($id_kriteria)
    {
        $query = $this->db->query("SELECT * FROM sub_kriteria WHERE id_kriteria='$id_kriteria' ORDER BY id_nilai ASC;");
        return $query->getResultArray();
    }

    function ambil_nilai_subkriteria($kriteriaid,$dari,$tujuan)
    {
        $huhu = $this->db->table('subkriteria_nilai')
            ->where('id_kriteria', $kriteriaid)
            ->where('subkriteria_id_dari', $dari)
            ->where('subkriteria_id_tujuan', $tujuan)
            ->get()->getRow();
//        $item=$CI->m_db->get_row('kriteria_nilai',$s,'nilai');
        var_dump($huhu);
        return $huhu->nilai;
    }

    function field_value($table,$key,$keyval,$output)
    {
        $s=array(
            $key=>$keyval,
        );
//        $item=$CI->m_db->get_row($table,$s,$output);
        $item = $this->db->table($table)
            ->where($key, $keyval)
            ->get()->getRow();
//        dd($item);
        return $item->nama_nilai;
    }
}

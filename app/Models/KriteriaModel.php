<?php

namespace App\Models;

use CodeIgniter\Model;

class KriteriaModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'kriterias';
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
        $query = $this->db->table('kriteria')->get();
        return $query->getResult();
    }

    public function tambah_perioritas($id_kriteria,$perioritas)
    {
        $query = $this->db->query("INSERT INTO kriteria_hasil VALUES (DEFAULT,'$id_kriteria','$perioritas');");
        return $query;
    }

    public function getTotal()
    {
        return $this->db->table('kriteria')->countAll();
    }

    public function insertt($data = [])
    {
        $result = $this->db->table('kriteria')
            ->insert($data);
        return $result;
    }

    public function inserttt($data = [])
    {
        $result = $this->db->table('kriteria_nilai')
            ->insert($data);
        return $result;
    }

    public function show($id_kriteria)
    {
        $query = $this->db->table('kriteria')
            ->where('id_kriteria', $id_kriteria)->get();
        return $query->getRow();
    }

    public function updatee($id_kriteria, $data = [])
    {
        $ubah = array(
            'nama_kriteria' => $data['nama_kriteria'],
            'kode_kriteria' => $data['kode_kriteria']
        );

        $this->db->table('kriteria')
            ->where('id_kriteria', $id_kriteria)
            ->update($ubah);
    }

    public function deletee($id_kriteria)
    {
        $this->db->table('kriteria')
            ->where('id_kriteria', $id_kriteria)
            ->delete();
    }

    function ambil_nilai_kriteria($dari,$tujuan)
    {
        $huhu = $this->db->table('kriteria_nilai')
            ->where('kriteria_id_dari', $dari)
            ->where('kriteria_id_tujuan', $tujuan)
            ->get()->getRow();
//        $item=$CI->m_db->get_row('kriteria_nilai',$s,'nilai');
        return $huhu ? $huhu->nilai : 0;
    }

    function add_row($table,$data=array()){

        if(empty($table)){
            //
        }else{
            if(!empty($data))
            {
                return 'okee';
                $this->db->table($table)->insert($data);
                if($this->db->affectedRows()>0){
                    return true;
                }else{
                    return false;
                }

            }else{
                return false;
            }
        }
    }

    function delete_row(){
        $this->db->table('kriteria_nilai')
            ->where('id_kriteria_nilai !=','',true)->delete();
    }

}

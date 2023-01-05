<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KategoriModel;
use App\Models\KriteriaModel;
use App\Models\SubKriteriaModel;
use CodeIgniter\Database\Database;
use Config\Services;

class Kriteria extends BaseController
{
    public function __construct()
    {
        $this->form_validation = Services::validation();
        $this->Kriteria_model = new KriteriaModel();
        $this->m_db = new KriteriaModel();

        if (session('user_data')['id_user_level'] != "1") {
            ?>
            <script type="text/javascript">
                alert('Anda tidak berhak mengakses halaman ini!');
                window.location='<?php echo base_url("Login/home"); ?>'
            </script>
            <?php
        }
    }

    public function index()
    {
        $data['page'] = "Kriteria";
        $data['list'] = $this->Kriteria_model->tampil();
//        dd($data['list']);
        echo view('kriteria/index', $data);
    }
    function gethtml()
    {
        $output=array();
        $outputs=array();
        $dKriteria=$this->Kriteria_model->tampil();
        foreach($dKriteria as $rK)
        {
            $output[$rK->id_kriteria]=$rK->nama_kriteria;
            $outputs[$rK->id_kriteria]=$rK->id_kriteria;
        }
        $d['arr']=$output;
        $d['arrs']=$outputs;
        echo view('kriteria/matrikutama', $d);
    }

    function updateutama()
    {
        $error=FALSE;
        $msg="";
        $s=array(
            'id_kriteria_nilai !='=>''
        );
//        $this->m_db->delete_row('kriteria_nilai',$s);

        $this->Kriteria_model->delete_row();
        $cr=$this->request->getGet('crvalue');
//        dd($cr);
        if($cr > 0.01)
        {
            $msg="Gagal diupdate karena nilai CR kurang dari 0.01";
            $error=TRUE;
        }else{
            foreach($_GET as $k=>$v)
            {
                if($k!="crvalue" )
                {
                    foreach($v as $x=>$x2)
                    {
                        $d=array(
                            'kriteria_id_dari'=>$k,
                            'kriteria_id_tujuan'=>$x,
                            'nilai'=>$x2,
                        );
//                        $this->m_db->add_row('kriteria_nilai',$d);
                        $this->Kriteria_model->inserttt($d);
                    }
                }
            }
            $msg="Berhasil update nilai kriteria";
            $error=FALSE;
        }


        if($error==FALSE)
        {
            echo json_encode(array('status'=>'ok','msg'=>$msg));
        }else{
            echo json_encode(array('status'=>'no','msg'=>$msg));
        }

    }

    public function simpan_prioritas()
    {
        $s=array(
            'id_kriteria_hasil !='=>''
        );
        $this->m_db->delete_row('kriteria_hasil',$s);

        $id_kriteria = $this->request->getPost('id_kriteria');
        $perioritas = $this->request->getPost('perioritas');
        $i = 0;
        var_dump($perioritas);
        foreach ($perioritas as $key) {
            $this->Kriteria_model->tambah_perioritas($id_kriteria[$i],$key);
            $i++;
        }
        session()->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil disimpan!</div>');
        redirect('Kriteria');
    }

    //menampilkan view create
    public function create()
    {
        $data['page'] = "Kriteria";
        echo view('kriteria/create', $data);
    }

    //menambahkan data ke database
    public function store()
    {
        $data = [
            'nama_kriteria' => $this->request->getPost('nama_kriteria'),
            'kode_kriteria' => $this->request->getPost('kode_kriteria')
        ];

//        $this->form_validation->set_rules('nama_kriteria', 'Nama', 'required');
//        $this->form_validation->set_rules('kode_kriteria', 'Kode Kriteria', 'required');


//        if ($this->form_validation->run() != false) {
            $result = $this->Kriteria_model->insertt($data);
            if ($result) {
                session()->setFlashdata('message', '<div class="alert alert-success" role="alert">Data berhasil disimpan!</div>');
                return redirect()->to('Kriteria');
//            }
//        } else {
//            session()->set_flashdata('message', '<div class="alert alert-danger" role="alert">Data gagal disimpan!</div>');
//            redirect('Kriteria/create');
//
        }


    }

    public function edit($id_kriteria)
    {
        $data['page'] = "Kriteria";
        $data['kriteria'] = $this->Kriteria_model->show($id_kriteria);
        echo view('kriteria/edit', $data);
    }

    public function update($id_kriteria)
    {
        // TODO: implementasi update data berdasarkan $id_kriteria
        $id_kriteria = $this->request->getPost('id_kriteria');
        $data = array(
            'nama_kriteria' => $this->request->getPost('nama_kriteria'),
            'kode_kriteria' => $this->request->getPost('kode_kriteria')
        );

        $this->Kriteria_model->updatee($id_kriteria, $data);
        session()->setFlashdata('message', '<div class="alert alert-success" role="alert">Data berhasil diupdate!</div>');
        return redirect()->to('Kriteria');
    }

    public function destroy($id_kriteria)
    {
        $this->Kriteria_model->deletee($id_kriteria);
        session()->setFlashdata('message', '<div class="alert alert-success" role="alert">Data berhasil dihapus!</div>');
        return redirect()->to('Kriteria');
    }


}

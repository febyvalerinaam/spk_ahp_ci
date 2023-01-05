<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PenilaianModel;
use Config\Services;

class Penilaian extends BaseController
{
    public function __construct()
    {
        $this->form_validation = Services::validation();
        $this->Penilaian_model = new PenilaianModel();

        if (session()->get('user_data')['id_user_level'] != "1") {
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
        $data = [
            'page' => "Penilaian",
            'kriteria'=> $this->Penilaian_model->get_kriteria(),
            'alternatif'=> $this->Penilaian_model->get_alternatif()
        ];
        echo view('penilaian/index', $data);
    }


    public function tambah_penilaian()
    {
        $id_alternatif = $this->request->getPost('id_alternatif');
        $id_kriteria = $this->request->getPost('id_kriteria');
        $id_sub_kriteria = $this->request->getPost('id_sub_kriteria');
        $i = 0;
        var_dump($id_sub_kriteria);
        foreach ($id_sub_kriteria as $key) {
            $this->Penilaian_model->tambah_penilaian($id_alternatif,$id_kriteria[$i],$key);
            $i++;
        }
        session()->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil disimpan!</div>');
        redirect('penilaian');
    }

    public function update_penilaian()
    {
        $id_alternatif = $this->request->getPost('id_alternatif');
        $id_kriteria = $this->request->getPost('id_kriteria');
        $id_sub_kriteria = $this->request->getPost('id_sub_kriteria');
        $i = 0;

        foreach ($id_sub_kriteria as $key) {
            $cek = $this->Penilaian_model->data_penilaian($id_alternatif,$id_kriteria[$i]);
            if ($cek==0) {
                $this->Penilaian_model->tambah_penilaian($id_alternatif,$id_kriteria[$i],$key);
            } else {
                $this->Penilaian_model->edit_penilaian($id_alternatif,$id_kriteria[$i],$key);
            }
            $i++;
        }
        session()->setFlashdata('message', '<div class="alert alert-success" role="alert">Data berhasil diupdate!</div>');
        return redirect()->to('Penilaian');
    }
}

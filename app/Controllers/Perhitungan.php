<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PerhitunganModel;
use Config\Database;
use Config\Services;

class Perhitungan extends BaseController
{
    public function __construct()
    {
        $this->form_validation = Services::validation();
        $this->Perhitungan_model = new PerhitunganModel();
        $this->M_db = new Database();
    }

    public function index()
    {
        if (session()->get('user_data')['id_user_level'] != "1") {
            ?>
            <script type="text/javascript">
                alert('Anda tidak berhak mengakses halaman ini!');
                window.location='<?php echo base_url("Login/home"); ?>'
            </script>
            <?php
        }
        $data = [
            'page' => "Perhitungan",
            'kriteria'=> $this->Perhitungan_model->get_kriteria(),
            'nilai_kategori'=> $this->Perhitungan_model->get_nilai_kategori(),
            'alternatif'=> $this->Perhitungan_model->get_alternatif(),
        ];

        echo view('perhitungan/perhitungan', $data);
    }

    public function hasil()
    {
        $data = [
            'page' => "Hasil",
            'hasil'=> $this->Perhitungan_model->get_hasil()
        ];

        echo view('perhitungan/hasil', $data);
    }

}

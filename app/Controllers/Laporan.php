<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PerhitunganModel;

class Laporan extends BaseController
{
    public function __construct()
    {
        $this->Perhitungan_model = new PerhitunganModel();
    }

    public function index()
    {
        $data = [
            'hasil'=> $this->Perhitungan_model->get_hasil()
        ];

        echo view('laporan', $data);
    }
}

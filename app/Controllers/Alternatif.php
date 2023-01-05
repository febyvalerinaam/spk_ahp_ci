<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AlternatifModel;

class Alternatif extends BaseController
{

    public function __construct()
    {
        $this->Alternatif_model = new AlternatifModel();

        if( session()->get('user_data')['id_user_level'] != '1'){
            echo "<script type=\"text/javascript\">
                    alert('Anda tidak berhak mengakses halaman ini!');
                    window.location='<?php echo base_url(\"Login/home\"); ?>'
                </script>";
        }
    }

    public function index()
    {
        $data = [
            'page' => "Alternatif",
            'list' => $this->Alternatif_model->tampil(),

        ];
        echo view('alternatif/index', $data);
    }

    //menampilkan view create
    public function create()
    {
        $data['page'] = "Alternatif";
        echo view('alternatif/create',$data);
    }

    public function store()
    {
        $data = [
            'nama' => $this->request->getPost('nama'),
        ];

        $result = $this->Alternatif_model->insertt($data);
        if ($result) {
            session()->setFlashdata('message', '<div class="alert alert-success" role="alert">Data berhasil disimpan!</div>');
            return redirect()->to('Alternatif');
        }
    }

    public function edit($id_alternatif)
    {
        $alternatif = $this->Alternatif_model->show($id_alternatif);
        $data = [
            'page' => "Alternatif",
            'alternatif' => $alternatif
        ];
        echo view('alternatif/edit', $data);
    }

    public function update($id_alternatif)
    {
        $id_alternatif = $this->request->getPost('id_alternatif');
        $data = array(
            'nama' => $this->request->getPost('nama')
        );

        $this->Alternatif_model->updatee($id_alternatif, $data);
        session()->setFlashdata('message', '<div class="alert alert-success" role="alert">Data berhasil diupdate!</div>');
        return redirect()->to('Alternatif');;
    }

    public function destroy($id_alternatif)
    {
        $this->Alternatif_model->deletee($id_alternatif);
        session()->setFlashdata('message', '<div class="alert alert-success" role="alert">Data berhasil dihapus!</div>');
        return redirect()->to('Alternatif');;
    }
}

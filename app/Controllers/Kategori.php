<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KategoriModel;
use Config\Services;

class Kategori extends BaseController
{
    public function __construct()
    {
        $this->form_validation = Services::validation();
        $this->Kategori_model = new KategoriModel();

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
            'page' => "Kategori",
            'list' => $this->Kategori_model->tampil(),

        ];
        echo view('kategori/index', $data);
    }

    //menampilkan view create
    public function create()
    {
        $data['page'] = "Kategori";
        echo view('kategori/create',$data);
    }

    //menambahkan data ke database
    public function store()
    {
        $data = [
            'nama_nilai' => $this->request->getPost('nama_nilai')
        ];

        $this->form_validation->setRule('nama_nilai', 'Nama', 'required');

//        if ($this->form_validation->run() != false) {
            $result = $this->Kategori_model->insertt($data);
            if ($result) {
                session()->setFlashdata('message', '<div class="alert alert-success" role="alert">Data berhasil disimpan!</div>');
                redirect('Kategori');
            }
//        } else {
//            session()->setFlashdata('message', '<div class="alert alert-danger" role="alert">Data gagal disimpan!</div>');
//            return  redirect()->back();
//
//        }


    }

    public function edit($id_nilai)
    {
        $kategori = $this->Kategori_model->show($id_nilai);
        $data = [
            'page' => "Kategori",
            'kategori' => $kategori
        ];
        echo view('kategori/edit', $data);
    }

    public function update($id_nilai)
    {
        $id_nilai = $this->request->getPost('id_nilai');
        $data = array(
            'nama_nilai' => $this->request->getPost('nama_nilai')
        );

        $this->Kategori_model->updatee($id_nilai, $data);
        session()->setFlashdata('message', '<div class="alert alert-success" role="alert">Data berhasil diupdate!</div>');
        return redirect()->to('Kategori');
    }

    public function destroy($id_nilai)
    {
        $this->Kategori_model->deletee($id_nilai);
        session()->setFlashdata('message', '<div class="alert alert-success" role="alert">Data berhasil dihapus!</div>');
        return redirect('')->to('Kategori');
    }

}

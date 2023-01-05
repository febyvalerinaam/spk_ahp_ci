<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProfileModel;
use Config\Services;

class Profile extends BaseController
{
    public function __construct()
    {
        $this->form_validation = Services::validation();
        $this->Profile_model = new ProfileModel();
    }

    public function index()
    {
        $id_user = session('user_data')['id_user'];
        $profile = $this->Profile_model->show($id_user);
        $data = [
            'page' => "Profile",
            'profile' => $profile
        ];
        return view('profile/index', $data);
    }

    public function update($id_user)
    {
        $id_user = $this->request->getPost('id_user');
        $data = array(
            'nama' => $this->request->getPost('nama'),
            'email' => $this->request->getPost('email'),
            'username' => $this->request->getPost('username'),
            'password' => md5($this->request->getPost('password'))
        );

        $this->Profile_model->updatee($id_user, $data);
        session()->setFlashdata('message', '<div class="alert alert-success" role="alert">Data berhasil diupdate!</div>');
        return redirect()->to('Profile');
    }

}

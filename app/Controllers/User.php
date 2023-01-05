<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use Config\Services;

class User extends BaseController
{
    public function __construct()
    {
        $this->form_validation = Services::validation();
        $this->User_model = new UserModel();

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
            'page' => "User",
            'list' => $this->User_model->tampil(),
            'user_level'=> $this->User_model->user_level()

        ];
        echo view('user/index', $data);
    }

    public function create()
    {
        $data['page'] = "User";
        $data['user_level'] = $this->User_model->user_level();
        echo view('user/create',$data);
    }

    public function store()
    {

        $data = [
            'id_user_level' => $this->request->getPost('privilege'),
            'nama' => $this->request->getPost('nama'),
            'email' => $this->request->getPost('email'),
            'username' => $this->request->getPost('username'),
            'password' => md5($this->request->getPost('password'))
        ];

        $this->form_validation->setRule('email', 'email', 'required');
        $this->form_validation->setRule('privilege', 'ID User Level', 'required');
        $this->form_validation->setRule('username', 'Username', 'required|is_unique[user.username]');
        $this->form_validation->setRule('password', 'Password', 'required');

        $result = $this->User_model->insertt($data);
        if ($result) {
            session()->setFlashdata('message', '<div class="alert alert-success" role="alert">Data berhasil disimpan!</div>');
            return redirect()->to('User');
        }


    }

    public function show($id_user)
    {
        $User = $this->User_model->show($id_user);
        $user_level = $this->User_model->user_level();
        $data = [
            'page' => "User",
            'data' => $User,
            'user_level'=>$user_level
        ];
        echo view('user/show', $data);
    }

    public function edit($id_user)
    {
        $User = $this->User_model->show($id_user);
        $user_level = $this->User_model->user_level();
        $data = [
            'page' => "User",
            'User' => $User,
            'user_level'=>$user_level
        ];
        echo view('user/edit', $data);
    }

    public function update($id_user)
    {
        // TODO: implementasi update data berdasarkan $id_user
        $id_user = $this->request->getPost('id_user');
        $data = array(
            'page' => "User",
            'id_user_level' => $this->request->getPost('privilege'),
            'nama' => $this->request->getPost('nama'),
            'email' => $this->request->getPost('email'),
            'username' => $this->request->getPost('username'),
            'password' => md5($this->request->getPost('password'))
        );

        $this->User_model->updatee($id_user, $data);
        session()->setFlashdata('message', '<div class="alert alert-success" role="alert">Data berhasil diupdate!</div>');
        return redirect()->to('User');
    }

    public function destroy($id_user)
    {
        $this->User_model->deletee($id_user);
        session()->setFlashdata('message', '<div class="alert alert-success" role="alert">Data berhasil dihapus!</div>');
        return redirect()->to('User');
    }

}

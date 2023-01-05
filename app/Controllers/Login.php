<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\LoginModel;
use App\Models\UserModel;
use CodeIgniter\Session\Session;

class Login extends BaseController
{
    public function __construct()
    {
        $this->Login_model = new LoginModel();
        $this->User_model= new UserModel();
    }

    public function index()
    {
//        return 'oke';
        if($this->Login_model->logged_id())
        {
            return redirect()->to('home');
        }else{
            echo view('login');
        }
    }

    public function login()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $passwordx = md5($password);
        $set = $this->Login_model->login($username, $passwordx);
        if($set)
        {
            $log = [
                'id_user' => $set->id_user,
                'username' => $set->username,
                'id_user_level' => $set->id_user_level,
                'status' => 'Logged'
            ];
            session()->set('user_data', $log);
            return redirect()->to('home');

        }
        else
        {
            session()->set_flashdata('message', 'Username atau Password Salah');
            redirect('login');
        }

    }

    public function logout()
    {
        session()->destroy();
        redirect('/');
    }

    public function home()
    {
        $data['page'] = "Dashboard";
        echo view('admin/index', $data);
    }
}

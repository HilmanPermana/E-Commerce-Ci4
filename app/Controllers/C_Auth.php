<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Users;

class C_Auth extends BaseController
{

    public function __construct()
    {

        $this->userModel = new Users();

        $this->validation = \Config\Services::validation();

        $this->session = \Config\Services::session();
    }

    public function login()
    {
        return view('auth/login');
    }

    public function register()
    {
        return view('auth/register');
    }

    public function valid_register()
    {
        $data = $this->request->getPost();

        $this->validation->run($data, 'register');

        $errors = $this->validation->getErrors();

        if ($errors) {
            session()->setFlashdata('error', $errors);
            return redirect()->to('/auth/register');
        }

        $salt = uniqid('', true);

        $password = md5($data['password']) . $salt;

        $this->userModel->save([
            'username' => $data['username'],
            'password' => $password,
            'salt' => $salt,
            'role' => 2
        ]);

        session()->setFlashdata('success', 'Anda berhasil mendaftar, silahkan login');
        return redirect()->to('/auth/login');
    }

    public function valid_login()
    {
        $data = $this->request->getPost();

        $user = $this->userModel->where('username', $data['username'])->first();

        if ($user) {

            if ($user['password'] != md5($data['password']) . $user['salt']) {
                session()->setFlashdata('password', 'Password Salah');
                return redirect()->back();
            } else {
                $sessLogin = [
                    'isLogin' => true,
                    'username' => $user['username'],
                    'role' => $user['role']
                ];
                $this->session->set($sessLogin);
                return redirect()->to(base_url('product'));
            }
        } else {
            session()->setFlashdata('username', 'Username tidak ditemukan');
            return redirect()->back();
        }
    }

    public function logout()
    {
        $this->session->destroy();
        return redirect()->to('/auth/login');
    }
}

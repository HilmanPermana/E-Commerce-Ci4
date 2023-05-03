<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class C_User extends BaseController
{

    public function __construct()
    {
        $this->session = session();
    }


    public function index()
    {
        if(!$this->session->has('isLogin'))
        {
            return redirect()->to('/auth/login');
        }

        return view('user/index');
    }
}

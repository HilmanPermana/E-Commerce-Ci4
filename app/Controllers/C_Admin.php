<?php

namespace App\Controllers;

class C_Admin extends BaseController
{
   public function _construct()
   {
    $this->session = session();
   }

   public function index()
   {
    if(!$this->session->has('isLogin'))
    {
        return redirect()->to('/auth/login');
    }

    if($this->session->get('role') != 1)
    {
        return redirect()->to('/user');
    }

    return view('admin/index');
   }
}

<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class C_Barang extends BaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = new \App\Models\Barang();
    }

    public function index()
    {
        return $this->render('barang/index', [
            'title' => 'Barang',
            'barang' => $this->model->getAllBarang()
        ]);
    }

    public function show()
    {
        return $this->render('barang/create', [
            'title' => 'Tambah Barang'
        ]);
    }

    public function create()
    {
        $validation =  \Config\Services::validation();

        $validation->setRules([
            'namabrg' => 'required',
            'harga' => 'required|numeric',
            'diskon' => 'required|numeric',
            'stok' => 'required|numeric',
            'namafile' => 'uploaded[namafile]'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('validation', $validation);
        }

        $nama_barang = $this->request->getPost('namabrg');
        $harga = $this->request->getPost('harga');
        $stok = $this->request->getPost('stok');
        $diskon = $this->request->getPost('diskon');
        $gambar = $this->request->getFile('namafile');


        $fileName = $gambar->getRandomName();

        $gambar->move(ROOTPATH . 'public/gambar', $fileName);


        $this->model->insert([
            'namabrg' => $nama_barang,
            'stok' => $stok,
            'harga' => $harga,
            'diskon' => $diskon,
            'namafile' => $fileName
        ]);

        return redirect()->to(base_url('/admin/barang'));
    }

    public function getBarang()
    {
        $uri = service('uri');
        $id = $uri->getSegment(3);

        try {
            $barang = $this->model->getBarang($id);

            if ($barang) {
                return response()->setJSON($barang);
            } else {
                return response()->setJSON([
                    'status' => 404,
                    'message' => 'Data tidak ditemukan'
                ]);
            }
        } catch (\Throwable $th) {
            return response()->setJSON([
                'status' => 500,
                'message' => 'Terjadi kesalahan'
            ]);
        }
    }
}

<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class C_Transaksi extends BaseController
{

    protected $model_barang;
    protected $model_transaksi_penjualan;
    protected $model_jual;

    public function __construct()
    {
        $this->model_barang = new \App\Models\Barang();
        $this->model_transaksi_penjualan = new \App\Models\TransaksiPenjualan;
        $this->model_jual = new \App\Models\Jual;
    }

    public function add_to_cart()
    {
        // Ambil data produk dari database atau sumber data lainnya
        $product_data = $this->model_barang->getBarang($this->request->getPost('idkemeja'));



        // Buat array untuk disimpan ke dalam session
        $product = [
            'id' => isset($product_data['idkemeja']) ? $product_data['idkemeja'] : '',
            'qty' => 1,
            'price' => isset($product_data['harga']) ? $product_data['harga'] : '',
            'name' => isset($product_data['namabrg']) ? $product_data['namabrg'] : '',
            'diskon' => isset($product_data['diskon']) ? $product_data['diskon'] : '',
            'gambar' => isset($product_data['namafile']) ? $product_data['namafile'] : ''
        ];



        // Jika session cart belum ada maka buat cart baru
        if (!session()->has('cart')) {
            session()->set('cart', []);
        }

        //dd(session()->get('cart'));
        $cart = session()->get('cart');
        if (array_key_exists($product['id'], $cart)) {
            $cart[$product['id']]['qty'] += 1;
        } else {
            $cart[$product['id']] = $product;
        }
        session()->set('cart', $cart);

        // Redirect ke halaman sebelumnya
        return redirect()->back();
    }


    public function delete_product_in_cart()
    {
        $cart = session()->get('cart');
        unset($cart[$this->request->getPost('id')]);
        session()->set('cart', $cart);

        // jika cart kosong maka hapus session cart
        if (count($cart) == 0) {
            session()->remove('cart');
        }

        return redirect()->to('/cart');
    }

    public function update_qty_cart()
    {
        $id = $this->request->getPost('id');
        $qty = $this->request->getPost('qty');

        // Ambil data produk dari database atau sumber data lainnya
        $product_data = $this->model_barang->getBarang($id);

        // Buat array untuk disimpan ke dalam session
        $product = [
            'id' => isset($product_data['idkemeja']) ? $product_data['idkemeja'] : '',
            'qty' => $qty,
            'price' => isset($product_data['harga']) ? $product_data['harga'] : '',
            'name' => isset($product_data['namabrg']) ? $product_data['namabrg'] : '',
            'gambar' => isset($product_data['namafile']) ? $product_data['namafile'] : '',
        ];

        $cart = session()->get('cart');
        // Cek apakah produk sudah ada di dalam cart, jika sudah maka tambahkan qty nya saja, jika belum maka tambahkan produk baru ke cart session
        if (array_key_exists($id, $cart)) {
            $cart[$id]['qty'] = $qty;
        } else {
            $cart[$id] = $product;
        }

        session()->set('cart', $cart);
        return redirect()->to('/cart');
    }

    public function checkout()
    {
        $data_checkout = [
            'nama' => $this->request->getPost('nama'),
            'hp' => $this->request->getPost('no_hp'),
            'alamat' => $this->request->getPost('alamat'),
            'kota' => $this->request->getPost('kota'),
            'kecamatan' => $this->request->getPost('kecamatan'),
            'total' =>  $this->request->getPost('total_transaksi'),
        ];

        // get data cart pada session cart
        $cart = session()->get('cart');
        $idkemeja = [];
        foreach ($cart as $key => $value) {
            $idkemeja[] = $key;
        }

        // insert data transaksi_penjualan
        $transaksi = $this->model_transaksi_penjualan->insert($data_checkout);


        // insert data ke tabel jual
        $data_jual = [];
        foreach ($cart as $key => $value) {
            $data_jual[] = [
                'idtrans' => $transaksi,
                'idkemeja' => $key,
                'jmljual' => $value['qty'],
                'hargajual' => $value['price'],
            ];
        }

        $produk = $this->model_barang->whereIn('idkemeja', $idkemeja)->findAll();

        // jika qty melebihi stok maka tidak bisa checkout
        foreach ($produk as $p) {
            $cart_qty = $cart[$p['idkemeja']]['qty'];
            if ($cart_qty > $p['stok']) {
                $idkemeja = $p['idkemeja'];
                $namabrg = $p['nama'];
                $stok = $p['stok'];
                session()->setFlashdata('error', "Stok $namabrg tidak mencukupi, stok tersisa $stok");
            }
            return redirect()->to('/cart');
        }

        foreach ($produk as $p) {
            $cart_qty = $cart[$p['idkemeja']]['qty'];
            $new_stock = $p['stok'] - $cart_qty;
            $this->model_barang->update($p['idkemeja'], ['stok' => $new_stock]);
        }


        $this->model_jual->insert_data_jual($data_jual);

        //dd($data_checkout);
        return redirect()->to('/checkout');
    }
}

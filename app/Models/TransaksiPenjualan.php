<?php

namespace App\Models;

use CodeIgniter\Model;

class TransaksiPenjualan extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'transaksipjl';
    protected $primaryKey       = 'idtrans';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['nama', 'hp', 'alamat', 'kecamatan', 'kota', 'total'];
    protected $useTimestamps = false;

    public function insert_data_transaksi($data)
    {
        $this->db->table($this->table)->insertBatch($data);
    }
}

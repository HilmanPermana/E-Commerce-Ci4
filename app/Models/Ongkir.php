<?php

namespace App\Models;

use CodeIgniter\Model;

class Ongkir extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'ongkir';
    protected $primaryKey       = 'id_pengiriman';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['kode_pos_awal', 'kode_pos_tujuan', 'tarif'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
}

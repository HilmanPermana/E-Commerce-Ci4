<?php

namespace App\Models;

use CodeIgniter\Model;

class Users extends Model
{
    protected $table = "user";
    protected $primarykey = "id";
    protected $allowedFields = ["username", "password", "salt", "role"];
    protected $useTimestamps = true;
}

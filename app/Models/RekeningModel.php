<?php

namespace App\Models;

use CodeIgniter\Model;

class RekeningModel extends Model
{
   protected $table = 'tbl_rekening';
   protected $primaryKey = 'id';
   protected $useTimestamps = true;
   protected $dateFormat = 'int';
   protected $allowedFields = ['no_rekening', 'siswa_id', 'saldo', 'is_active'];

   protected $createdField  = 'created_at';
   protected $updatedField  = 'updated_at';
   protected $deletedField  = 'deleted_at';
}

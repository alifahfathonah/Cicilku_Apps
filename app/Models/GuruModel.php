<?php

namespace App\Models;

use CodeIgniter\Model;

class GuruModel extends Model
{
   protected $table = 'tbl_guru';
   protected $primaryKey = 'id';
   protected $useTimestamps = true;
   protected $dateFormat = 'int';
   protected $allowedFields = ['nip', 'username', 'password', 'email', 'nama', 'nohp', 'image', 'role_id', 'is_active'];

   protected $createdField  = 'created_at';
   protected $updatedField  = 'updated_at';
   protected $deletedField  = 'deleted_at';
}

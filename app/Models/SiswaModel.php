<?php

namespace App\Models;

use CodeIgniter\Model;

class SiswaModel extends Model
{
   protected $table = 'tbl_siswa';
   protected $primaryKey = 'id';
   protected $useTimestamps = true;
   protected $dateFormat = 'int';
   protected $allowedFields = ['nisn', 'username', 'password', 'email', 'jk', 'kelas_id', 'ttl', 'nama', 'nohp', 'orangtua', 'image', 'alamat', 'rekening_id', 'role_id', 'is_active'];

   protected $createdField  = 'created_at';
   protected $updatedField  = 'updated_at';
   protected $deletedField  = 'deleted_at';
}

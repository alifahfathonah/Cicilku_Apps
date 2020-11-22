<?php

namespace App\Models;

use CodeIgniter\Model;

class DetailKelasModel extends Model
{
   protected $table = 'tbl_detail_kelas';

   protected $primaryKey = 'id';
   protected $useTimestamps = true;

   protected $returnType     = 'array';
   protected $useSoftDeletes = true;

   protected $dateFormat = 'int';
   protected $allowedFields = ['kelas_id', 'siswa_id'];


   protected $createdField  = 'created_at';
   protected $updatedField  = 'updated_at';
   protected $deletedField  = 'deleted_at';
}

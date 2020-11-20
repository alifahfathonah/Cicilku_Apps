<?php

namespace App\Models;

use CodeIgniter\Model;

class KelasModel extends Model
{
   protected $table = 'tbl_kelas';

   protected $primaryKey = 'id';
   protected $useTimestamps = true;

   protected $returnType     = 'array';
   protected $useSoftDeletes = true;

   protected $dateFormat = 'int';
   protected $allowedFields = ['semester_id', 'guru_id', 'kelas', 'is_active'];


   protected $createdField  = 'created_at';
   protected $updatedField  = 'updated_at';
   protected $deletedField  = 'deleted_at';
}

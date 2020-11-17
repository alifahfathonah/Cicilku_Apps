<?php

namespace App\Models;

use CodeIgniter\Model;

class SemesterModel extends Model
{
   protected $table = 'tbl_semester';

   protected $primaryKey = 'id';
   protected $useTimestamps = true;

   protected $returnType     = 'array';
   protected $useSoftDeletes = true;

   protected $dateFormat = 'int';
   protected $allowedFields = ['semester', 'periode_awal', 'periode_akhir'];


   protected $createdField  = 'created_at';
   protected $updatedField  = 'updated_at';
   protected $deletedField  = 'deleted_at';
}

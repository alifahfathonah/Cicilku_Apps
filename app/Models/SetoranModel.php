<?php

namespace App\Models;

use CodeIgniter\Model;

class SetoranModel extends Model
{
   protected $table = 'tbl_setoran';

   protected $primaryKey = 'id';
   protected $useTimestamps = true;

   protected $returnType     = 'array';
   protected $useSoftDeletes = true;

   protected $dateFormat = 'int';
   protected $allowedFields = ['semester_id', 'rekening_id', 'siswa_id', 'guru_id', 'nominal', 'keterangan', 'status', 'sisa_saldo'];


   protected $createdField  = 'created_at';
   protected $updatedField  = 'updated_at';
   protected $deletedField  = 'deleted_at';
}

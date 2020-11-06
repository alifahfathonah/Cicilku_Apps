<?php

namespace App\Models;

use CodeIgniter\Model;

class RoleModel extends Model
{
   protected $table = 'tbl_user_role';

   protected $primaryKey = 'id';
   protected $useTimestamps = true;

   protected $returnType     = 'array';
   protected $useSoftDeletes = true;

   protected $dateFormat = 'int';
   protected $allowedFields = ['role'];


   protected $createdField  = 'created_at';
   protected $updatedField  = 'updated_at';
   protected $deletedField  = 'deleted_at';
}

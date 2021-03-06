<?php

namespace App\Models;

use CodeIgniter\Model;

class MenuModel extends Model
{
   protected $table = 'tbl_user_menu';

   protected $primaryKey = 'id';
   protected $useTimestamps = true;

   protected $returnType     = 'array';
   protected $useSoftDeletes = true;

   protected $dateFormat = 'int';
   protected $allowedFields = ['menu'];


   protected $createdField  = 'created_at';
   protected $updatedField  = 'updated_at';
   protected $deletedField  = 'deleted_at';
}

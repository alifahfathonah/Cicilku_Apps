<?php

namespace App\Models;

use CodeIgniter\Model;

class SubMenuModel extends Model
{
   protected $table = 'tbl_sub_menu';

   protected $primaryKey = 'id';
   protected $useTimestamps = true;

   protected $useSoftDeletes = true;

   protected $dateFormat = 'int';
   protected $allowedFields = ['menu_id', 'title', 'url', 'icon', 'is_active'];


   protected $createdField  = 'created_at';
   protected $updatedField  = 'updated_at';
   protected $deletedField  = 'deleted_at';
}

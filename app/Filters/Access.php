<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

use App\Models\SubMenuModel;
use App\Models\UserAccessMenuModel;

class Access implements FilterInterface
{
   protected $subMenuModel;
   protected $userAccessMenuModel;
   public function before(RequestInterface $request, $arguments = null)
   {
      $db = \Config\Database::connect();

      $this->subMenuModel = new SubMenuModel();
      $this->userAccessMenuModel = new UserAccessMenuModel();


      if (!session()->get('id_user')) {
         return redirect()->to('/auth');
      } else {
         $role_id = session()->get('role_id');

         //ambil url dari segment url
         $uri = service('uri');
         $url = $uri->getSegment(1);


         //ambil menu id dari tabel subMenu
         $querySubMenu = $this->subMenuModel->where(['url' => $url])->first();
         $menu_id =  $querySubMenu['menu_id'];

         //cocokan dengan access menu


         $cek = $this->userAccessMenuModel->where(['role_id' => $role_id, 'menu_id' => $menu_id])->first();


         if (!$cek) {
            return redirect()->to('my');
         }
      }
   }

   //--------------------------------------------------------------------

   public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
   {
      // Do something here
   }
}

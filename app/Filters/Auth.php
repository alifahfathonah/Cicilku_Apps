<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;


class Auth implements FilterInterface
{

   public function before(RequestInterface $request, $arguments = null)
   {

      if (session()->get('id_user')) {
         return redirect()->to('/admin');
      }
   }

   //--------------------------------------------------------------------

   public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
   {
      // Do something here
   }
}

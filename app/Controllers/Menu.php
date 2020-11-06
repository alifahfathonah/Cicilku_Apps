<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\MenuModel;
use App\Models\SubMenuModel;
use App\Controllers\BaseController;

class Menu extends BaseController
{
   protected $userModel;
   protected $menuModel;
   protected $subMenuModel;
   public function __construct()
   {
      $this->userModel = new UserModel();
      $this->menuModel = new MenuModel();
      $this->subMenuModel = new SubMenuModel();
      $this->validation = \Config\Services::validation();
      $this->db = \Config\Database::connect();
      $this->idUserSession = session()->get('id_user');
   }

   public function index()
   {

      $data = [
         'title' => 'User Menu - Menu Management',
         'subMenuTitle' => 'Menu Management',
         'user' => $this->userModel->where(['id' => $this->idUserSession])->first(),
         'db' =>  $this->db,
         'menu' => $this->menuModel->findAll(),
         'validation' => $this->validation
      ];
      return view('admin/menu/user_menu', $data);
   }

   public function save()
   {
      //validation include
      if (!$this->validate([
         'menu' => [
            'rules' =>   'required|trim|is_unique[tbl_user_menu.menu]|alpha_space|max_length[128]',
            'errors' => [
               'required' => 'Role user menu tidak boleh kosong!',
               'is_unique' => 'Role user menu sudah ada.'
            ]
         ]
      ])) {
         return redirect()->to('/admin/menu')->withInput()->with('validation', $this->validation);
      }


      if ($this->menuModel->save([
         'menu' => $this->request->getVar('menu')
      ])) {
         session()->setFlashdata('pesan', 'Role user menu <b>' . $this->request->getVar('menu') . '</b> berhasil dibuat');
         return redirect()->to('/admin/menu');
      } else {
         echo 'gagal';
      }
   }

   public function update()
   {
      //validation include
      if (!$this->validate([
         'menu' => [
            'rules' =>   'required|trim|is_unique[tbl_user_menu.menu]|alpha_space|max_length[128]',
            'errors' => [
               'required' => 'Role user menu tidak boleh kosong!',
               'is_unique' => 'Role user menu sudah ada.'
            ]
         ]
      ])) {
         return redirect()->to('/admin/menu')->withInput()->with('validation', $this->validation);
      }


      if ($this->menuModel->save([
         'id' => $this->request->getVar('menu_id'),
         'menu' => $this->request->getVar('menu')
      ])) {
         session()->setFlashdata('pesan', 'Role user menu <b>' . $this->request->getVar('menu') . '</b> berhasil diupdate');
         return redirect()->to('/admin/menu');
      } else {
         echo 'gagal';
      }
   }

   public function delete()
   {

      if ($this->menuModel->delete(['id', $this->request->getVar('menu_id')])) {
         session()->setFlashdata('pesan', 'Berhasil di delete');
         return redirect()->to('/admin/menu');
      } else {
         echo 'gagal';
      }
   }

   public function indexSubMenu()
   {
      $data = [
         'title' => 'User Sub Menu - Menu Management',
         'subMenuTitle' => 'Sub Menu Management',
         'user' => $this->userModel->where(['id' => $this->idUserSession])->first(),
         'db' =>  $this->db,
         'menu' => $this->menuModel->findAll(),
         'validation' => $this->validation
      ];
      return view('admin/menu/user_submenu', $data);
   }

   public function saveSubMenu()
   {

      if ($this->request->getPost()) {
         $id = $this->request->getVar('menu_id');

         //validation include
         if (!$this->validate([
            'title' => [
               'rules' =>   'required|trim|alpha_space|max_length[128]',
               'errors' => [
                  'required' => 'Title menu tidak boleh kosong.',
                  'alpa_space' => 'Title menu hanya boleh berisi karakter alfabet dan spasi.',
                  'max_length' => 'Title menu tidak boleh melebihi 128 karakter.'
               ]
            ],
            'url' => [
               'rules' => 'required|trim|is_unique[tbl_sub_menu.url]|max_length[128]',
               'errors' => [
                  'required' => 'Url menu tidak boleh kosong.',
                  'is_unique' => 'Url menu sudah ada.',
                  'max_length' => 'Url menu tidak boleh melebihi 128 karakter.'
               ]
            ],
            'icon' => [
               'rules' => 'required|trim|max_length[128]',
               'errors' => [
                  'required' => 'Icon menu tidak boleh kosong',
                  'max_length' => 'Icon menu tidak boleh melebihi 128 karakter.'
               ]
            ]
         ])) {
            return redirect()->to('/admin/submenu/add?id=' . $id)->withInput()->with('validation', $this->validation);
         }

         //convert string on to int 1 
         $is_active = ($this->request->getVar('is_active') == 'on') ? '1' : '0';

         //user SubMenu disimpan kedalam database
         if ($this->subMenuModel->save([
            'menu_id' => $this->request->getVar('menu_id'),
            'title' => $this->request->getVar('title'),
            'url' => $this->request->getVar('url'),
            'icon' => $this->request->getVar('icon'),
            'is_active' =>  $is_active
         ])) {

            session()->setFlashdata('pesan', 'Menu <b>' . $this->request->getVar('title') . '</b> berhasil ditambahkan');
            return redirect()->to('/admin/submenu');
         } else {
            echo 'gagal';
         }
      } else {
         $data = [
            'title' => 'User Sub Menu - Menu Management',
            'subMenuTitle' => 'Sub Menu Management',
            'user' => $this->userModel->where(['id' => $this->idUserSession])->first(),
            'db' =>  $this->db,
            'menu' => $this->menuModel->findAll(),
            'validation' => $this->validation
         ];
         return view('admin/menu/add_submenu', $data);
      }
   }

   public function editSubMenu()
   {
      if ($this->request->getPost()) {
         //validation include
         $id = $this->request->getVar('id');
         $cek_url = $this->subMenuModel->where(['url' => $this->request->getVar('url')])->first();
         $is_unique = ($cek_url['id'] == $id) ? '' : '|is_unique[tbl_sub_menu.url]';
         $err_is_unique = ($cek_url['id'] == $id) ? "" :  " 'is_unique' => 'Url menu sudah ada.' ";
         if (!$this->validate([
            'title' => [
               'rules' =>   'required|trim|alpha_space|max_length[128]',
               'errors' => [
                  'required' => 'Title menu tidak boleh kosong.',
                  'alpa_space' => 'Title menu hanya boleh berisi karakter alfabet dan spasi.',
                  'max_length' => 'Title menu tidak boleh melebihi 128 karakter.'
               ]
            ],
            'url' => [
               'rules' => 'required|trim' . $is_unique . '|max_length[128]',
               'errors' => [
                  'required' => 'Url menu tidak boleh kosong.',
                  $err_is_unique,
                  'max_length' => 'Url menu tidak boleh melebihi 128 karakter.'
               ]
            ],
            'icon' => [
               'rules' => 'required|trim|max_length[128]',
               'errors' => [
                  'required' => 'Icon menu tidak boleh kosong',
                  'max_length' => 'Icon menu tidak boleh melebihi 128 karakter.'
               ]
            ]
         ])) {
            return redirect()->to('/admin/submenu/edit?id=' . $id)->withInput()->with('validation', $this->validation);
         }


         //convert string on to int 1 
         $is_active = ($this->request->getVar('is_active') == 'on') ? '1' : '0';

         //user SubMenu diupdate kedalam database
         if ($this->subMenuModel->save([
            'id' => $this->request->getVar('id'),
            'menu_id' => $this->request->getVar('menu_id'),
            'title' => $this->request->getVar('title'),
            'url' => $this->request->getVar('url'),
            'icon' => $this->request->getVar('icon'),
            'is_active' =>  $is_active
         ])) {

            session()->setFlashdata('pesan', 'Menu <b>' . $this->request->getVar('title') . '</b> berhasil diupdate');
            return redirect()->to('/admin/submenu');
         } else {
            echo 'gagal';
         }
      } else {
         $user_id = $this->request->getVar('id');
         $data = [
            'title' => 'User Sub Menu - Menu Management',
            'subMenuTitle' => 'Sub Menu Management',
            'user' => $this->userModel->where(['id' => $this->idUserSession])->first(),
            'db' =>  $this->db,
            'menu' => $this->menuModel->findAll(),
            'subMenu' => $this->subMenuModel->where(['id' => $user_id])->first(),
            'validation' => $this->validation
         ];
         return view('admin/menu/edit_submenu', $data);
      }
   }

   public function deleteSubMenu()
   {
      if ($this->subMenuModel->delete(['id' => $this->request->getPost('submenu_id'), 'title' => $this->request->getPost('title')])) {

         session()->setFlashdata('pesan', 'Menu <b>' . $this->request->getVar('title') . '</b> berhasil dihapus');
         return redirect()->to('/admin/submenu');
      } else {
         echo 'gagal';
      }
   }
   //--------------------------------------------------------------------

}

<!DOCTYPE html>
<html lang="en">

<head>
   <!-- Require meta tags -->
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

   <title><?= $title; ?></title>

   <!-- Bootstrap CSS first -->
   <link rel="stylesheet" href="<?= base_url('/dist/css/bootstrap.min.css'); ?>">
   <!-- then Font Awesome -->
   <link rel="stylesheet" type="text/css" href="<?= base_url('/plugins/font-awesome-4.7.0/css/font-awesome.min.css'); ?>">
   <!-- Font Awesome 5 -->
   <script src="https://kit.fontawesome.com/ccded69204.js" crossorigin="anonymous"></script>
   <!-- and Reza Admin CSS -->
   <link rel="stylesheet" type="text/css" href="<?= base_url('/dist/css/reza-admin.min.css'); ?>">
   <!-- Favicon -->
   <link rel="icon" href="<?= base_url('/dist/img/logo1.png'); ?>">
</head>

<body>
   <!-- navbar -->
   <nav class="navbar navbar-expand-sm navbar--white">
      <a class="navbar__sidebar-toggler" href="#"><span class="fa fa-bars"></span></a>
      <a class="navbar-brand ml-3"><img src="<?= base_url('/dist/img/logo.png'); ?>" width="80" alt="logo cicilku"></a>
      <button class="navbar-toggler" data-target="#navbarNav" data-toggle="collapse" type="button">
         <span class="fa fa-navicon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
         <ul class="navbar-nav">
            <li class="nav-item navbar__avatar dropdown">
               <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">
                  <img src="<?= base_url('asset/users/img/' . $user['image']); ?>" alt="<?= $user['name']; ?>">
                  <span><?= $user['name']; ?></span>
               </a>
               <div class="dropdown-menu dropdown-menu-right">
                  <a href="" class="dropdown-item">Settings Account</a>
                  <div class="dropdown-divider"></div>
                  <a href="<?= base_url('logout'); ?>" class="dropdown-item dropdown-item--hover-red">Logout <span class="fa fa-sign-out"></span></a>
               </div>

            </li>
         </ul>
      </div>
   </nav>

   <!-- sidebar -->
   <aside class="sidebar">
      <ul class="sidebar__nav">

         <!-- 
         Sidebar Menu 
         | Setiap menu dan sub menu 
         | di masukkan ke dalam database
         | agar menu dapat ditampilkan secara dinamis. 
         -->

         <!-- Query Menu -->
         <?php
         $role_id = $user['role_id'];
         $queryMenu = "SELECT `tbl_user_menu`.`id`, `menu`
                         FROM `tbl_user_menu` JOIN `tbl_user_access_menu`
                           ON `tbl_user_menu`.`id` = `tbl_user_access_menu`.`menu_id`
                        WHERE `tbl_user_access_menu`.`role_id` = $role_id
                     ORDER BY `tbl_user_access_menu`.`menu_id` ASC";
         $menu = $db->query($queryMenu)->getResultArray();
         ?>

         <!-- Looping menu -->
         <?php
         foreach ($menu as $m) : ?>
         
            <li class="sidebar__item sidebar__item--header mt-3"><?= $m['menu']; ?></li>

            <!--query Sub menu -->
            <?php
            $menuId = $m['id'];
            $querySubMenu = " SELECT *
                                FROM `tbl_sub_menu` 
                               WHERE `menu_id` = $menuId
                                 AND `is_active` = 1";
            $subMenu = $db->query($querySubMenu)->getResultArray();
            ?>

            <!-- Looping subMenu -->
            <?php foreach ($subMenu as $sm) : ?>
               <li class="sidebar__item <?=($subMenuTitle == $sm['title'])? 'sidebar__item--active' : '';?> "><a href="<?= base_url($sm['url']); ?>"><span class="<?= $sm['icon']; ?>"></span> <?= $sm['title']; ?></a></li>
            <?php endforeach; ?>
            <!-- End looping subMenu -->
         <?php endforeach; ?>
         <!-- End looping Menu -->
      </ul>
   </aside>

   <!-- Content ditampilkan -->
   <?= $this->renderSection('app_content'); ?>

   <!-- footer -->
   <footer class="footer footer--ml-sidebar-width">
      <p class="mb-2 mb-sm-0">Copyright &copy; Cicilku 2020. All rights reserved</p>
      <p>Version (Alpha)</p>
   </footer>

   <!-- jQuery first, then Bootstrap JS, and Reza Admin JS-->
   <script src="<?= base_url('/dist/js/jquery-3.5.1.slim.min.js'); ?>"></script>
   <script src="<?= base_url('/dist/js/bootstrap.min.js'); ?>"></script>
   <script src="<?= base_url('/dist/js/reza-admin.min.js'); ?>"></script>

</body>

</html>
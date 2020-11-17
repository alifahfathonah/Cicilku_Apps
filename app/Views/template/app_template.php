<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width,initial-scale=1">
   <title><?= $title; ?></title>
   <!-- Favicon icon -->
   <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url('asset/images/favicon.png'); ?>">
   <!-- Font Awesome 5 -->
   <script src="https://kit.fontawesome.com/ccded69204.js" crossorigin="anonymous"></script>



   <!-- Custom Stylesheet -->
   <link href="<?= base_url('asset/plugins/toastr/css/toastr.min.css'); ?>" rel="stylesheet">
   <link href="<?= base_url('asset/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css'); ?>" rel="stylesheet">
   <!-- Page plugins css -->
   <link href="<?= base_url('asset/plugins/clockpicker/dist/jquery-clockpicker.min.css'); ?>" rel="stylesheet">
   <!-- Color picker plugins css -->
   <link href="<?= base_url('asset/plugins/jquery-asColorPicker-master/css/asColorPicker.css'); ?>" rel="stylesheet">

   <!-- Date picker plugins css -->
   <link href="<?= base_url('asset/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css'); ?>" rel="stylesheet">
   <!-- Daterange picker plugins css -->
   <link href="<?= base_url('asset/plugins/timepicker/bootstrap-timepicker.min.css'); ?>" rel="stylesheet">
   <link href="<?= base_url('asset/plugins/bootstrap-daterangepicker/daterangepicker.css'); ?>" rel="stylesheet">

   <link href="<?= base_url('asset/css/style.css'); ?>" rel="stylesheet">
</head>

<body>

   <!--*******************
        Preloader start
    ********************-->
   <div id="preloader">
      <div class="loader">
         <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
         </svg>
      </div>
   </div>
   <!--*******************
        Preloader end
    ********************-->


   <!--**********************************
        Main wrapper start
    ***********************************-->
   <div id="main-wrapper">

      <!--**********************************
            Nav header start
        ***********************************-->
      <div class="nav-header">
         <div class="brand-logo">
            <a href="index.html">
               <b class="logo-abbr"><img src="<?= base_url('asset/images/logo.png'); ?>" alt=""> </b>
               <span class="logo-compact"><img src="<?= base_url('asset/images/logo-compact.png'); ?>" alt=""></span>
               <span class="brand-title">
                  <img style="width: 100%;" src="<?= base_url('asset/images/logo-text.png'); ?>" alt="">
               </span>
            </a>
         </div>
      </div>
      <!--**********************************
            Nav header end
        ***********************************-->

      <!--**********************************
            Header start
        ***********************************-->
      <div class="header">
         <div class="header-content clearfix">

            <div class="nav-control">
               <div class="hamburger">
                  <span class="toggle-icon"><i class="icon-menu"></i></span>
               </div>
            </div>
            <div class="header-right">
               <ul class="clearfix">
                  <li class="icons dropdown"><a href="javascript:void(0)" data-toggle="dropdown">
                        <i class="mdi mdi-email-outline"></i>
                        <span class="badge gradient-1 badge-pill badge-primary">3</span>
                     </a>
                     <div class="drop-down animated fadeIn dropdown-menu">
                        <div class="dropdown-content-heading d-flex justify-content-between">
                           <span class="">3 New Messages</span>

                        </div>
                        <div class="dropdown-content-body">
                           <ul>
                              <li class="notification-unread">
                                 <a href="javascript:void()">
                                    <img class="float-left mr-3 avatar-img" src="images/avatar/1.jpg" alt="">
                                    <div class="notification-content">
                                       <div class="notification-heading">Saiful Islam</div>
                                       <div class="notification-timestamp">08 Hours ago</div>
                                       <div class="notification-text">Hi Teddy, Just wanted to let you ...</div>
                                    </div>
                                 </a>
                              </li>
                              <li class="notification-unread">
                                 <a href="javascript:void()">
                                    <img class="float-left mr-3 avatar-img" src="images/avatar/2.jpg" alt="">
                                    <div class="notification-content">
                                       <div class="notification-heading">Adam Smith</div>
                                       <div class="notification-timestamp">08 Hours ago</div>
                                       <div class="notification-text">Can you do me a favour?</div>
                                    </div>
                                 </a>
                              </li>
                              <li>
                                 <a href="javascript:void()">
                                    <img class="float-left mr-3 avatar-img" src="images/avatar/3.jpg" alt="">
                                    <div class="notification-content">
                                       <div class="notification-heading">Barak Obama</div>
                                       <div class="notification-timestamp">08 Hours ago</div>
                                       <div class="notification-text">Hi Teddy, Just wanted to let you ...</div>
                                    </div>
                                 </a>
                              </li>
                              <li>
                                 <a href="javascript:void()">
                                    <img class="float-left mr-3 avatar-img" src="images/avatar/4.jpg" alt="">
                                    <div class="notification-content">
                                       <div class="notification-heading">Hilari Clinton</div>
                                       <div class="notification-timestamp">08 Hours ago</div>
                                       <div class="notification-text">Hello</div>
                                    </div>
                                 </a>
                              </li>
                           </ul>

                        </div>
                     </div>
                  </li>
                  <li class="icons dropdown"><a href="javascript:void(0)" data-toggle="dropdown">
                        <i class="mdi mdi-bell-outline"></i>
                        <span class="badge badge-pill gradient-2 badge-primary">3</span>
                     </a>
                     <div class="drop-down animated fadeIn dropdown-menu dropdown-notfication">
                        <div class="dropdown-content-heading d-flex justify-content-between">
                           <span class="">2 New Notifications</span>

                        </div>
                        <div class="dropdown-content-body">
                           <ul>
                              <li>
                                 <a href="javascript:void()">
                                    <span class="mr-3 avatar-icon bg-success-lighten-2"><i class="icon-present"></i></span>
                                    <div class="notification-content">
                                       <h6 class="notification-heading">Events near you</h6>
                                       <span class="notification-text">Within next 5 days</span>
                                    </div>
                                 </a>
                              </li>
                              <li>
                                 <a href="javascript:void()">
                                    <span class="mr-3 avatar-icon bg-danger-lighten-2"><i class="icon-present"></i></span>
                                    <div class="notification-content">
                                       <h6 class="notification-heading">Event Started</h6>
                                       <span class="notification-text">One hour ago</span>
                                    </div>
                                 </a>
                              </li>
                              <li>
                                 <a href="javascript:void()">
                                    <span class="mr-3 avatar-icon bg-success-lighten-2"><i class="icon-present"></i></span>
                                    <div class="notification-content">
                                       <h6 class="notification-heading">Event Ended Successfully</h6>
                                       <span class="notification-text">One hour ago</span>
                                    </div>
                                 </a>
                              </li>
                              <li>
                                 <a href="javascript:void()">
                                    <span class="mr-3 avatar-icon bg-danger-lighten-2"><i class="icon-present"></i></span>
                                    <div class="notification-content">
                                       <h6 class="notification-heading">Events to Join</h6>
                                       <span class="notification-text">After two days</span>
                                    </div>
                                 </a>
                              </li>
                           </ul>

                        </div>
                     </div>
                  </li>
                  <li class="icons dropdown d-none d-md-flex">
                     <a href="javascript:void(0)" class="log-user">
                        <span class="font-weight-bold"><?= $user['username']; ?> (<?= $user['id']; ?>)</span>
                     </a>
                  </li>
                  <li class="icons dropdown">
                     <div class="user-img c-pointer position-relative" data-toggle="dropdown">
                        <span class="activity active"></span>
                        <img src="<?= base_url('/asset/users/img/' . $user['image']); ?>" height="40" width="40" alt="">

                     </div>
                     <div class="drop-down dropdown-profile   dropdown-menu">
                        <div class="dropdown-content-body">
                           <ul>
                              <li>
                                 <a href="app-profile.html"><i class="icon-user"></i> <span>Profile</span></a>
                              </li>

                              <li>
                                 <a href="email-inbox.html"><i class="icon-envelope-open"></i> <span>Inbox</span>
                                    <div class="badge gradient-3 badge-pill badge-primary">3</div>
                                 </a>
                              </li>

                              <li>
                                 <a href="app-profile.html"><i class="icon-log"></i> <span>Setting</span></a>
                              </li>
                              <hr class="my-2">
                              <!-- <li>
                                 <a href="page-lock.html"><i class="icon-lock"></i> <span>Lock Screen</span></a>
                              </li> -->
                              <li><a href="<?= base_url('/logout'); ?>"><i class="icon-key"></i> <span>Logout</span></a></li>
                           </ul>
                        </div>
                     </div>
                  </li>
               </ul>
            </div>
         </div>
      </div>
      <!--**********************************
            Header end ti-comment-alt
        ***********************************-->

      <!--**********************************
            Sidebar start
        ***********************************-->
      <div class="nk-sidebar">
         <div class="nk-nav-scroll">
            <ul class="metismenu" id="menu">
               <!-- 
               Sidebar Menu 
               | Setiap menu dan sub menu 
               | di masukkan ke dalam database
               | agar menu dapat ditampilkan secara dinamis. 
               -->

               <!-- Query Menu -->
               <?php


               $role_id = session()->get('role_id');


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

                  <li class="nav-label"><?= $m['menu']; ?></li>


                  <!--query Sub menu -->
                  <?php
                  $menuId = $m['id'];
                  $querySubMenu = "SELECT *
                                FROM `tbl_sub_menu` 
                               WHERE `menu_id` = $menuId
                                 AND `is_active` = 1 
                                 ";
                  $subMenu = $db->query($querySubMenu)->getResultArray();
                  ?>

                  <!-- Looping subMenu -->
                  <?php foreach ($subMenu as $sm) : ?>
                     <li>
                        <a class=" <?= ($subMenuTitle == $sm['title']) ? 'active' : ''; ?>" href="<?= base_url($sm['url']); ?>">
                           <i class="<?= $sm['icon']; ?>"></i><span class="nav-text"><?= $sm['title']; ?></span>
                        </a>

                     </li>
                  <?php endforeach; ?>
                  <!-- End looping subMenu -->

               <?php endforeach; ?>
               <!-- End looping Menu -->


            </ul>
         </div>
      </div>
      <!--**********************************
            Sidebar end
        ***********************************-->

      <!--**********************************
            Content body start
        ***********************************-->
      <div class="content-body">

         <!-- Content ditampilkan -->
         <?= $this->renderSection('app_content'); ?>

      </div>
      <!--**********************************
            Content body end
        ***********************************-->



      <!--**********************************
            Footer start
        ***********************************-->
      <div class="footer">
         <div class="copyright">
            <p>Copyright &copy; Cicilku 2020. All rights reserved</p>
         </div>
      </div>
      <!--**********************************
            Footer end
        ***********************************-->
   </div>
   <!--**********************************
        Main wrapper end
    ***********************************-->

   <!--**********************************
        Scripts
    ***********************************-->

   <script src="<?= base_url('asset/plugins/common/common.min.js'); ?>"></script>
   <script src="<?= base_url('asset/js/custom.min.js'); ?>"></script>
   <script src="<?= base_url('asset/js/settings.js'); ?>"></script>
   <script src="<?= base_url('asset/js/gleek.js'); ?>"></script>
   <script src="<?= base_url('asset/js/styleSwitcher.js'); ?>"></script>

   <script src="<?= base_url('asset/plugins/moment/moment.js'); ?>"></script>
   <script src="<?= base_url('asset/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js'); ?>"></script>
   <!-- Clock Plugin JavaScript -->
   <script src="<?= base_url('asset/plugins/clockpicker/dist/jquery-clockpicker.min.js'); ?>"></script>
   <!-- Color Picker Plugin JavaScript -->
   <script src="<?= base_url('asset/plugins/jquery-asColorPicker-master/libs/jquery-asColor.js'); ?>"></script>
   <script src="<?= base_url('asset/plugins/jquery-asColorPicker-master/libs/jquery-asGradient.js'); ?>"></script>
   <script src="<?= base_url('asset/plugins/jquery-asColorPicker-master/dist/jquery-asColorPicker.min.js'); ?>"></script>
   <!-- Date Picker Plugin JavaScript -->
   <script src="<?= base_url('asset/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js'); ?>"></script>

   <!-- Date range Plugin JavaScript -->
   <script src="<?= base_url('asset/plugins/timepicker/bootstrap-timepicker.min.js'); ?>"></script>
   <script src="<?= base_url('asset/plugins/bootstrap-daterangepicker/daterangepicker.js'); ?>"></script>

   <script src="<?= base_url('asset/js/plugins-init/form-pickers-init.js'); ?>"></script>

   <script src="https://code.jquery.com/jquery-3.5.0.js"></script>
   <script>
      $('.change').on('click', function() {
         const menuId = $(this).data('menu');
         const roleId = $(this).data('role');

         $.ajax({
            url: "<?= base_url('/role/changeaccess'); ?>",
            type: 'post',
            data: {
               menuId: menuId,
               roleId: roleId
            },
            success: function() {
               document.location.href = "<?= base_url('role'); ?>";
            },
         });
      });
   </script>

</body>

</html>
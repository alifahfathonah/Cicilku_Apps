<!DOCTYPE html>
<html class="h-100" lang="en">

<head>
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width,initial-scale=1">
   <title>Ups...</title>
   <!-- Favicon icon -->
   <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url('asset/images/favicon.png'); ?>">
   <!-- Font Awesome 5 -->
   <script src="https://kit.fontawesome.com/ccded69204.js" crossorigin="anonymous"></script>
   <!-- Custom Stylesheet -->
   <link href="<?= base_url('asset/css/style.css'); ?>" rel="stylesheet">
   <link href="<?= base_url('asset/plugins/toastr/css/toastr.min.css'); ?>" rel="stylesheet">
</head>


<body class="h-100">

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

   <div class="login-form-bg h-100">
      <div class="container h-100">
         <div class="row justify-content-center h-100">
            <div class="col-xl-6">
               <div class="error-content">
                  <div class="card mb-0">
                     <div class="card-body text-center pt-5">
                        <h1 class="error-text text-primary">404</h1>
                        <h4 class="mt-4"><i class="fa fa-thumbs-down text-danger"></i> Bad Request</h4>
                        <p>
                           <?php if (!empty($message) && $message !== '(null)') : ?>
                              <?= esc($message) ?>
                           <?php else : ?>
                              Maaf! Sepertinya tidak dapat menemukan halaman yang Anda cari.
                           <?php endif ?>
                        </p>
                        <form class="mt-5 mb-5">

                           <div class="text-center mb-4 mt-4"><a href="<?= base_url('/'); ?>" class="btn btn-primary">Go to Homepage</a>
                           </div>
                        </form>
                        <div class="text-center">
                           <p>Copyright &copy; Cicilku 2020. All rights reserved</p>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>

   <!--**********************************
        Scripts
    ***********************************-->
   <script src="https://code.jquery.com/jquery-3.5.0.js"></script>
   <script src="<?= base_url('asset/plugins/common/common.min.js'); ?>"></script>
   <script src="<?= base_url('asset/js/custom.min.js'); ?>"></script>
   <script src="<?= base_url('asset/js/settings.js'); ?>"></script>
   <script src="<?= base_url('asset/js/gleek.js'); ?>"></script>
   <script src="<?= base_url('asset/js/styleSwitcher.js'); ?>"></script>

</body>

</html>
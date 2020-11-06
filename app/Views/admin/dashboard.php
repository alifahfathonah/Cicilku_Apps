<?= $this->extend('template/app_template') ?>

<?= $this->section('app_content'); ?>
<!-- main -->
<main class="main main--ml-sidebar-width">
   <div class="row">
      <header class="main__header col-12 mb-2">
         <div class="main__title">
            <h4><?= $subMenuTitle ?></h4>
            <ul class="breadcrumb">
               <li class="breadcrumb-item active">Dashboard</li>
            </ul>
         </div>
      </header>
   </div><!-- row -->
</main>

<?= $this->endSection(); ?>
<?= $this->extend('template/app_template') ?>

<?= $this->section('app_content'); ?>
<!-- main -->
<main class="main main--ml-sidebar-width">
   <div class="row">
      <header class="main__header col-12 mb-2">

         <div class="main__title">
            <h4><?= $subMenuTitle; ?></h4>
            <ul class="breadcrumb">
               <li class="breadcrumb-item active"><?= $subMenuTitle; ?></li>
            </ul>
         </div>

         <!-- Alert -->
         <?php if (session()->getFlashdata('pesan')) : ?>
            <div id="alert_auto_close" class="alert-close alert alert--success alert--fixed-rb">
               <div class="alert__icon">
                  <span class="fa fa-check-circle"></span>
               </div>
               <div class="alert__description">
                  <p class="text-dark">
                     <?= session()->getFlashdata('pesan'); ?>
                  </p>
               </div>
               <div class="alert__action">
                  <a class="alert__close-btn">&times;</a>
               </div>
            </div>
         <?php endif; ?>


         <!-- User Menu Mangement -->

         <div class="mb-3 col-lg-12 col-sm-12 col-md-12">
            <section class="main__box">
               <?php foreach ($menu as $m) : ?>


                  <h5><?= $m['menu']; ?></h5>
                  <hr>

                  <!-- Add New -->

                  <div class="row">
                     <?php
                     $querySubMenu = $db->table('tbl_sub_menu')->select()->where('menu_id', $m['id'])->where('deleted_at', null)->get();
                     $subMenu = $querySubMenu->getResultArray();

                     ?>
                     <?php foreach ($subMenu as $sm) : ?>
                        <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                           <div class="card text-center shadow">
                              <div class="card-body">
                                 <span style="font-size: 48px; color: Dodgerblue;">
                                    <i class="<?= $sm['icon']; ?>"></i>
                                 </span>
                                 <h5 class="card-title"><?= $sm['title']; ?></h5>
                                 <h6 class="card-subtitle mb-2 text-muted">
                                    <?= $m['menu'] ?>
                                 </h6>
                                 <p class="card-text text-muted">url: <span class="font-italic"><?= $sm['url']; ?></span></p>
                                 <!-- Button Edit -->
                                 <a href="<?= base_url('/admin/submenu/edit?id=' . $sm['id']); ?>" class="card-link btn btn-sm btn-primary">Edit</a>
                                 <!-- Button Delete -->
                                 <a href="" class="card-link btn btn-sm btn-danger" data-toggle="modal" data-target="#Modaldelete_<?= $sm['id']; ?>">Hapus</a>

                                 <!-- modal hapus -->
                                 <div class="modal fade modal--info" id="Modaldelete_<?= $sm['id']; ?>" aria-labelledby="Modaldelete_<?= $sm['id']; ?>">
                                    <div class="modal__content">
                                       <div class="modal__header">
                                          <div class="modal__icon">
                                             <span class="fa fa-ban"></span>
                                          </div>
                                          <div class="modal__title">
                                             <h5><span class="text-danger">Berbahaya</span>, Apakah kamu yakin?</h5>
                                          </div>
                                       </div>
                                       <div class="modal__body">
                                          <p>Aksi ini tidak bisa dibatalkan, ini akan menghapus menu <b><?= $sm['title']; ?> <?= $m['menu']; ?></b> ?</p>
                                       </div>
                                       <div class="modal__footer">
                                          <a href="" class="btn btn--gray-outline" id="close-modal">Batal</a>
                                          <form action="<?= base_url('/admin/submenu/delete'); ?>" method="POST">
                                             <?= csrf_field(); ?>
                                             <input type="hidden" name="submenu_id" value="<?= $sm['id']; ?>">
                                             <input type="hidden" name="title" value="<?= $sm['title']; ?>">
                                             <button type="submit" class="btn btn--red mb-2 mb-sm-0 text-white">Yakin</button>
                                          </form>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     <?php endforeach; ?>

                     <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                        <a href="<?= base_url('/admin/submenu/add?id=' . $m['id']); ?>">
                           <div class="card text-center" style="height: 100%;">
                              <div class="card-body">
                                 <span style="font-size: 120px; color:slategrey;">
                                    <i class="fas fa-plus"></i>
                                 </span>
                              </div>
                           </div>
                        </a>
                     </div>

                  </div>
               <?php endforeach; ?>
            </section><!-- main__box -->
         </div>
      </header>
   </div><!-- row -->
</main>
<!-- Alert auto close -->
<?= $this->endSection(); ?>
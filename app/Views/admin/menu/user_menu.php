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
         <?php elseif ($validation->getError('menu')) : ?>
            <div id="alert_auto_close" class="alert-close alert alert--danger alert--fixed-rb">
               <div class="alert__icon">
                  <span class="fa fa-info-circle"></span>
               </div>
               <div class="alert__description">
                  <p>
                     <?= $validation->getError('menu'); ?>
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
               <h5>User Menu</h5>
               <hr>

               <a href="" class="btn btn--blue" id="show-modal-new">Add New Role User Menu</a>

               <table class="table table--gray mb-3 mt-3">
                  <thead>
                     <tr>
                        <th width="10">No</th>
                        <th>Menu</th>
                        <th>Action</th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php $n = 1;
                     foreach ($menu as $m) : ?>
                        <tr>
                           <td class="text-center">
                              <?= $n++; ?>
                           </td>
                           <td>
                              <?= $m['menu'] ?>
                           </td>
                           <td class="text-center">
                              <a href="" class="badge badge-primary text-white" data-toggle="modal" data-target="#Modal_<?= $m['menu']; ?>"><i class="fas fa-pen"></i></a>

                              <!-- modal edit -->
                              <div class="modal fade modal--info" id="Modal_<?= $m['menu']; ?>" aria-labelledby="Modal_<?= $m['menu']; ?>">
                                 <div class="modal__content">
                                    <div class="modal__header">
                                       <div class="modal__icon">
                                          <i class="fas fa-list"></i>
                                       </div>
                                       <div class="modal__title">
                                          <h5>Update User Menu</h5>
                                       </div>
                                    </div>
                                    <form action="<?= base_url('/admin/user-menu/update') ?>" method="POST">
                                       <div class="modal__body">
                                          <div class="form-group">
                                             <?= csrf_field(); ?>
                                             <input type="hidden" name="menu_id" value="<?= $m['id']; ?>">
                                             <input type="text" class="form-control form--focus-blue" id="addmenu" name="menu" value="<?= $m['menu']; ?>" placeholder="<?= $m['menu']; ?>">
                                          </div>
                                       </div>
                                       <div class="modal__footer">
                                          <a href="" class="btn btn--gray-outline" id="close-modal">Batal</a>
                                          <button href="" class="btn btn--blue mb-2 mb-sm-0" type="submit">Update</button>
                                       </div>
                                    </form>
                                 </div>
                              </div>

                              <a href="" class="text-white badge bg-danger" data-toggle="modal" data-target="#Modaldelete_<?= $m['menu']; ?>"><i class="fas fa-trash-alt"></i></a>

                              <!-- modal hapus -->
                              <div class="modal fade modal--info" id="Modaldelete_<?= $m['menu']; ?>" aria-labelledby="Modaldelete_<?= $m['menu']; ?>">
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
                                       <p>Aksi ini tidak bisa dibatalkan, ini akan menghapus user menu <b><?= $m['menu']; ?></b> ?</p>
                                    </div>
                                    <div class="modal__footer">
                                       <a href="" class="btn btn--gray-outline" id="close-modal">Batal</a>
                                       <form action="<?= base_url('/admin/user-menu/delete'); ?>" method="POST">
                                          <input type="hidden" name="menu_id" value="<?= $m['id']; ?>">
                                          <button type="submit" class="btn btn--red mb-2 mb-sm-0 text-white">Yakin</button>
                                       </form>
                                    </div>
                                 </div>
                              </div>
                           </td>
                        </tr>
                     <?php endforeach; ?>
                  </tbody>
               </table>
            </section><!-- main__box -->
         </div>

      </header>
   </div><!-- row -->
</main>

<!-- modal add -->
<div class="modal modal--info" id="show-modal-new">
   <div class="modal__content">
      <div class="modal__header">
         <div class="modal__icon">
            <i class="fas fa-list"></i>
         </div>
         <div class="modal__title">
            <h5>Add New User Menu</h5>
         </div>
      </div>
      <form action="<?= base_url('/admin/user-menu/save') ?>" method="POST">
         <div class="modal__body">
            <div class="form-group">
               <?= csrf_field(); ?>
               <input type="text" class="form-control form--focus-blue" id="addmenu" placeholder="Add ..." name="menu">
            </div>
         </div>
         <div class="modal__footer">
            <a href="" class="btn btn--gray-outline" id="close-modal">Batal</a>
            <button href="" class="btn btn--blue mb-2 mb-sm-0" type="submit">Tambah</button>
         </div>
      </form>
   </div>
</div>



<script>
   const btnShowModal = document.querySelector("a#show-modal-new");
   const modal = document.querySelector("div#show-modal-new");
   const closeModal = modal.querySelector("a#close-modal");
   btnShowModal.addEventListener('click', e => {
      // hilangkan fungsi default dari tag a
      e.preventDefault();

      // tampilkan modal
      modal.classList.add("modal--fade-in");

      /* tambahkan class .stop-scrolling pada tag <body> untuk menghilangkan scroll halaman, 
      agar halaman tidak bisa di scroll */
      document.body.classList.add("stop-scrolling");
   });

   closeModal.addEventListener('click', e => {
      // hilangkan fungsi default dari tag a
      e.preventDefault();

      // sembunyikan/tutup modal
      modal.classList.remove("modal--fade-in");

      /* hapus class .stop-scrolling pada tag <body> agar 
      halaman bisa di scroll kembali */
      document.body.classList.remove("stop-scrolling");


   });
</script>
<!-- Alert auto close -->
<?= $this->endSection(); ?>
<?= $this->extend('template/app_template') ?>

<?= $this->section('app_content'); ?>
<!-- main -->
<main class="main main--ml-sidebar-width">
   <div class="row">
      <header class="main__header col-12 mb-2">
         <div class="main__title">
            <h4><?= $subMenuTitle ?></h4>
            <ul class="breadcrumb">
               <li class="breadcrumb-item active"><?= $subMenuTitle ?></li>
            </ul>
         </div>


         <?php if (session()->getFlashdata('pesan')) : ?>
            <!-- Alert -->
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
         <!-- main box -->

         <div class="col-12">
            <section class="main__box">
               <h5>Role user access menu </h5>
               <p>
                  <?= (session()->get('admin_unlock') === 0) ? '  <a href="#" class="text-danger" id="show-modal-danger">Unlock</a>' : ''; ?>
               </p>
               <hr>
               <div class="col-12">
                  <table class="table table--green">
                     <thead>
                        <tr>
                           <!-- <th width="10">No</th> -->
                           <th>Menu</th>
                           <?php foreach ($menu as $m) : ?>
                              <th class="text-center">
                                 <?= $m['menu']; ?>
                              </th>
                           <?php endforeach; ?>
                        </tr>
                     </thead>
                     <tbody>
                        <?php $no = 1;

                        foreach ($role as $r) : ?>
                           <tr>
                              <!-- <td><?= $no++; ?></td> -->
                              <td>

                                 <?= $r['role']; ?>
                              </td>
                              <?php foreach ($menu as $m) : ?>
                                 <td class="text-center">
                                    <!-- input checkbox tanpa label -->
                                    <div class="form-check form-check--not-label">
                                       <input type="checkbox" class="change" <?= check_access($r['id'], $m['id']); ?> data-role="<?= $r['id']; ?>" data-menu="<?= $m['id']; ?>" <?= (session()->get('admin_unlock') === 1) ? '' : 'disabled'; ?>>
                                    </div>
                                 </td>
                              <?php endforeach; ?>
                           </tr>
                        <?php endforeach; ?>
                     </tbody>
                  </table>
               </div><!-- col-12 -->
            </section>
         </div>
      </header>
   </div><!-- row -->
</main>

<!-- button show modal danger -->


<!-- modal danger -->
<div class="modal modal--danger" id="modal-danger">
   <div class="modal__content">
      <div class="modal__header">
         <div class="modal__icon">
            <span class="fa fa-ban"></span>
         </div>
         <div class="modal__title">
            <h5><span>Unlock</span></h5>
         </div>
      </div>
      <form action="<?= base_url('/admin/role/unlockaccess'); ?>" method="POST">
         <div class="modal__body">

            <p>Aksi ini memerlukan password administrator, Masukkan password untuk konfirmasi!</p>

            <?= csrf_field(); ?>
            <input type="password" name="password" class="form form--focus-red mt-0" placeholder="Password ...">
         </div>
         <div class="modal__footer">
            <a href="#" class="btn btn--gray-outline" id="close-modal">Batal</a>
            <button type="submit" class="btn btn--red mb-2 mb-sm-0">Open</button>

         </div>
      </form>
   </div>
</div>

<script>
   const btnShowModal = document.querySelector("a#show-modal-danger");
   const modal = document.querySelector("div#modal-danger");
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
<?= $this->endSection(); ?>
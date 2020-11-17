<?= $this->extend('template/app_template') ?>

<?= $this->section('app_content'); ?>
<!-- main -->
<div class="row page-titles mx-0">
   <div class="col p-md-0">
      <ol class="breadcrumb">
         <li class="breadcrumb-item"><a href=""><?= $subMenuTitle; ?></a></li>
      </ol>
   </div>
</div>
<!-- row -->
<div class="container-fluid">
   <div class="row">
      <div class="col-sm-12 col-md-12 col-lg-12">
         <div class="card">
            <div class="card-body">
               <div class="card-title">
                  <h4><?= $subMenuTitle; ?></h4>
               </div>

               <!-- Alert -->
               <?php if (session()->getFlashdata('pesan')) : ?>

                  <div class="alert alert-warning alert-dismissible fade show" id="alert_auto_close">
                     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                     </button> <?= session()->getFlashdata('pesan'); ?>

                  </div>
               <?php endif; ?>


               <?= (session()->get('admin_unlock') === 0) ? '  <a href="" class="btn btn-danger" data-toggle="modal" data-target="#konfirmasiModal">Unlock</a>' : ''; ?>

               <!-- modal unlock -->
               <div class="modal fade" id="konfirmasiModal">
                  <div class="modal-dialog" role="document">
                     <div class="modal-content">
                        <div class="modal-header">
                           <h5 class="modal-title">Konfirmasi Password</h5>
                           <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                           </button>
                        </div>
                        <form action="<?= base_url('/role/unlockaccess'); ?>" method="POST">
                           <div class="modal-body">
                              <p>Aksi ini memerlukan password administrator, Masukkan password untuk konfirmasi!</p>
                              <div class="form-group">
                                 <?= csrf_field(); ?>
                                 <input type="password" name="password" class="form-control input-default mt-0" placeholder="Password ...">
                              </div>
                           </div>
                           <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                              <button type="submit" class="btn btn-primary" type="submit">Konfirmasi</button>
                           </div>
                        </form>
                     </div>
                  </div>
               </div>

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
                                 <input type="checkbox" class="change" <?= check_access($r['id'], $m['id']); ?> data-role="<?= $r['id']; ?>" data-menu="<?= $m['id']; ?>" <?= (session()->get('admin_unlock') === 1) ? '' : 'disabled'; ?>>
                              </td>
                           <?php endforeach; ?>
                        </tr>
                     <?php endforeach; ?>
                  </tbody>
               </table>
            </div>
         </div>
      </div>
   </div>
</div>
<?= $this->endSection(); ?>
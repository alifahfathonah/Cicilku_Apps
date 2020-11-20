<?= $this->extend('template/app_template') ?>

<?= $this->section('app_content'); ?>

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

                  <div class="alert alert-success alert-dismissible fade show" id="alert_auto_close">
                     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                     </button> <?= session()->getFlashdata('pesan'); ?>
                  </div>

               <?php elseif ($validation->getError('guru')) : ?>
                  <div class="alert alert-danger alert-dismissible fade show" id="alert_auto_close">
                     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                     </button> <?= $validation->getError('guru'); ?>
                  </div>


               <?php endif; ?>


               <!-- User Guru Mangement -->

               <div class=" table-responsive">
                  <a href="<?= base_url('teachers/add'); ?>" class="btn btn-primary">Add New Teacher</a>


                  <table class="table table-striped table-bordered zero-configuration mt-3">
                     <thead>
                        <tr>
                           <th width="10px">#</th>
                           <th>Nomor Induk Pegawai</th>
                           <th>Teacher</th>
                           <th>Username</th>
                           <th>Email</th>
                           <th>Telp</th>
                           <th>Status</th>
                           <th>Action</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php
                        $n = 1;
                        foreach ($guru as $g) : ?>
                           <tr>
                              <td><?= $n++; ?></td>
                              <td> <?= $g['nip']; ?></td>
                              <td>
                                 <img src="<?= base_url('asset/users/img/default.png'); ?>" class=" rounded-circle mr-3 img-thumbnail" alt="" width="30px">
                                 <?= $g['nama']; ?>
                              </td>
                              <td><?= $g['username']; ?></td>
                              <td><?= $g['email']; ?></td>
                              <td><?= $g['nohp']; ?></td>
                              <td>
                                 <?= ($g['is_active'] == 1) ? 'active' : 'inactive'; ?>
                              </td>
                              <td>
                                 <a href="<?= base_url('teachers/edit'); ?>">Edit </a> |
                                 <a href="">Delete </a>
                              </td>
                           </tr>
                        <?php
                        endforeach; ?>
                  </table>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
</div>





<!-- Alert auto close -->
<?= $this->endSection(); ?>
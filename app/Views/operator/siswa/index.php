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

               <?php elseif ($validation->getError('siswa')) : ?>
                  <div class="alert alert-danger alert-dismissible fade show" id="alert_auto_close">
                     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                     </button> <?= $validation->getError('siswa'); ?>
                  </div>


               <?php endif; ?>


               <!-- User siswa Mangement -->

               <div class=" table-responsive">
                  <a href="<?= base_url('students/add'); ?>" class="btn btn-primary">Add New students</a>


                  <table class="table table-striped table-bordered zero-configuration mt-3">
                     <thead>
                        <tr>
                           <th width="10px">#</th>
                           <th>Students</th>
                           <th>Nomor Induk Siswa</th>
                           <th>Status</th>
                           <th>Last Activity</th>
                           <th>Action</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php
                        $n = 1;
                        foreach ($siswa as $s) : ?>
                           <tr>
                              <td><?= $n++; ?></td>

                              <td>
                                 <img src="<?= base_url('asset/users/img/' . $s['image']); ?>" class=" rounded-circle mr-3 img-thumbnail" alt="" width="30px">
                                 <?= $s['nama']; ?>
                              </td>
                              <td> <?= $s['nisn']; ?></td>

                              <td>
                                 <?= ($s['is_active'] == 1) ? 'active' : 'inactive'; ?>
                              </td>
                              <td>Update Profile</td>
                              <td>
                                 <a href="<?= base_url('/students/' . encrypt_url($s['id'])); ?>" class="Button btn-sm btn-success">Detail</a>
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
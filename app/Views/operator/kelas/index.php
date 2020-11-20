<?= $this->extend('template/app_template') ?>

<?= $this->section('app_content'); ?>

<div class="row page-titles mx-0">
   <div class="col p-md-0">
      <ol class="breadcrumb">
         <li class="breadcrumb-item"><a href="javascript:void(0)"><?= $subMenuTitle; ?></a></li>
         <?php if (!empty($detail_semester)) : ?>
            <li class="breadcrumb-item active"><?= date("Y", $detail_semester['periode_awal'])  ?>/<?= date("Y", $detail_semester['periode_akhir'])  ?> (<?= $detail_semester['semester']; ?>)</li>
         <?php endif; ?>
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
               <div class="basic-dropdown">
                  <div class="dropdown">
                     <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">Select Semester</button>
                     <div class="dropdown-menu">
                        <?php foreach ($semester as $s) : ?>
                           <a class="dropdown-item" href="<?= base_url('/class/semester/' . encrypt_url($s['id'])); ?>">
                              <?= date("Y", $s['periode_awal'])  ?>/<?= date("Y", $s['periode_akhir'])  ?> (<?= $s['semester']; ?>)
                           </a>
                        <?php endforeach; ?>
                     </div>
                  </div>
               </div>

            </div>
         </div>
      </div>
   </div>
</div>


<?php if (!empty($detail_semester)) : ?>


   <div class="container-fluid">
      <div class="row">
         <div class="col-sm-12 col-md-12 col-lg-12">
            <div class="card">
               <div class="card-body">
                  <div class="card-title">
                     <h4>List Kelas Semester <?= $detail_semester['semester']; ?> Tahun Ajaran <?= date("Y", $detail_semester['periode_awal'])  ?>/<?= date("Y", $detail_semester['periode_akhir'])  ?></h4>
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

                  <a href="<?= base_url('/class/' . encrypt_url($detail_semester['id']) . '/add'); ?>" class="btn btn-primary">Add New Class</a>

                  <div class="row mt-3">
                     <div class="table-responsive">
                        <table class="table">
                           <thead>
                              <tr>
                                 <th>#</th>
                                 <th>Class</th>
                                 <th>Teacher</th>
                                 <th>Status</th>
                                 <th>Action</th>
                              </tr>
                           </thead>
                           <tbody>
                              <?php
                              $i = 1;
                              foreach ($kelas as $k) : ?>
                                 <tr>
                                    <th><?= $i++; ?></th>
                                    <td><?= $k['kelas']; ?></td>
                                    <td>
                                       <?php
                                       $queryGuru = $db->table('tbl_guru')->where('id', $k['guru_id'])->get();
                                       $guru = $queryGuru->getResultArray();
                                       ?>
                                       <img src="<?= base_url('asset/users/img/' . $guru[0]['image']); ?>" class=" rounded-circle mr-3 img-thumbnail" alt="" width="30px">
                                       <?= $guru[0]['nama'] ?>
                                    </td>
                                    <td>
                                       <span class="badge <?= ($k['is_active'] == 1) ? 'badge-success' : 'badge-danger'; ?>  px-3">
                                          <?= ($k['is_active'] == 1) ? 'active' : 'inactive'; ?>
                                       </span>
                                    </td>
                                    <td>

                                       <a href="<?= base_url('class/' . encrypt_url($detail_semester['id']) . '/' . encrypt_url($k['id']) . '/edit'); ?>" class="text-primary">Edit</a> |
                                       <a href="" class="text-danger" data-toggle="modal" data-target="#deleteModalg<?= $k['id']; ?>">Delete</a>

                                       <!-- Modal Delete -->
                                       <div class="modal fade" id="deleteModalg<?= $k['id']; ?>">
                                          <div class="modal-dialog" role="document">
                                             <div class="modal-content">
                                                <div class="modal-header">
                                                   <h5 class="modal-text"><span class="text-danger">Dangerous</span>, are you sure?</h5>
                                                   <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                                   </button>
                                                </div>
                                                <div class="modal-body">
                                                   <p>This action cannot be undone, it will delete data <b><?= $k['kelas']; ?></b> ?</p>
                                                </div>
                                                <div class="modal-footer">
                                                   <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                   <form action="<?= base_url('/class/delete'); ?>" method="POST">
                                                      <input type="hidden" name="id" value="<?= $k['id']; ?>">
                                                      <input type="hidden" name="kelas" value="<?= $k['kelas']; ?>">
                                                      <button type="submit" class="btn btn-danger">Delete</button>
                                                   </form>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </td>
                                 </tr>
                              <?php endforeach; ?>
                           </tbody>
                        </table>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
<?php else : ?>

<?php endif; ?>



<!-- Alert auto close -->
<?= $this->endSection(); ?>
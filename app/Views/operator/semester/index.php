<?= $this->extend('template/app_template') ?>

<?= $this->section('app_content'); ?>

<div class="row page-titles mx-0">
   <div class="col p-md-0">
      <ol class="breadcrumb">
         <li class="breadcrumb-item"><a href="javascript:void(0)"><?= $subMenuTitle; ?></a></li>
      </ol>
   </div>
</div>
<!-- row -->

<div class="container-fluid">
   <div class="row">
      <div class="col-sm-12 col-md-6 col-lg-6">
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

               <?php elseif ($validation->getError('semester')) : ?>
                  <div class="alert alert-danger alert-dismissible fade show" id="alert_auto_close">
                     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                     </button> <?= $validation->getError('semester'); ?>
                  </div>


               <?php endif; ?>


               <!-- Semester Mangement -->

               <div class=" table-responsive">
                  <a href="" class="btn btn-primary" data-toggle="modal" data-target="#newModal">Add New Semester</a>

                  <!-- modal add -->
                  <div class="modal fade" id="newModal">
                     <div class="modal-dialog" role="document">
                        <div class="modal-content">
                           <div class="modal-header">
                              <h5 class="modal-title">Add New Semester</h5>
                              <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                              </button>
                           </div>
                           <form action="<?= base_url('semester/save') ?>" method="POST">
                              <?= csrf_field(); ?>
                              <div class="modal-body">
                                 <div class="form-group">
                                    <label>Semester</label>
                                    <select class="form-control input-default" name="semester">
                                       <option>Genap</option>
                                       <option>Ganjil</option>
                                    </select>
                                 </div>
                                 <div class="form-group">
                                    <label>Periode</label>
                                    <div class="input-daterange input-group" id="date-range">
                                       <input type="text" class="form-control input-default" name="start">
                                       <span class="p-3"> - </span>
                                       <input type="text" class="form-control input-default" name="end">
                                    </div>
                                 </div>

                              </div>
                              <div class="modal-footer">
                                 <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                 <button type="submit" class="btn btn-primary" type="submit">Add</button>
                              </div>
                           </form>
                        </div>
                     </div>
                  </div>



                  <table class="table table--gray mb-3 mt-3">
                     <thead>
                        <tr>
                           <th>#</th>
                           <th>Semester (Tahun Ajaran)</th>
                           <th>Periode</th>
                           <th>Action</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php $n = 1;
                        foreach ($semester as $s) : ?>
                           <tr>
                              <td>
                                 <?= $n++; ?>
                              </td>
                              <td>
                                 <?= $s['semester'] ?> (<?= date("Y", $s['periode_awal'])  ?> - <?= date("Y", $s['periode_akhir'])  ?>)
                              </td>
                              <td>
                                 <?= date("d M Y", $s['periode_awal'])  ?> - <?= date("d M Y", $s['periode_akhir'])  ?>
                              </td>

                              <td>
                                 <!-- Button trigger modal Edit -->
                                 <a href="<?= base_url('/semester/edit?sid=' . $s['id']); ?>" class="badge badge-primary px-2">Edit</a>

                                 <a href="" class="badge badge-danger" data-toggle="modal" data-target="#deleteModal<?= $s['semester']; ?>">Delete</a>

                                 <!-- Modal Delete -->
                                 <div class="modal fade" id="deleteModal<?= $s['semester']; ?>">
                                    <div class="modal-dialog" role="document">
                                       <div class="modal-content">
                                          <div class="modal-header">
                                             <h5 class="modal-text"><span class="text-danger">Dangerous</span>, are you sure?</h5>
                                             <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                             </button>
                                          </div>
                                          <div class="modal-body">
                                             <p>This action cannot be undone, it will delete The Semester <b><?= $s['semester']; ?></b> ?</p>
                                          </div>
                                          <div class="modal-footer">
                                             <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                             <form action="<?= base_url('semester/delete'); ?>" method="POST">
                                                <input type="hidden" name="sid" value="<?= $s['id']; ?>">
                                                <input type="hidden" name="periode" value=" <?= date("d M Y", $s['periode_awal'])  ?> - <?= date("d M Y", $s['periode_akhir'])  ?>">
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





<!-- Alert auto close -->
<?= $this->endSection(); ?>
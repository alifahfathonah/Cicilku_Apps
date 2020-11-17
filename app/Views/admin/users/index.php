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

               <?php elseif ($validation->getError('menu')) : ?>
                  <div class="alert alert-danger alert-dismissible fade show" id="alert_auto_close">
                     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                     </button> <?= $validation->getError('menu'); ?>
                  </div>


               <?php endif; ?>


               <!-- User Role Mangement -->

               <div class=" table-responsive">
                  <a href="" class="btn btn-primary" data-toggle="modal" data-target="#newModal">Add New User Role</a>

                  <!-- modal add -->
                  <div class="modal fade" id="newModal">
                     <div class="modal-dialog" role="document">
                        <div class="modal-content">
                           <div class="modal-header">
                              <h5 class="modal-title">Add New User Role</h5>
                              <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                              </button>
                           </div>
                           <form action="<?= base_url('users/save') ?>" method="POST">
                              <div class="modal-body">
                                 <div class="form-group">
                                    <?= csrf_field(); ?>
                                    <input type="text" class="form-control input-default" id="addrole" placeholder="Add ..." name="role">
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
                           <th>No</th>
                           <th>Role</th>
                           <th>Action</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php $n = 1;
                        foreach ($role as $r) : ?>
                           <tr>
                              <td>
                                 <?= $n++; ?>
                              </td>
                              <td>
                                 <?= $r['role'] ?>
                              </td>
                              <td>
                                 <!-- Button trigger modal Edit -->
                                 <a href="" class="badge badge-primary px-2" data-toggle="modal" data-target="#basicModal<?= $r['role']; ?>">Edit</a>
                                 <!-- Modal Edit -->
                                 <div class="modal fade" id="basicModal<?= $r['role']; ?>">
                                    <div class="modal-dialog" role="document">
                                       <div class="modal-content">
                                          <div class="modal-header">
                                             <h5 class="modal-title">Update User Role</h5>
                                             <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                             </button>
                                          </div>
                                          <form action="<?= base_url('users/update') ?>" method="POST">
                                             <div class="modal-body">
                                                <div class="form-group">
                                                   <?= csrf_field(); ?>
                                                   <input type="hidden" name="role_id" value="<?= $r['id']; ?>">
                                                   <input type="text" class="form-control input-default" id="addrole" name="role" value="<?= $r['role']; ?>" placeholder="<?= $r['role']; ?>">
                                                </div>
                                             </div>
                                             <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary" id="toastr-success-bottom-right">Update</button>
                                             </div>
                                          </form>
                                       </div>
                                    </div>
                                 </div>

                                 <a href="" class="badge badge-danger" data-toggle="modal" data-target="#deleteModal<?= $r['role']; ?>">Delete</a>

                                 <!-- Modal Delete -->
                                 <div class="modal fade" id="deleteModal<?= $r['role']; ?>">
                                    <div class="modal-dialog" role="document">
                                       <div class="modal-content">
                                          <div class="modal-header">
                                             <h5 class="modal-text"><span class="text-danger">Dangerous</span>, are you sure?</h5>
                                             <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                             </button>
                                          </div>
                                          <div class="modal-body">
                                             <p>This action cannot be undone, it will delete The User Role <b><?= $r['role']; ?></b> ?</p>
                                          </div>
                                          <div class="modal-footer">
                                             <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                             <form action="<?= base_url('users/delete'); ?>" method="POST">
                                                <input type="hidden" name="role_id" value="<?= $r['id']; ?>">
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
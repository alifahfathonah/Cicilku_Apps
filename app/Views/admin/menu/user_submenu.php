<?= $this->extend('template/app_template') ?>

<?= $this->section('app_content'); ?>

<div class="row page-titles mx-0">
   <div class="col p-md-0">
      <ol class="breadcrumb">
         <li class="breadcrumb-item"><a href="<?= base_url('/admin/menu'); ?>">Menu</a></li>
         <li class="breadcrumb-item active"><a href="javascript:void(0)"><?= $subMenuTitle; ?></a></li>
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
               <?php endif; ?>


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
                                 <span style="font-size: 30px;">
                                    <i class="<?= $sm['icon']; ?>"></i>
                                 </span>
                                 <h5 class="mb-4"><?= $sm['title']; ?></h5>
                                 <h6 class="card-subtitle mb-2 text-muted">
                                    <?= $m['menu'] ?>
                                 </h6>
                                 <p class="card-text text-muted">url: <span class="font-italic"><?= $sm['url']; ?></span></p>
                                 <!-- Button Edit -->
                                 <a href="<?= base_url('/admin/submenu/edit?id=' . $sm['id']); ?>" class="card-link btn btn btn-primary">Edit</a>


                                 <button href="" class="card-link btn btn btn-danger" data-toggle="modal" data-target="#Modaldelete_<?= $sm['id']; ?>">Delete</button>
                                 <!-- Modal Delete -->
                                 <div class="modal fade" id="Modaldelete_<?= $sm['id']; ?>">
                                    <div class="modal-dialog" role="document">
                                       <div class="modal-content">
                                          <div class="modal-header">
                                             <h5 class="modal-text"><span class="text-danger">Dangerous</span>, are you sure?</h5>
                                             <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                             </button>
                                          </div>
                                          <div class="modal-body">
                                             <p>This action cannot be undone, it will delete The User Menu <b><?= $sm['title']; ?> <?= $m['menu']; ?></b> ?</p>
                                          </div>
                                          <div class="modal-footer">
                                             <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                             <form action="<?= base_url('/admin/submenu/delete'); ?>" method="POST">
                                                <?= csrf_field(); ?>
                                                <input type="hidden" name="submenu_id" value="<?= $sm['id']; ?>">
                                                <input type="hidden" name="title" value="<?= $sm['title']; ?>">
                                                <button type="submit" class="btn btn-danger text-white">Delete</button>
                                             </form>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <!-- Button Delete -->
                              </div>
                           </div>
                        </div>
                     <?php endforeach; ?>

                     <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                        <a href="<?= base_url('/admin/submenu/add?id=' . $m['id']); ?>">
                           <div class="card text-center">
                              <div class="card-body">
                                 <span style="font-size: 100px;">
                                    <i class="fas fa-plus"></i>
                                 </span>
                              </div>
                           </div>
                        </a>
                     </div>

                  </div>
               <?php endforeach; ?>

            </div>
         </div>
      </div>
   </div>
</div>





<!-- Alert auto close -->
<?= $this->endSection(); ?>
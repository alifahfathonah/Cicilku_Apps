<?= $this->extend('template/app_template') ?>

<?= $this->section('app_content'); ?>

<div class="row page-titles mx-0">
   <div class="col p-md-0">
      <ol class="breadcrumb">
         <li class="breadcrumb-item"><a href=""><?= $subMenuTitle; ?></a></li>
         <li class="breadcrumb-item active text-capitalize"><a href=""><?= $title; ?></a></li>
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
                  <!-- <h4 class="text-capitalize">Profile</h4> -->
               </div>
               <div class="row">
                  <div class="col-lg-4 col-md-4 col-sm-12">


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
                     <div class="media align-items-center mb-4">
                        <img class="mr-3" src="<?= base_url('/asset/users/img/' . $siswa['image']); ?>" width="80" height="80" alt="">
                        <div class="media-body">
                           <?php if ($siswa['is_active'] == 1) : ?>
                              <span class="badge badge-success text-white">Active</span>
                           <?php else : ?>
                              <span class="badge badge-danger text-white">Inactive</span>
                           <?php endif; ?>
                           <h3 class="mb-0 text-capitalize"><?= $siswa['nama']; ?></h3>
                           <p class="text-muted mb-0">ID Rekening : <?= $rekening['no_rekening']; ?></p>

                        </div>
                     </div>


                     <h4>Detail Students</h4>

                     <!-- <p class="text-muted">Namang</p> -->
                     <ul class="card-profile__info">
                        <li class="mb-1"><strong class="text-dark">Role : </strong> <span>Students</span></li>
                        <li class="mb-1"><strong class="text-dark">Username : </strong> <span><?= $siswa['username']; ?></span></li>
                        <li class="mb-1"><strong class="text-dark">Last Activity : </strong> <span> -</span></li>
                        <li class="mb-1"><strong class="text-dark">Teacher : </strong> <span><?= $guru['nama']; ?></span></li>
                        <li class="mb-1"><strong class="text-dark">Class : </strong><span><?= $kelas['kelas']; ?></span></li>
                        <li class="mb-1"><strong class="text-dark">ID Rekening</strong> <span>4</span></li>
                        <li><strong class="text-dark">Email : </strong> <span><?= $siswa['email']; ?></span></li>
                        <li class="mb-1"><strong class="text-dark">Parents : </strong> <span><?= $siswa['orangtua']; ?></span></li>
                        <li class="mb-1"><strong class="text-dark">Telp : </strong> <span><?= $siswa['nohp']; ?></span></li>
                        <li class="mb-1"><strong class="text-dark">Gender : </strong> <span class="text-capitalize"><?= $siswa['jk']; ?></span></li>
                        <li class="mb-1"><strong class="text-dark">Born : </strong> <span><?= date("d M Y", $siswa['ttl'])  ?></span></li>
                        <li class="mb-1"><strong class="text-dark">Address : </strong> <span><?= $siswa['alamat']; ?></span></li>
                     </ul>
                  </div>
                  <div class="col-lg-8 col-md-8 col-sm-12">
                     <!-- <h4 class="card-title">Default Tab</h4> -->
                     <!-- Nav tabs -->
                     <div class="default-tab">
                        <ul class="nav nav-tabs mb-3" role="tablist">
                           <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#transaction">Savings</a>
                           </li>
                           <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#activitys">Activity</a>
                           </li>
                           <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#setting">Settings</a>
                           </li>
                        </ul>
                        <div class="tab-content">
                           <div class="tab-pane fade show active" id="transaction" role="tabpanel">
                              <div class="p-t-15">
                                 <h4>This is Transaction</h4>
                                 <div class="form-group">

                                 </div>
                                 <a href="http://"></a>
                              </div>
                           </div>
                           <div class="tab-pane fade" id="activitys">
                              <div class="p-t-15">
                                 <h4>This is Activity Students</h4>
                                 <div id="activity" style="overflow-y: scroll; max-height: 300px;">
                                    <div class="media border-bottom-1 pt-3 pb-3">
                                       <img width="35" src="./images/avatar/1.jpg" class="mr-3 rounded-circle">
                                       <div class="media-body">
                                          <h5>Received New Order</h5>
                                          <p class="mb-0">I shared this on my fb wall a few months back,</p>
                                       </div><span class="text-muted ">April 24, 2018</span>
                                    </div>
                                    <div class="media border-bottom-1 pt-3 pb-3">
                                       <img width="35" src="./images/avatar/2.jpg" class="mr-3 rounded-circle">
                                       <div class="media-body">
                                          <h5>iPhone develered</h5>
                                          <p class="mb-0">I shared this on my fb wall a few months back,</p>
                                       </div><span class="text-muted ">April 24, 2018</span>
                                    </div>
                                    <div class="media border-bottom-1 pt-3 pb-3">
                                       <img width="35" src="./images/avatar/2.jpg" class="mr-3 rounded-circle">
                                       <div class="media-body">
                                          <h5>3 Order Pending</h5>
                                          <p class="mb-0">I shared this on my fb wall a few months back,</p>
                                       </div><span class="text-muted ">April 24, 2018</span>
                                    </div>
                                    <div class="media border-bottom-1 pt-3 pb-3">
                                       <img width="35" src="./images/avatar/2.jpg" class="mr-3 rounded-circle">
                                       <div class="media-body">
                                          <h5>Join new Manager</h5>
                                          <p class="mb-0">I shared this on my fb wall a few months back,</p>
                                       </div><span class="text-muted ">April 24, 2018</span>
                                    </div>
                                    <div class="media border-bottom-1 pt-3 pb-3">
                                       <img width="35" src="./images/avatar/2.jpg" class="mr-3 rounded-circle">
                                       <div class="media-body">
                                          <h5>Branch open 5 min Late</h5>
                                          <p class="mb-0">I shared this on my fb wall a few months back,</p>
                                       </div><span class="text-muted ">April 24, 2018</span>
                                    </div>
                                    <div class="media border-bottom-1 pt-3 pb-3">
                                       <img width="35" src="./images/avatar/2.jpg" class="mr-3 rounded-circle">
                                       <div class="media-body">
                                          <h5>New support ticket received</h5>
                                          <p class="mb-0">I shared this on my fb wall a few months back,</p>
                                       </div><span class="text-muted ">April 24, 2018</span>
                                    </div>
                                    <div class="media pt-3 pb-3">
                                       <img width="35" src="./images/avatar/3.jpg" class="mr-3 rounded-circle">
                                       <div class="media-body">
                                          <h5>Facebook Post 30 Comments</h5>
                                          <p class="mb-0">I shared this on my fb wall a few months back,</p>
                                       </div><span class="text-muted ">April 24, 2018</span>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="tab-pane fade" id="setting">
                              <div class="p-t-15">
                                 <h4>Settings</h4>
                                 <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove.</p>
                                 <a href="<?= base_url('/students/' . encrypt_url($siswa['id']) . '/edit') ?>" class="btn btn-primary">Edit This Students</a>
                                 <a href="<?= base_url('/students/' . encrypt_url($siswa['id']) . '/edit') ?>" class="btn btn-primary">Update Class Students</a>
                                 <a href="" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal<?= $siswa['id']; ?>">Delete Account</a>

                                 <!-- Modal Delete -->
                                 <div class="modal fade" id="deleteModal<?= $siswa['id']; ?>">
                                    <div class="modal-dialog" role="document">
                                       <div class="modal-content">
                                          <div class="modal-header">
                                             <h5 class="modal-text"><span class="text-danger">Dangerous</span>, are you sure?</h5>
                                             <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                             </button>
                                          </div>
                                          <div class="modal-body">
                                             <p>This action cannot be undone, it will delete account <b><?= $siswa['nama']; ?></b> ?</p>
                                          </div>
                                          <div class="modal-footer">
                                             <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                             <form action="<?= base_url('/students/delete'); ?>" method="POST">
                                                <input type="hidden" name="id" value="<?= $siswa['id']; ?>">
                                                <input type="hidden" name="id_rekening" value="<?= $rekening['id']; ?>">
                                                <input type="hidden" name="nama" value="<?= $siswa['nama']; ?>">
                                                <button type="submit" class="btn btn-danger">Deleted Account</button>
                                             </form>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- <div class="col-md-12">
         <div class="card">
            <div class="card-body">
               <h4 class="card-title">Transaction History</h4>
               <p class="text-muted">Riwayat tabungan per semester</p>
               <div class="basic-dropdown">
                  <div class="dropdown">
                     <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">Semester(Periode)</button>
                     <div class="dropdown-menu">
                        <?php foreach ($semester as $s) : ?>
                           <a class="dropdown-item" href="<?= base_url('/students/' . encrypt_url($siswa['id']) . '/transaction/?history=' . $s['id']); ?>"> <?= $s['semester'] ?> (<?= date("d M Y", $s['periode_awal'])  ?> - <?= date("d M Y", $s['periode_akhir'])  ?>)</a>
                        <?php endforeach; ?>
                     </div>
                  </div>
               </div>

               
               <div class="default-tab mt-3">
                  <ul class="nav nav-tabs mb-3" role="tablist">
                     <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#kelas1">Riwayat Masuk</a>
                     </li>
                     <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#kelas2">Riwayat Keluar</a>
                     </li>
                  </ul>
                  <div class="tab-content">
                     <div class="tab-pane fade show active" id="kelas1" role="tabpanel">
                        <div class="p-t-15">
                           <h4>This is home title</h4>
                           <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove.</p>
                           <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove.</p>
                        </div>
                     </div>
                     <div class="tab-pane fade" id="kelas2">
                        <div class="p-t-15">
                           <h4>This is profile title</h4>
                           <p>Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor.</p>
                           <p>Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor.</p>
                        </div>
                     </div>
                     <div class="tab-pane fade" id="kelas3">
                        <div class="p-t-15">
                           <h4>This is contact title</h4>
                           <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove.</p>
                           <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove.</p>
                        </div>
                     </div>
                     <div class="tab-pane fade" id="kelas4">
                        <div class="p-t-15">
                           <h4>This is message title</h4>
                           <p>Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor.</p>
                           <p>Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor.</p>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div> -->
   </div>
</div>
</div>





<!-- Alert auto close -->
<?= $this->endSection(); ?>
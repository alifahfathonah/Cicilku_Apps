<?= $this->extend('template/app_template') ?>

<?= $this->section('app_content'); ?>


<div class="row page-titles mx-0">
   <div class="col p-md-0">
      <ol class="breadcrumb">
         <li class="breadcrumb-item active"><a href="javascript:void(0)"><?= $subMenuTitle; ?></a></li>
      </ol>
   </div>
</div>
<!-- row -->

<div class="container-fluid">
   <div class="row">
      <div class="col-md-12">
         <div class="card">
            <div class="card-body">
               <h4 class="card-title"><?= $subMenuTitle; ?></h4>
               <!-- Nav tabs -->
               <div class="default-tab">
                  <ul class="nav nav-tabs mb-3" role="tablist">
                     <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#konfirmasi">Konfirmasi Deposit</a>
                     </li>
                     <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#contact">Konfirmasi Pengeluaran</a>
                     </li>
                     <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#setoran">Transaksi Masuk</a>
                     </li>

                     <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#message">Transaksi Keluar</a>
                     </li>
                  </ul>
                  <div class="tab-content">
                     <div class="tab-pane fade show active" id="konfirmasi" role="tabpanel">
                        <div class="p-t-15">
                           <h4>This is konfirmasi title</h4>
                           <p>Setoran Tabungan siswa perkelas akan dikonfirmasi pada halaman ini.</p>

                           <div id="accordion-two" class="accordion">

                              <?php foreach ($kelas as $k) : ?>
                                 <?php
                                 $guru = $db->table('tbl_guru')->where('id', $k['guru_id'])->get()->getResult();
                                 $query = $db->table('tbl_setoran')->where('guru_id', $k['guru_id'])->where('tbl_setoran.status', 'pending');
                                 $setoran = $query->get()->getResultArray();

                                 ?>
                                 <?php if (empty($setoran)) : ?>

                                 <?php else : ?>
                                    <div class="card">
                                       <div class="card-header">
                                          <h5 class="mb-0" data-toggle="collapse" data-target="#collapseOne<?= $k['id']; ?>" aria-expanded="true" aria-controls="collapseOne<?= $k['id']; ?>"><i class="fa" aria-hidden="true"></i> <?= $k['kelas']; ?> (<?= $guru[0]->nama; ?>) </h5>
                                       </div>
                                       <div id="collapseOne<?= $k['id']; ?>" class="collapse" data-parent="#accordion-two">
                                          <div class="card-body">



                                             <div class=" table-responsive">
                                                <table class="table table-striped table-bordered zero-configuration mt-3">
                                                   <thead>
                                                      <tr>
                                                         <th width="10px">#</th>
                                                         <th>Students</th>
                                                         <th>No Rekening</th>
                                                         <th>Keterangan</th>
                                                         <th>Tanggal Masuk</th>
                                                         <th>Status</th>
                                                         <th>Nominal</th>
                                                      </tr>
                                                   </thead>
                                                   <tbody>
                                                      <?php
                                                      $n = 1;
                                                      foreach ($setoran as $s) : ?>

                                                         <?php
                                                         $siswa = $db->table('tbl_siswa')->where('id', $s['siswa_id'])->get()->getResult();
                                                         ?>

                                                         <tr>
                                                            <td><?= $n++; ?></td>

                                                            <td>
                                                               <img src="<?= base_url('asset/users/img/' . $siswa[0]->image); ?>" class=" rounded-circle mr-3 img-thumbnail" alt="" width="30px">
                                                               <?= $siswa[0]->nama; ?>
                                                            </td>
                                                            <td>
                                                               <?php
                                                               $rekening = $db->table('tbl_rekening')->where('siswa_id', $siswa[0]->id)->get()->getResult();
                                                               ?>
                                                               <?= $rekening[0]->no_rekening; ?>
                                                            </td>



                                                            <td>
                                                               <?= (empty($s->keterangan)) ? '-' : $s->keterangan;; ?>
                                                            </td>

                                                            <td>
                                                               <?= date('d-M-Y', $s['created_at']); ?>
                                                            </td>
                                                            <td>
                                                               <span class="badge badge-pill badge-info"><?= $s['status']; ?></span>
                                                            </td>
                                                            <td>
                                                               <?= rupiah($s['nominal']); ?>
                                                            </td>
                                                         </tr>

                                                      <?php
                                                      endforeach; ?>
                                                      <tr>
                                                         <td colspan="6">
                                                            <span class="float-right font-weight-bold">Total</span>
                                                         </td>
                                                         <td class="font-weight-bold">
                                                            <?php
                                                            $guru_id = $k['guru_id'];
                                                            $queryMenu = "SELECT sum(nominal) AS total FROM tbl_setoran WHERE guru_id = $guru_id";
                                                            $total = $db->query($queryMenu)->getResult();

                                                            echo rupiah($total[0]->total);
                                                            ?>
                                                         </td>
                                                      </tr>
                                                </table>
                                                <a href="" class="btn btn-success text-white float-right" data-toggle="modal" data-target="#konfirmasi<?= $k['id']; ?>">Konfirmasi Setoran</a>

                                                <!-- Modal Delete -->
                                                <div class="modal fade" id="konfirmasi<?= $k['id']; ?>">
                                                   <div class="modal-dialog" role="document">
                                                      <div class="modal-content">
                                                         <div class="modal-header">
                                                            <h5 class="modal-text"><span class="text-success">Konfirmasi Setoran</span>, anda yakin?</h5>
                                                            <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                                            </button>
                                                         </div>
                                                         <div class="modal-body">
                                                            <p>Pastikan total data setoran sesuai dengan uang tunai setoran <b><?= $k['kelas']; ?></b> ,
                                                               total setoran</p>
                                                            <h5 class=""><?= rupiah($total[0]->total); ?></h5>
                                                         </div>
                                                         <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            <form action="<?= base_url('/savings/update'); ?>" method="POST">
                                                               <?= csrf_field(); ?>

                                                               <?php foreach ($setoran as $sk) : ?>
                                                                  <input type="hidden" name="id_setoran[]" value="<?= $sk['id']; ?>">
                                                               <?php endforeach; ?>
                                                               <button type="submit" class="btn btn-success">Yakin</button>
                                                            </form>
                                                         </div>
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 <?php endif; ?>
                              <?php endforeach; ?>
                           </div>
                        </div>
                     </div>
                     <div class="tab-pane fade" id="setoran">
                        <div class="p-t-15">
                           <h4>This is profile title</h4>
                           <p>Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor.</p>




                           <div class=" table-responsive">
                              <table class="table table-striped table-bordered zero-configuration mt-3">
                                 <thead>
                                    <tr>
                                       <th width="10px">#</th>
                                       <th>Students</th>
                                       <th>No Rekening</th>
                                       <th>Keterangan</th>
                                       <th>Tanggal Masuk</th>
                                       <th>Status</th>
                                       <th>Nominal</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <?php

                                    foreach ($transaksiMasuk as $s) : ?>

                                       <?php
                                       $siswa = $db->table('tbl_siswa')->where('id', $s['siswa_id'])->get()->getResult();
                                       ?>

                                       <tr>
                                          <td><?= $n++; ?></td>

                                          <td>
                                             <img src="<?= base_url('asset/users/img/' . $siswa[0]->image); ?>" class=" rounded-circle mr-3 img-thumbnail" alt="" width="30px">
                                             <?= $siswa[0]->nama; ?>
                                          </td>
                                          <td>
                                             <?php
                                             $rekening = $db->table('tbl_rekening')->where('siswa_id', $siswa[0]->id)->get()->getResult();
                                             ?>
                                             <?= $rekening[0]->no_rekening; ?>
                                          </td>



                                          <td>
                                             <?= (empty($s->keterangan)) ? '-' : $s->keterangan;; ?>
                                          </td>

                                          <td>
                                             <?= date('d-M-Y', $s['created_at']); ?>
                                          </td>
                                          <td>
                                             <span class="badge badge-pill badge-info"><?= $s['status']; ?></span>
                                          </td>
                                          <td>
                                             <?= rupiah($s['nominal']); ?>
                                          </td>
                                       </tr>

                                    <?php
                                    endforeach; ?>
                                    <tr>
                                       <td colspan="6">
                                          <span class="float-right font-weight-bold">Total</span>
                                       </td>
                                       <td class="font-weight-bold">
                                          <?php
                                          $guru_id = $k['guru_id'];
                                          $queryMenu = "SELECT sum(nominal) AS total FROM tbl_setoran WHERE guru_id = $guru_id";
                                          $total = $db->query($queryMenu)->getResult();

                                          echo rupiah($total[0]->total);
                                          ?>
                                       </td>
                                    </tr>
                              </table>
                              <a href="" class="btn btn-success text-white float-right" data-toggle="modal" data-target="#konfirmasi<?= $k['id']; ?>">Konfirmasi Setoran</a>

                              <!-- Modal Delete -->
                              <div class="modal fade" id="konfirmasi<?= $k['id']; ?>">
                                 <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                       <div class="modal-header">
                                          <h5 class="modal-text"><span class="text-success">Konfirmasi Setoran</span>, anda yakin?</h5>
                                          <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                          </button>
                                       </div>
                                       <div class="modal-body">
                                          <p>Pastikan total data setoran sesuai dengan uang tunai setoran <b><?= $k['kelas']; ?></b> ,
                                             total setoran</p>
                                          <h5 class=""><?= rupiah($total[0]->total); ?></h5>
                                       </div>
                                       <div class="modal-footer">
                                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                          <form action="<?= base_url('/savings/update'); ?>" method="POST">
                                             <?= csrf_field(); ?>

                                             <?php foreach ($setoran as $sk) : ?>
                                                <input type="hidden" name="id_setoran[]" value="<?= $sk['id']; ?>">
                                             <?php endforeach; ?>
                                             <button type="submit" class="btn btn-success">Yakin</button>
                                          </form>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>

                     <div class="tab-pane fade" id="contact">
                        <div class="p-t-15">
                           <h4>This is contact title</h4>
                           <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove.</p>

                           <input type="text" name="kode" id="kode" class="input-default">
                           <a href="" class="btn btn-success">Cek</a>




                        </div>
                     </div>
                     <div class="tab-pane fade" id="message">
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
      </div>


   </div>
</div>

<!-- #/ container -->


<?= $this->endSection(); ?>
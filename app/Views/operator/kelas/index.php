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
                           <a class="dropdown-item" href="<?= base_url('/class?s=' . $s['id']); ?>">
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


<div class="container-fluid">
   <div class="row">
      <div class="col-sm-12 col-md-12 col-lg-12">
         <div class="card">
            <div class="card-body">
               <div class="card-title">
                  <h4>List Kelas Tahun Ajaran ()</h4>
               </div>

               <a href="<?= base_url('/class/add?s=' . $dsemester['id']); ?>" class="btn btn-primary">Add New Class</a>



               <div class="row">
                  <?php
                  $querySubKelas = $db->table('tbl_kelas')->select()->where('semester_id', $dsemester['id'])->get();
                  $kelas = $querySubKelas->getResultArray();


                  ?>
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
                           <?php foreach ($kelas as $k) : ?>
                              <tr>
                                 <th>1</th>
                                 <td><?= $k['kelas']; ?></td>
                                 <td>
                                    <?php
                                    $queryGuru = $db->table('tbl_guru')->select()->where('id', $k['guru_id'])->get();
                                    $guru = $queryGuru->getResultArray();
                                    echo $guru[0]['nama'];
                                    ?>
                                 </td>
                                 <td>
                                    <span class="badge <?= ($k['is_active'] == 1) ? 'badge-success' : 'badge-danger'; ?>  px-3">
                                       <?= ($k['is_active'] == 1) ? 'active' : 'inactive'; ?>
                                    </span>
                                 </td>
                                 <td>
                                    Edit | Delete
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




<!-- Alert auto close -->
<?= $this->endSection(); ?>
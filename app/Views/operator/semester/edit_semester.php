<?= $this->extend('template/app_template') ?>

<?= $this->section('app_content'); ?>

<div class="row page-titles mx-0">
   <div class="col p-md-0">
      <ol class="breadcrumb">
         <li class="breadcrumb-item"><a href="<?= base_url('/semester'); ?>"><?= $subMenuTitle; ?></a></li>
         <li class="breadcrumb-item active">Edit Sub Menu</li>
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

               <div class="form-validation">
                  <form action="<?= base_url('semester/update') ?>" method="POST">
                     <div class="modal-body">
                        <div class="form-group">
                           <?= csrf_field(); ?>
                           <input type="hidden" name="semester_id" id="semester_id" value="<?= $s['id']; ?>">
                           <label>Semester</label>
                           <select class="form-control input-default" name="semester">
                              <option <?= ($s['semester'] == 'Genap') ? 'selected' : ''; ?>>Genap</option>
                              <option <?= ($s['semester'] == 'Ganjil') ? 'selected' : ''; ?>>Ganjil</option>
                           </select>
                        </div>
                        <div class="form-group">
                           <label>Periode</label>
                           <div class="input-daterange input-group" id="date-range">
                              <input type="text" class="form-control input-default" name="start" value="<?= date("m/d/Y", $s['periode_awal'])  ?>" placeholder=" <?= date("m/d/Y", $s['periode_awal'])  ?>">
                              <span class="p-3"> - </span>
                              <input type="text" class="form-control input-default" name="end" value="<?= date("m/d/Y", $s['periode_akhir'])  ?>" placeholder="<?= date("m/d/Y", $s['periode_akhir'])  ?>">
                           </div>
                        </div>
                     </div>
                     <div class="modal-footer">
                        <a href="<?= base_url('/semester'); ?>" type="button" class="btn btn-secondary">Close</a>
                        <button type="submit" class="btn btn-primary" id="toastr-success-bottom-right">Update</button>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

<?= $this->endSection(); ?>
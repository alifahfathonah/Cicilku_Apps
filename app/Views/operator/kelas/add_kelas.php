<?= $this->extend('template/app_template') ?>

<?= $this->section('app_content'); ?>

<div class="row page-titles mx-0">
   <div class="col p-md-0">
      <ol class="breadcrumb">
         <li class="breadcrumb-item"><a href="<?= base_url('/class?s=' . $dsemester['id']); ?>">Class Management (<?= $dsemester['semester']; ?>)</a></li>
         <li class="breadcrumb-item active"><?= $subMenuTitle; ?></li>
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
                  <h4><?= $title; ?></h4>
               </div>

               <div class="form-validation">
                  <form action="<?= base_url('/class/save'); ?>" method="POST" class="form-validation">
                     <?= csrf_field(); ?>
                     <div class="form-group row">
                        <label for="semester" class="col-lg-4 col-form-label">
                           Semester
                        </label>
                        <div class="col-lg-6">
                           <select name="semester" class="form-control input-default" id="semester">
                              <?php foreach ($semester as $s) : ?>
                                 <option <?= ($s['id'] == $dsemester['id']) ? 'selected' : ''; ?> value="<?= $s['id']; ?>">
                                    Tahun Ajaran <?= date("Y", $s['periode_awal'])  ?> - <?= date("Y", $s['periode_akhir'])  ?> (<?= $s['semester']; ?>)
                                 </option>
                              <?php endforeach; ?>
                           </select>
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="title" class="col-lg-4 col-form-label">
                           Title Class
                        </label>
                        <div class="col-lg-6">
                           <input id="title" type="text" name="title" class="form-control input-default mt-0 <?= ($validation->hasError('title')) ? 'is-invalid form--danger' : ''; ?>" value="<?= old('title'); ?>">
                           <div class="invalid-feedback">
                              <span id="input-help" class="form-text text-danger"><?= $validation->getError('title'); ?></span>
                           </div>
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="guru" class="col-lg-4 col-form-label">
                           Teacher Class
                        </label>
                        <div class="col-lg-6">
                           <select name="guru" class="form-control input-default" id="guru">
                              <?php foreach ($guru as $g) : ?>
                                 <option value="<?= $g['id']; ?>">
                                    <?= $g['nama']; ?>
                                 </option>
                              <?php endforeach; ?>
                           </select>
                        </div>
                     </div>



                     <div class="form-group row row">
                        <div class="col-lg-8 ml-auto">
                           <a href="<?= base_url('/class?s=' . $dsemester['id']); ?>" class="btn btn-secondary">Cancel</a>
                           <button class="btn btn-primary" type="submit">Tambah</button>
                        </div>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

<?= $this->endSection(); ?>
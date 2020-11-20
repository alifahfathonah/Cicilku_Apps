<?= $this->extend('template/app_template') ?>

<?= $this->section('app_content'); ?>

<div class="row page-titles mx-0">
   <div class="col p-md-0">
      <ol class="breadcrumb">
         <li class="breadcrumb-item"><a href="<?= base_url('class/'); ?>"><?= $subMenuTitle; ?></a></li>
         <li class="breadcrumb-item active">
            <a href="<?= base_url('class/semester/' . encrypt_url($dsemester['id'])); ?>">
               <?= date("Y", $dsemester['periode_awal'])  ?>/<?= date("Y", $dsemester['periode_akhir'])  ?> (<?= $dsemester['semester']; ?>)
            </a>
         </li>
         <li class="breadcrumb-item active">Edit Class</li>
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
                  <small class="font-weight-bold">Last Update : <?= date("d M Y (h:i:s A)", $kelas['updated_at'])  ?> </small>
               </div>

               <!-- Alert -->
               <?php if (session()->getFlashdata('pesan')) : ?>

                  <div class="alert alert-success alert-dismissible fade show" id="alert_auto_close">
                     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                     </button> <?= session()->getFlashdata('pesan'); ?>
                  </div>

               <?php elseif ($validation->getError('class')) : ?>
                  <div class="alert alert-danger alert-dismissible fade show" id="alert_auto_close">
                     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                     </button> <?= $validation->getError('class'); ?>
                  </div>


               <?php endif; ?>

               <div class="form-validation">
                  <form action="<?= base_url('/class/update'); ?>" method="POST" class="form-validation">
                     <?= csrf_field(); ?>
                     <input type="hidden" name="id" id="id" value="<?= $kelas['id']; ?>">
                     <div class="form-group row">
                        <label for="title" class="col-lg-4 col-form-label">
                           Title Class
                        </label>
                        <div class="col-lg-6">
                           <select name="title" class="form-control input-default" id="text">
                              <?php
                              for ($i = 1; $i <= 6; $i++) { ?>
                                 <option value="kelas <?= $i; ?>" <?= ($kelas['kelas'] == 'kelas ' . $i) ? 'selected' : ''; ?>>Kelas <?= $i; ?></option>
                              <?php  }
                              ?>
                           </select>
                           <div class="invalid-feedback">
                              <span id="input-help" class="form-text text-danger"><?= $validation->getError('title'); ?></span>
                           </div>
                        </div>

                     </div>
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
                        <label for="guru" class="col-lg-4 col-form-label">
                           Teacher Class
                        </label>
                        <div class="col-lg-6">
                           <select name="guru" class="form-control input-default" id="guru">
                              <?php foreach ($guru as $g) : ?>
                                 <option value="<?= $g['id']; ?>" <?= ($kelas['guru_id'] == $g['id']) ? 'selected' : ''; ?>>
                                    <?= $g['nama']; ?>
                                 </option>
                              <?php endforeach; ?>
                           </select>
                        </div>
                     </div>

                     <div class="form-group row">
                        <label class="col-lg-4 col-form-label"><a href="#">Is Active</a> <span class="text-danger">*</span>
                        </label>
                        <div class="col-lg-8">
                           <label class="css-control css-control-primary css-checkbox" for="val-terms">
                              <input type="checkbox" name="is_active" class="css-control-input" id="val-terms" name="val-terms" <?= ($kelas['is_active'] == 1) ? 'checked' : ''; ?>>
                              <span class="css-control-indicator"></span> Yes
                           </label>
                        </div>
                     </div>

                     <div class="form-group row row">
                        <div class="col-lg-8 ml-auto">
                           <a href="<?= base_url('class/semester/' . encrypt_url($dsemester['id'])); ?>" class="btn btn-secondary">Cancel</a>
                           <button class="btn btn-primary" type="submit">Update Class</button>
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
<?= $this->extend('template/app_template') ?>

<?= $this->section('app_content'); ?>

<div class="row page-titles mx-0">
   <div class="col p-md-0">
      <ol class="breadcrumb">
         <li class="breadcrumb-item"><a href="<?= base_url('/teachers'); ?>"><?= $subMenuTitle; ?></a></li>
         <li class="breadcrumb-item active"><?= $title; ?></li>
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

               <div class="form-validation mt-5">
                  <form action="<?= base_url('/teachers/save'); ?>" method="POST" class="form-validation">
                     <?= csrf_field(); ?>
                     <h5 class="mt-5">Data Teacher</h5>
                     <hr>
                     <div class="form-group row">
                        <label for="nip" class="col-lg-4 col-form-label">
                           Nomor Induk Pegawai
                        </label>
                        <div class="col-lg-6">
                           <input id="nip" type="text" name="nip" class="form-control input-default mt-0 <?= ($validation->hasError('nip')) ? 'is-invalid form--danger' : ''; ?>" value="<?= old('nip'); ?>">
                           <div class="invalid-feedback">
                              <span id="input-help" class="form-text text-danger"><?= $validation->getError('nip'); ?></span>
                           </div>
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="nama" class="col-lg-4 col-form-label">
                           Nama Lengkap
                        </label>
                        <div class="col-lg-6">
                           <input id="nama" type="text" name="nama" class="form-control input-default mt-0 <?= ($validation->hasError('nama')) ? 'is-invalid form--danger' : ''; ?>" value="<?= old('nama'); ?>">
                           <div class="invalid-feedback">
                              <span id="input-help" class="form-text text-danger"><?= $validation->getError('nama'); ?></span>
                           </div>
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="nama" class="col-lg-4 col-form-label">
                           Picture
                        </label>
                        <div class="col-lg-6">
                           <div class="row">
                              <div class="col-sm-3">
                                 <img src="<?= base_url('asset/users/img/default.png'); ?>" class="img-thumbnail">
                              </div>
                              <div class="col-sm-9">
                                 <div class="custom-file">
                                    <input disabled id="image" type="file" name="image" class="custom-file-input input-default mt-0 <?= ($validation->hasError('image')) ? 'is-invalid form--danger' : ''; ?>" value="<?= old('image'); ?>">
                                    <label class="custom-file-label">Choose file</label>
                                 </div>
                                 *default
                                 <div class="invalid-feedback">
                                    <span id="input-help" class="form-text text-danger"><?= $validation->getError('image'); ?></span>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="nohp" class="col-lg-4 col-form-label">
                           Telephone
                        </label>
                        <div class="col-lg-6">
                           <input id="nohp" type="text" name="nohp" class="form-control input-default mt-0 <?= ($validation->hasError('nohp')) ? 'is-invalid form--danger' : ''; ?>" value="<?= old('nohp'); ?>">
                           <div class="invalid-feedback">
                              <span id="input-help" class="form-text text-danger"><?= $validation->getError('nohp'); ?></span>
                           </div>
                        </div>
                     </div>

                     <h5 class="mt-5">Data Accounts</h5>
                     <hr>

                     <div class="form-group row">
                        <label for="email" class="col-lg-4 col-form-label">
                           Email
                        </label>
                        <div class="col-lg-6">
                           <input id="email" type="text" name="email" class="form-control input-default mt-0 <?= ($validation->hasError('email')) ? 'is-invalid form--danger' : ''; ?>" value="<?= old('email'); ?>">
                           <div class="invalid-feedback">
                              <span id="input-help" class="form-text text-danger"><?= $validation->getError('email'); ?></span>
                           </div>
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="username" class="col-lg-4 col-form-label">
                           Username
                        </label>
                        <div class="col-lg-6">
                           <input id="username" type="text" name="username" class="form-control input-default mt-0 <?= ($validation->hasError('username')) ? 'is-invalid form--danger' : ''; ?>" value="<?= old('username'); ?>">
                           <div class="invalid-feedback">
                              <span id="input-help" class="form-text text-danger"><?= $validation->getError('username'); ?></span>
                           </div>
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="password" class="col-lg-4 col-form-label">
                           Password
                        </label>
                        <div class="col-lg-6">
                           <input id="password" type="text" name="password" class="form-control input-default mt-0 <?= ($validation->hasError('password')) ? 'is-invalid form--danger' : ''; ?>" value="<?= old('password'); ?>">
                           <div class="invalid-feedback">
                              <span id="input-help" class="form-text text-danger"><?= $validation->getError('password'); ?></span>
                           </div>
                        </div>
                     </div>
                     <div class="form-group row row">
                        <div class="col-lg-8 ml-auto">
                           <a href="<?= base_url('teachers'); ?>" class="btn btn-secondary">Cancel</a>
                           <button class="btn btn-primary" type="submit">Add</button>
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
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
                  <form action="<?= base_url('/students/update'); ?>" method="POST" class="form-validation">
                     <?= csrf_field(); ?>
                     <input type="hidden" name="id" id="id" value="<?= $siswa['id']; ?>">
                     <input type="hidden" name="id_detail_kelas" id="id_detail_kelas" value="<?= $dkelas['id']; ?>">
                     <h5 class="mt-5">Data Students</h5>
                     <hr>
                     <div class="form-group row">
                        <label for="rek" class="col-lg-4 col-form-label">
                           Rekening ID
                        </label>
                        <div class="col-lg-6">
                           <span class="font-weight-bold  text-red"> <?= $rekening['no_rekening']; ?></span>
                           <input type="hidden" name="no_rek" id="no_rek" class="form-control input-default mt-0 <?= ($validation->hasError('nisn')) ? 'is-invalid form--danger' : ''; ?>" value="<?= $rekening['no_rekening']; ?>">
                           <div class="invalid-feedback">
                              <span id="input-help" class="form-text text-danger"><?= $validation->getError('no_rek'); ?></span>
                           </div>
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="nisn" class="col-lg-4 col-form-label">
                           Nomor Induk Siswa Nasional
                        </label>
                        <div class="col-lg-6">
                           <input id="nisn" type="text" name="nisn" class="form-control input-default mt-0 <?= ($validation->hasError('nisn')) ? 'is-invalid form--danger' : ''; ?>" value="<?= $siswa['nisn']; ?>" placeholder="<?= $siswa['nisn']; ?>">
                           <div class="invalid-feedback">
                              <span id="input-help" class="form-text text-danger"><?= $validation->getError('nisn'); ?></span>
                           </div>
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="nama" class="col-lg-4 col-form-label">
                           Nama Lengkap
                        </label>
                        <div class="col-lg-6">
                           <input id="nama" type="text" name="nama" class="form-control input-default mt-0 <?= ($validation->hasError('nama')) ? 'is-invalid form--danger' : ''; ?>" value="<?= $siswa['nama']; ?>" placeholder="<?= $siswa['nama']; ?>">
                           <div class="invalid-feedback">
                              <span id="input-help" class="form-text text-danger"><?= $validation->getError('nama'); ?></span>
                           </div>
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="ttl" class="col-lg-4 col-form-label">
                           Tanggal Lahir
                        </label>
                        <div class="col-lg-6 input-daterange" id="date-range">
                           <input type="text" class="form-control input-default mt-0 <?= ($validation->hasError('ttl')) ? 'is-invalid form--danger' : ''; ?>" name="ttl" placeholder="mm/dd/yyyy" value="<?= date("m/d/Y", $siswa['ttl']); ?>" placeholder="<?= date("m/d/Y", $siswa['ttl']); ?>">
                           <div class="invalid-feedback">
                              <span id="input-help" class="form-text text-danger"><?= $validation->getError('ttl'); ?></span>
                           </div>
                        </div>
                     </div>
                     <div class="form-group row">
                        <label class="col-lg-4 col-form-label" for="jk">Jenis Kelamin
                        </label>
                        <div class="col-lg-6">
                           <select class="form-control mt-0 <?= ($validation->hasError('jk')) ? 'is-invalid form--danger' : ''; ?>" id="jk" name="jk">
                              <option value="laki-laki" <?= ($siswa['jk'] == 'laki-laki') ? 'selected' : ''; ?>>Laki Laki</option>
                              <option value="perempuan" <?= ($siswa['jk'] == 'perempuan') ? 'selected' : ''; ?>>Perempuan</option>
                           </select>
                           <div class="invalid-feedback">
                              <span id="input-help" class="form-text text-danger"><?= $validation->getError('jk'); ?></span>
                           </div>
                        </div>
                     </div>
                     <div class="form-group row">
                        <label class="col-lg-4 col-form-label" for="class">Kelas
                        </label>
                        <div class="col-lg-6">
                           <select class="form-control mt-0 <?= ($validation->hasError('class')) ? 'is-invalid form--danger' : ''; ?>" id="class" name="class">
                              <?php foreach ($kelas as $k) : ?>
                                 <option value="<?= $k['id']; ?>" <?= ($dkelas['kelas_id'] == $k['id']) ? 'selected' : ''; ?>><?= $k['kelas']; ?></option>
                              <?php endforeach; ?>
                           </select>
                           <div class="invalid-feedback">
                              <span id="input-help" class="form-text text-danger"><?= $validation->getError('class'); ?></span>
                           </div>
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="picture" class="col-lg-4 col-form-label">
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
                           <input id="nohp" type="text" name="nohp" class="form-control input-default mt-0 <?= ($validation->hasError('nohp')) ? 'is-invalid form--danger' : ''; ?>" value="<?= $siswa['nohp']; ?>" placeholder="<?= $siswa['nohp']; ?>">
                           <div class="invalid-feedback">
                              <span id="input-help" class="form-text text-danger"><?= $validation->getError('nohp'); ?></span>
                           </div>
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="ortu" class="col-lg-4 col-form-label">
                           Nama Orang Tua
                        </label>
                        <div class="col-lg-6">
                           <input id="ortu" type="text" name="ortu" class="form-control input-default mt-0 <?= ($validation->hasError('ortu')) ? 'is-invalid form--danger' : ''; ?>" value="<?= $siswa['orangtua']; ?>" placeholder="<?= $siswa['orangtua']; ?>">
                           <div class="invalid-feedback">
                              <span id="input-help" class="form-text text-danger"><?= $validation->getError('ortu'); ?></span>
                           </div>
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="alamat" class="col-lg-4 col-form-label">
                           Alamat
                        </label>
                        <div class="col-lg-6">
                           <input id="alamat" type="text" name="alamat" class="form-control input-default mt-0 <?= ($validation->hasError('alamat')) ? 'is-invalid form--danger' : ''; ?>" value="<?= $siswa['alamat']; ?>" placeholder="<?= $siswa['alamat']; ?>">
                           <div class="invalid-feedback">
                              <span id="input-help" class="form-text text-danger"><?= $validation->getError('alamat'); ?></span>
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
                           <input id="email" type="text" name="email" class="form-control input-default mt-0 <?= ($validation->hasError('email')) ? 'is-invalid form--danger' : ''; ?>" value="<?= $siswa['email']; ?>" placeholder="<?= $siswa['email']; ?>">
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
                           <input id="username" type="text" name="username" class="form-control input-default mt-0 <?= ($validation->hasError('username')) ? 'is-invalid form--danger' : ''; ?>" value="<?= $siswa['username']; ?>" placeholder="<?= $siswa['username']; ?>">
                           <div class="invalid-feedback">
                              <span id="input-help" class="form-text text-danger"><?= $validation->getError('username'); ?></span>
                           </div>
                        </div>
                     </div>
                     <div class="form-group row">
                        <label class="col-lg-4 col-form-label"><a href="#">Is Active</a> <span class="text-danger">*</span>
                        </label>
                        <div class="col-lg-8">
                           <label class="css-control css-control-primary css-checkbox" for="val-terms">
                              <input type="checkbox" name="is_active" class="css-control-input" id="val-terms" name="val-terms" checked="<?= ($siswa['is_active']) ? 'checked' : ''; ?>">
                              <span class="css-control-indicator"></span> Yes
                           </label>
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="password" class="col-lg-4 col-form-label">
                           Password
                        </label>
                        <div class="col-lg-6">
                           <a href="" class="btn btn-sm btn-danger">Change Password</a>
                        </div>
                     </div>
                     <div class="form-group row row">
                        <div class="col-lg-8 ml-auto">
                           <a href="<?= base_url('/students/' . encrypt_url($siswa['id'])); ?>" class="btn btn-secondary">Cancel</a>
                           <button class="btn btn-primary" type="submit">Update</button>
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
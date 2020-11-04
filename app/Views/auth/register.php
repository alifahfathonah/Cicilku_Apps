<?= $this->extend('template/auth_template') ?>

<?= $this->section('auth_content'); ?>
<div class="register">
   <div class="register__content mt-3">
      <div class="register__head">
         <a href="<?= base_url('/'); ?>"><img src="<?= base_url('/dist/img/logo.png'); ?>"></a>
         <h5 class="mt-3">Buat akun baru</h5>
      </div>
      <div class="register__form">
         <form action="<?= base_url('/auth/save'); ?>" method="POST">
            <?= csrf_field(); ?>

            <div class="form-group">
               <input type="text" name="name" placeholder="Full Name ..." class="form form--focus-blue mt-0 <?= ($validation->hasError('name')) ? 'is-invalid' : ''; ?>" value="<?= old('name'); ?>">
               <div class="invalid-feedback pl-4">
                  <small id="input-help" class="form-text text-danger"><?= $validation->getError('name'); ?></small>
               </div>
            </div>

            <div class="form-group">
               <input type="text" name="email" placeholder="Email ..." class="form form--focus-blue mt-0 <?= ($validation->hasError('email')) ? 'is-invalid' : ''; ?>" value="<?= old('email'); ?>">
               <div class="invalid-feedback pl-4">
                  <small id="input-help" class="form-text text-danger"><?= $validation->getError('email'); ?></small>
               </div>
            </div>

            <div class="form-group">
               <input type="password" name="password" placeholder="Password ..." class="form form--focus-blue mt-0 <?= ($validation->hasError('password')) ? 'is-invalid' : ''; ?>">
               <div class="invalid-feedback pl-4">
                  <small id="input-help" class="form-text text-danger"><?= $validation->getError('password'); ?></small>
               </div>
            </div>

            <div class="form-group">
               <input type="password" name="password-repeat" placeholder="Repeat Password ..." class="form form--focus-blue mt-0 <?= ($validation->hasError('password-repeat')) ? 'is-invalid' : ''; ?>">
               <div class="invalid-feedback pl-4">
                  <small id="input-help" class="form-text text-danger"><?= $validation->getError('password-repeat'); ?></small>
               </div>
            </div>


            <div class="register__form-action mt-3">
               <div class="form-check mb-2 mb-sm-0">
                  <input type="checkbox" name="input_check" id="input_check" class="form form--focus-blue">
                  <label for="input_check" class="label--check">I agree to the <a href="#">term</a></label>
               </div>
               <button type="submit" class="btn btn--blue">Registrasi</button>
            </div>
         </form>

      </div>
   </div>
   <a href="<?= base_url('/auth'); ?>" class="btn btn--link mb-3">Sudah punya akun? Masuk!</a>
</div>


<?= $this->endSection(); ?>
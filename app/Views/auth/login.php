<?= $this->extend('template/auth_template') ?>

<?= $this->section('auth_content'); ?>

<div class="login">
   <div class="login__content">
      <div class="login__head">
         <a href="<?= base_url('/'); ?>"><img src="<?= base_url('/dist/img/logo.png'); ?>"></a>
         <p class="mt-3">Aplikasi Tabunganku</p>
      </div>
      <div class="login__form">
         <?php if (session()->getFlashdata('pesan')) : ?>
            <?= session()->getFlashdata('pesan'); ?>
         <?php endif; ?>
         <form method="POST" action="<?= base_url('/auth/login'); ?>">

            <div class="input-group mt-3 <?= ($validation->hasError('email')) ? 'is-invalid' : ''; ?>">
               <div class="input-group__prepend">
                  <div class="input-group__text"><span class="fa fa-envelope"></span></div>
               </div>
               <input type="text" name="email" placeholder="Masukan Email Anda ..." class="form form--focus-blue " value="<?= old('email'); ?>">
            </div>
            <div class="invalid-feedback pl-4">
               <small id="input-help" class="form-text text-danger"><?= $validation->getError('email'); ?></small>
            </div>

            <div class="input-group <?= ($validation->hasError('password')) ? 'is-invalid' : ''; ?>">
               <div class="input-group__prepend">
                  <div class="input-group__text"><span class="fa fa-lock"></span></div>
               </div>
               <input type="password" name="password" placeholder="Masukkan password Anda ..." class="form form--focus-blue">
            </div>
            <div class="invalid-feedback pl-4">
               <small id="input-help" class="form-text text-danger"><?= $validation->getError('password'); ?></small>
            </div>


            <div class="login__form-action mt-3">
               <a href="forgot-password.html" class="btn btn--link">Lupa Password?</a>
               <button type="submit" class="btn btn--blue mb-2 mb-sm-0">Masuk</button>
            </div>
         </form>
      </div>
   </div>
   <!-- <a href="<?= base_url('/register'); ?>" class="btn btn--link mb-3">Create an account</a> -->
</div><!-- login -->

<?= $this->endSection(); ?>
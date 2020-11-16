<?= $this->extend('template/auth_template') ?>

<?= $this->section('auth_content'); ?>


<div class="login-form-bg h-100">
   <div class="container h-100">
      <div class="row justify-content-center h-100">
         <div class="col-xl-6">
            <div class="form-input-content">
               <div class="card login-form mb-0">
                  <div class="card-body pt-5">
                     <a class="text-center" href="<?= base_url('/'); ?>">
                        <div class="justify-content-center">
                           <img src="<?= base_url('asset/images/my/logo.png'); ?>" alt="" style="width: 50%;">
                        </div>
                     </a>

                     <form class="mt-5 mb-5 login-input" method="POST" action="<?= base_url('/auth/login'); ?>">
                        <?php if (session()->getFlashdata('pesan')) : ?>
                           <?= session()->getFlashdata('pesan'); ?>
                        <?php endif; ?>
                        <div class="form-group">
                           <input type="username" name="username" class="form-control <?= ($validation->hasError('username')) ? 'is-invalid' : ''; ?>" value="<?= old('username'); ?>" placeholder="Username atau Nomor Induk">
                           <div class="invalid-feedback pl-4">
                              <small id="input-help" class="form-text text-danger"><?= $validation->getError('username'); ?></small>
                           </div>
                        </div>

                        <div class="form-group">
                           <input type="password" name="password" class="form-control  <?= ($validation->hasError('password')) ? 'is-invalid' : ''; ?>" placeholder="Password">
                           <div class="invalid-feedback pl-4">
                              <small id="input-help" class="form-text text-danger"><?= $validation->getError('password'); ?></small>
                           </div>
                        </div>
                        <button type="submit" class="btn login-form__btn submit w-100">Masuk</button>
                     </form>
                     <p class="mt-5 login-form__footer">Dont have account? <a href="<?= base_url('/register'); ?>" class="text-primary">Sign Up</a> now</p>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>



<?= $this->endSection(); ?>
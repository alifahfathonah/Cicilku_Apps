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

                     <form class="mt-5 mb-5 login-input" action="<?= base_url('/auth/save'); ?>" method="POST">

                        <?= csrf_field(); ?>

                        <div class="form-group">
                           <input type="text" name="name" placeholder="Full Name ..." class="form-control <?= ($validation->hasError('name')) ? 'is-invalid form--danger' : ''; ?>" value="<?= old('name'); ?>">
                           <div class="invalid-feedback pl-4">
                              <small id="input-help" class="form-text text-danger"><?= $validation->getError('name'); ?></small>
                           </div>
                        </div>

                        <div class="form-group">
                           <input type="text" name="email" placeholder="Email ..." class="form-control <?= ($validation->hasError('email')) ? 'is-invalid form--danger' : ''; ?>" value="<?= old('email'); ?>">
                           <div class="invalid-feedback pl-4">
                              <small id="input-help" class="form-text text-danger"><?= $validation->getError('email'); ?></small>
                           </div>
                        </div>

                        <div class="form-group">
                           <input type="password" name="password" placeholder="Password ..." class="form-control <?= ($validation->hasError('password')) ? 'is-invalid form--danger' : ''; ?>">
                           <div class="invalid-feedback pl-4">
                              <small id="input-help" class="form-text text-danger"><?= $validation->getError('password'); ?></small>
                           </div>
                        </div>

                        <div class="form-group">
                           <input type="password" name="password-repeat" placeholder="Repeat Password ..." class="form-control <?= ($validation->hasError('password-repeat')) ? 'is-invalid form--danger' : ''; ?>">
                           <div class="invalid-feedback pl-4">
                              <small id="input-help" class="form-text text-danger"><?= $validation->getError('password-repeat'); ?></small>
                           </div>
                        </div>


                        <button class="btn login-form__btn submit w-100" type="submit">Registrasi</button>
                     </form>

                     <p class="mt-5 login-form__footer">Have account <a href="<?= base_url('/auth'); ?>" class="text-primary">Sign Up </a> now</p>
                     </p>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
</div>

<?= $this->endSection(); ?>
<?= $this->extend('template/app_template') ?>

<?= $this->section('app_content'); ?>

<div class="row page-titles mx-0">
   <div class="col p-md-0">
      <ol class="breadcrumb">
         <li class="breadcrumb-item"><a href="<?= base_url('/admin/menu'); ?>">Menu</a></li>
         <li class="breadcrumb-item"><a href="<?= base_url('/admin/submenu'); ?>"><?= $subMenuTitle; ?></a></li>
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
                  <form action="<?= base_url('/admin/submenu/edit'); ?>" method="POST">
                     <?= csrf_field(); ?>
                     <input type="hidden" name="id" value="<?= $subMenu['id']; ?>">
                     <div class="form-group row">
                        <label for="usermenu" class="col-lg-4 col-form-label">
                           User Menu
                        </label>
                        <div class="col-lg-6">
                           <select name="menu_id" class="form-control input-default" id="usermenu">
                              <?php foreach ($menu as $m) : ?>
                                 <option <?= ($m['id'] == $subMenu['menu_id']) ? 'selected' : ''; ?> value="<?= $m['id']; ?>"><?= $m['menu']; ?></option>
                              <?php endforeach; ?>
                           </select>
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="title" class="col-lg-4 col-form-label">
                           Title Menu
                        </label>
                        <div class="col-lg-6">
                           <input id="title" type="text" name="title" class="form-control input-default mt-0 <?= ($validation->hasError('title')) ? 'is-invalid form--danger' : ''; ?>" value="<?= $subMenu['title']; ?>">
                           <div class="invalid-feedback">
                              <span id="input-help" class="form-text text-danger"><?= $validation->getError('title'); ?></span>
                           </div>
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="url" class="col-lg-4 col-form-label">
                           Url Menu
                        </label>
                        <div class="col-lg-6">
                           <input id="url" type="text" name="url" class="form-control input-default mt-0 <?= ($validation->hasError('url')) ? 'is-invalid form--danger' : ''; ?>" value="<?= $subMenu['url']; ?>">
                           <div class="invalid-feedback">
                              <span id="input-help" class="form-text text-danger"><?= $validation->getError('url'); ?></span>
                           </div>
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="icon" class="col-lg-4 col-form-label">
                           Icon Menu ( <i class="<?= $subMenu['icon']; ?>" aria-hidden="true"></i> )
                        </label>
                        <div class="col-lg-6">
                           <input id="icon" type="text" name="icon" class="form-control input-default mt-0 <?= ($validation->hasError('icon')) ? 'is-invalid form--danger' : ''; ?>" value="<?= $subMenu['icon']; ?>">
                           <div class="invalid-feedback">
                              <span id="input-help" class="form-text text-danger"><?= $validation->getError('icon'); ?></span>
                           </div>
                        </div>
                     </div>
                     <div class="form-group row">
                        <label class="col-lg-4 col-form-label"><a href="#">Is Active</a> <span class="text-danger">*</span>
                        </label>
                        <div class="col-lg-8">
                           <label class="css-control css-control-primary css-checkbox" for="val-terms">
                              <input type="checkbox" name="is_active" class="css-control-input" id="val-terms" name="val-terms" <?= ($subMenu['is_active'] == 1) ? 'checked' : ''; ?>>
                              <span class="css-control-indicator"></span> Yes
                           </label>
                        </div>
                     </div>
                     <div class="form-group row row">
                        <div class="col-lg-8 ml-auto">
                           <a href="<?= base_url('admin/submenu'); ?>" class="btn btn-secondary">Cancel</a>
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
<?= $this->extend('template/app_template') ?>

<?= $this->section('app_content'); ?>

<!-- main -->
<main class="main main--ml-sidebar-width">
   <div class="row">
      <header class="main__header col-12 mb-2">
         <div class="main__title">
            <h4><?= $subMenuTitle; ?></h4>
            <ul class="breadcrumb">
               <li class="breadcrumb-item"><a href="<?= base_url('admin/submenu'); ?>" class="text-reset"><?= $subMenuTitle; ?></a></li>
               <li class="breadcrumb-item active">Edit Sub Menu</li>
            </ul>
         </div>
      </header>

      <div class="col-sm-6">
         <div class="row">
            <div class="col-12">
               <section class="main__box mb-4">
                  <form action="<?= base_url('/admin/submenu/edit'); ?>" method="POST">
                     <?= csrf_field(); ?>
                     <input type="hidden" name="id" value="<?= $subMenu['id']; ?>">
                     <div class="form-group">
                        <label for="usermenu" class="font-weight-normal">
                           <h5>User Menu</h5>
                        </label>
                        <select name="menu_id" class="form form--focus-blue" id="usermenu">
                           <?php foreach ($menu as $m) : ?>
                              <option <?= ($m['id'] == $subMenu['menu_id']) ? 'selected' : ''; ?> value="<?= $m['id']; ?>"><?= $m['menu']; ?></option>
                           <?php endforeach; ?>
                        </select>
                     </div>
                     <div class="form-group">
                        <label for="title" class="font-weight-normal">
                           <h5>Title Menu</h5>
                        </label>
                        <input id="title" type="text" name="title" class="form form--focus-blue mt-0 <?= ($validation->hasError('title')) ? 'is-invalid form--danger' : ''; ?>" value="<?= $subMenu['title']; ?>">
                        <div class="invalid-feedback pl-4">
                           <small id="input-help" class="form-text text-danger"><?= $validation->getError('title'); ?></small>
                        </div>
                     </div>
                     <div class="form-group">
                        <label for="url" class="font-weight-normal">
                           <h5>Url Menu</h5>
                        </label>
                        <input id="url" type="text" name="url" class="form form--focus-blue mt-0 <?= ($validation->hasError('url')) ? 'is-invalid form--danger' : ''; ?>" value="<?= $subMenu['url']; ?>">
                        <div class="invalid-feedback pl-4">
                           <small id="input-help" class="form-text text-danger"><?= $validation->getError('url'); ?></small>
                        </div>
                     </div>
                     <div class="form-group">
                        <label for="icon" class="font-weight-normal">
                           <h5>Icon Menu ( <i class="<?= $subMenu['icon']; ?>" aria-hidden="true"></i> ) </h5>
                        </label>
                        <input id="icon" type="text" name="icon" class="form form--focus-blue mt-0 <?= ($validation->hasError('icon')) ? 'is-invalid form--danger' : ''; ?>" value="<?= $subMenu['icon']; ?>">
                        <div class="invalid-feedback pl-4">
                           <small id="input-help" class="form-text text-danger"><?= $validation->getError('icon'); ?></small>
                        </div>
                     </div>
                     <div class="form-group">
                        <div class="form-check form-check--inline">
                           <input type="checkbox" name="is_active" id="input_check" class="form form--focus-blue" <?= ($subMenu['is_active'] == 1) ? 'checked' : ''; ?>>
                           <label for="input_check" class="form-check__label"><b>Is Active</b></label>
                        </div>
                     </div>

                     <a href="<?= base_url('admin/submenu'); ?>" class="btn btn--gray mt-4 mr-2">Cancel</a>
                     <button class="btn btn--blue mt-4" type="submit">Update</button>
                  </form>
               </section><!-- main__box -->
            </div>
         </div><!-- row -->
      </div>
   </div><!-- row -->
</main>

<!-- Alert auto close -->
<?= $this->endSection(); ?>
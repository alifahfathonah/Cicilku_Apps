<?= $this->extend('template/app_template') ?>

<?= $this->section('app_content'); ?>
<!-- main -->
<main class="main main--ml-sidebar-width">
   <div class="row">
      <header class="main__header col-12 mb-2">
         <div class="main__title">
            <h4><?=$subMenuTitle;?></h4>
            <ul class="breadcrumb">
               <li class="breadcrumb-item active"><?=$subMenuTitle;?></li>
            </ul>
         </div>

        <!-- table -->
			<div class="mb-3 col-lg-6 col-sm-12 col-md-12">
				<section class="main__box">
					<h5>User Menu</h5>
               <hr>
               
               <a href="" class="btn btn--blue" id="show-modal-new">Add New Role User Menu</a>	
               
					<table class="table table--gray mb-3 mt-3">
						<thead>
							<tr>
								<th width="10">No</th>
								<th>Users Menu</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
                     <?php $n=1; foreach ($menu as $m):?>
							<tr>
								<td class="text-center"><?=$n++;?></td>
								<td><?=$m['menu']?></td>
                        <td class="text-center">
                           <a href="" class="badge badge-primary text-white">Edit</a>
                           <a href="" class="badge badge-danger text-white">Delete</a>
                        </td>
                     </tr>
                     <?php endforeach;?>
						</tbody>
					</table>
				</section><!-- main__box -->
         </div>
         
       
      </header>
   </div><!-- row -->
</main>

<!-- modal add -->
<div class="modal modal--info" id="show-modal-new">
    <div class="modal__content">
         <div class="modal__header">
            <div class="modal__icon">
               <i class="fas fa-user-plus"></i>
            </div>
            <div class="modal__title">
               <h5>Add New User Menu</h5>
            </div>
         </div>
         <form action="<?=base_url('/admin/user-menu/new')?>" method="POST">
            <div class="modal__body">
                  <div class="form-group">
                     <input type="text" class="form-control form--focus-blue" id="addmenu" placeholder="Add ...">
                  </div>
            </div>
            <div class="modal__footer">
                  <a href="#" class="btn btn--gray-outline" id="close-modal">Batal</a>
                  <a href="#" class="btn btn--blue mb-2 mb-sm-0">Tambah</a>
            </div>
         </form>
    </div>
</div>
<script>
const btnShowModal = document.querySelector("a#show-modal-new");
const modal = document.querySelector("div#show-modal-new");
const closeModal = modal.querySelector("a#close-modal");
btnShowModal.addEventListener('click', e => {
    // hilangkan fungsi default dari tag a
    e.preventDefault();

    // tampilkan modal
    modal.classList.add("modal--fade-in");

    /* tambahkan class .stop-scrolling pada tag <body> untuk menghilangkan scroll halaman, 
    agar halaman tidak bisa di scroll */
    document.body.classList.add("stop-scrolling");
});

closeModal.addEventListener('click', e => {
    // hilangkan fungsi default dari tag a
    e.preventDefault();

    // sembunyikan/tutup modal
    modal.classList.remove("modal--fade-in");

    /* hapus class .stop-scrolling pada tag <body> agar 
    halaman bisa di scroll kembali */
    document.body.classList.remove("stop-scrolling");
});
</script>

<?= $this->endSection(); ?>
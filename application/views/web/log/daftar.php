<div id="content" class="content">
<style>
body {
  background-image: url('img/cover/o.jpg');
  background-size: cover;
  background-position: center;
  background-repeat: no-repeat;
  background-attachment: fixed;
  height: 100vh;
  width:auto;
}
</style>
	<!-- Dashboard content -->
	<div class="row">
		<div class="col-md-4"></div>
		<div class="col-md-4">
			<div class="col-md-1"></div>
			<div class="col-md-10">
				<div class="panel panel-inverse">
                     
        <?php if ($error) : ?>
						<div class="" style="display: flex; justify-content: center; align-items: center; width: 100%; height: 200px;">
							<p style="color: red;font-size: 15px;">Belum Ada Lowongan Yang Tersedia</p>
  
					<?php else : ?>
           
						<div class="panel-heading">
							<h4 class="panel-title">
								<center>FORM PENDAFTARAN</center>
							</h4>
						</div>
						<div class="panel-body">
							<?php
							echo $this->session->flashdata('msg');
							?>
							<form class="form-horizontal" action="" data-parsley-validate="true" method="post" enctype="multipart/form-data">
								<div class="form-group">
									<label class="col-lg-12">Nama Lengkap</label>
									<div class="col-lg-12">
										<input type="text" name="nama" class="form-control" value="" placeholder="Nama Lengkap" required autofocus>
									</div>
								</div>
								<div class="form-group">
									<label class="col-lg-12">Username</label>
									<div class="col-lg-12">
										<input type="text" name="username" class="form-control" value="" placeholder="Username" required>
									</div>
								</div>
								<div class="form-group">
									<label class="col-lg-12">Password</label>
									<div class="col-lg-12">
										<input type="password" name="password" class="form-control" value="" placeholder="Password" required>
									</div>
								</div>
								<!-- <div class="form-group">
									<label class="col-lg-12">Lowongan</label>
									<div class="col-lg-12">
										<select name="lowongan" id="lowongan" class="lowoongan form-control">
											<option value="">Pilih ...</option>
											<?php foreach ($lowongan as $i => $v) : ?>
												<option value="<?= $v['id_info_lowker'] ?>"><?= $v['nama'] ?></option>
											<?php endforeach; ?>
										</select>
									</div>
								</div> -->
								<div class="form-group">
									<label class="col-lg-12">Konfirmasi Password</label>
									<div class="col-lg-12">
										<input type="password" name="password2" class="form-control" value="" placeholder="Konfirmasi Password" required>
									</div>
								</div>
								<!-- <hr> -->
								<button type="submit" name="btndaftar" class="btn btn-primary" style="width:100%">DAFTAR SEKARANG</button>
							</form>
							<div class="m-t-20 text-inverse">
								Sudah mendaftar ? <a href="web/login.html">Login</a>
							</div>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
		<!-- <div class="col-md-12">
			<hr />
			<p class="text-center">
				<?php echo $this->Mcrud->footer(); ?>
			</p>
		</div> -->
	</div>
	<!-- /dashboard content -->
</div>
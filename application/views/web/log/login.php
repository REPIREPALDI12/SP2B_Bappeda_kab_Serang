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
						<div class="panel-heading">
							<h4 class="panel-title">
								<center>FORM LOGIN</center>
							</h4>
						</div>
            <div class="panel-body">
            <center><img src="img/logo/logo.png"style="width:100px;height:90px;"></center>
            <br>
                <?php
                echo $this->session->flashdata('msg');
                ?>
                <form class="form-horizontal" action="" data-parsley-validate="true" method="post" enctype="multipart/form-data">
                  <div class="form-group">
                    <label class="col-lg-12">Username</label>
                    <div class="col-lg-12">
                      <input type="text" name="username" class="form-control" value="" placeholder="Username" required autofocus>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-lg-12">Password</label>
                    <div class="col-lg-12">
                      <input type="password" name="password" class="form-control" value="" placeholder="Password" required>
                    </div>
                  </div>
                  <!-- <hr> -->
                  <button type="submit" name="btnlogin" class="btn btn-primary" style="width:100%">LOGIN</button>
                </form>
                <div class="m-t-20 text-inverse">
                    Ingin menjadi peserta ? <a href="web/daftar.html">Daftar</a>
                </div>
            </div>
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

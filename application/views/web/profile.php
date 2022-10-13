<?php error_reporting(0); ?>
<!-- begin #page-title -->
    <div id="page-title" class="page-title has-bg">
        <div class="bg-cover"><img src="img/cover/e.jpg" alt="" width="100%"/></div>
        <div class="container">
            <h1><?php echo strtoupper($judul_web); ?></h1>
            <p><?php echo $this->Mcrud->judul_web(); ?></p>
        </div>
    </div>
<!-- end #page-title -->
<!-- begin #content -->
    <div id="content" class="content">
        <!-- begin container -->
        <div class="container">
            <!-- begin row -->
            <div class="row row-space-30">
              <h4 class="section-title m-b-20"><span><?php echo $judul_web; ?></span></h4>
              <br>
              <p>
                <?php echo $query->ket; ?>
              </p>
              <hr>
              <div class="col-md-12">
              <center>
                <a href="" class="btn btn-success">BERANDA</a>
              </center>
              </div>

            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    <!-- end #content -->

<?php $cek    = $user->row(); ?>
<!-- begin #content -->
<div id="content" class="content">
  <!-- begin breadcrumb -->
  <ol class="breadcrumb pull-right">
    <li class="active">Dashboard</li>
  </ol>
  <!-- end breadcrumb -->
  <!-- begin page-header -->
  <h1 class="page-header">Dashboard <small> <?php echo ucwords($cek->level);?></small></h1>
  <!-- end page-header -->
  <!-- begin row -->
  <div class="row">
    <!-- begin col-12 -->
    <div class="col-md-12">
        <div class="widget widget-stats bg-white text-inverse">
            <div class="stats-icon stats-icon-lg stats-icon-square bg-gradient-black"><i class="fa fa-file"></i></div>
            <div class="stats-title"><?php echo $this->Mcrud->judul_web(); ?></div>
            <div class="stats-number">Selamat Datang Di Aplikasi Sistem Pendukung Keputusan Penerimaan Pegawai </div>
            <div class="stats-progress progress">
                      <div class="progress-bar" style="width: 70.1%;"></div>
            </div>
                  <!-- <div class="stats-desc">Better than last week (70.1%)</div> -->
        </div>

        <img src="img/banner-bupati.png" alt="" width="100%" class="img-responsive">

    </div>

  </div>
  <!-- end row -->

</div>
<!-- end #content -->

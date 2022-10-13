<!DOCTYPE html>
<?php
$menu 		= strtolower($this->uri->segment(1));
$sub_menu = strtolower($this->uri->segment(2));
$sub_menu3 = strtolower($this->uri->segment(3));
?>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
	<meta charset="utf-8" />
	<title>Badan Perencanaan Pembangunan Daerah Kabupaten Serang</title>
	<link rel="icon" type="image/x-icon" href="img/logo.ico"/>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
	<meta content="CV. ESOTECHNO, <?php echo $this->Mcrud->judul_web(); ?>" name="description" />
	<meta content="CV. ESOTECHNO, <?php echo $this->Mcrud->judul_web(); ?>" name="keywords" />
	<meta content="CV. ESOTECHNO - Anwar-kun" name="author" />

	<base href="<?php echo base_url(); ?>">
	<link rel="shortcut icon" href="assets/favicon.png" type="image/x-icon" />
	<!-- ================== BEGIN BASE CSS STYLE ================== -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
	<link href="assets/web/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
	<link href="assets/web/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
	<link href="assets/web/css/animate.min.css" rel="stylesheet" />
	<link href="assets/web/css/style.min.css" rel="stylesheet" />
	<link href="assets/web/css/style-responsive.min.css" rel="stylesheet" />
	<link href="assets/web/css/theme/default.css" id="theme" rel="stylesheet" />
	<!-- ================== END BASE CSS STYLE ================== -->

	<link href="assets/panel/plugins/DataTables/media/css/dataTables.bootstrap.min.css" rel="stylesheet" />
	<link href="assets/panel/plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css" rel="stylesheet" />

	<!-- ================== BEGIN BASE JS ================== -->
	<script src="assets/web/plugins/pace/pace.min.js"></script>
	<!-- ================== END BASE JS ================== -->
	<link rel="stylesheet" type="text/css" href="assets/fancybox/jquery.fancybox.css">
	<script type="text/javascript" src="assets/js/jquery.min.js"></script>
	<script type="text/javascript" src="assets/fancybox/jquery.fancybox.js"></script>
	<style>
		.brand-text{font-size: 11px;}
		@media (min-width:768px){.brand-text{font-size: 20px;}}
	</style>
</head>
<body>
	<!-- begin #header -->
    <div id="header" class="header navbar navbar-transparent navbar-fixed-top">
        <!-- begin container -->
        <div class="container">
            <!-- begin navbar-header -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#header-navbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a href="" class="navbar-brand">
                    <!-- <span class="brand-logo"></span> -->
										<span class="logo">
											<img src="" alt="" width="30">
										</span>
                    <span class="brand-text">
                        <?php echo $this->Mcrud->judul_web(2); ?>
                    </span>
                </a>
            </div>
            <!-- end navbar-header -->
            <!-- begin navbar-collapse -->
            <div class="collapse navbar-collapse" id="header-navbar">
                <ul class="nav navbar-nav navbar-right">
                    <li<?php if($menu=='' OR $menu=='web' AND $sub_menu==''){echo ' class="active"';} ?>>
                        <a href="">BERANDA</a>
                    </li>
                    <li<?php if($menu=='web'){echo ' class="active"';} ?>>
                        <a href="javascript:;" data-toggle="dropdown">PROFILE <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li<?php if($menu=='web' AND $sub_menu=='visi_misi'){echo ' class="active"';} ?>><a href="web/visi_misi.html">Visi & Misi</a></li>
							<li<?php if($menu=='web' AND $sub_menu=='Tugas'){echo ' class="active"';} ?>><a href="web/Tugas.html">Tugas & Fungsi</a></li>
							<li><a href="img/cover/stukture.png">Stuktur Organisasi</a></li>
						</ul>
                    </li>
                    <li<?php if($menu=='web' AND $sub_menu=='info_lowker'){echo ' class="active"';} ?>><a href="web/info_lowker.html">Info Lowongan Kerja</a></li>
										<?php if ($this->session->userdata('username')==''){ ?>
											<li><a href="web/login.html">Login</a></li>
										<?php }else{ ?>
											<li><a href="dashboard.html">Dashboard Admin</a></li>
										<?php } ?>
                </ul>
            </div>
            <!-- end navbar-collapse -->
        </div>
        <!-- end container -->
    </div>
    <!-- end #header -->

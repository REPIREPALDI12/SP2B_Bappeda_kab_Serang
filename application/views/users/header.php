<!DOCTYPE html>
<?php
$cek    = $user->row();
$nama   = $cek->nama_lengkap;
$username   = $cek->username;

$level  = $cek->level;

$foto_profile = "assets/panel/img/user1.png";
if ($level=='user') {
	$d_k = $this->db->get_where('tbl_karyawan', array('id_user'=>$cek->id_user))->row();
	$foto_k = $d_k->foto;
	if ($foto_k!='') {
		if(file_exists("$foto_k")){
			$foto_profile = $foto_k;
		}
	}
}

$menu 		= strtolower($this->uri->segment(1));
$sub_menu = strtolower($this->uri->segment(2));
$sub_menu3 = strtolower($this->uri->segment(3));
?>

<html lang="en">
<head>
	<meta charset="utf-8" />
	<title><?= $judul_web; ?></title>
	<link rel="icon" type="image/x-icon" href="img/logo.ico"/>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
	<meta content="<?php echo $this->Mcrud->judul_web(); ?>" name="description" />
	<meta content="CV. Esotechno" name="author" />
	<meta name="keywords" content="CV. Esotechno, <?php echo $this->Mcrud->judul_web(); ?>">
	<base href="<?php echo base_url();?>"/>
	<link rel="shortcut icon" href="assets/favicon.png" type="image/x-icon" />
	<!-- ================== BEGIN BASE CSS STYLE ================== -->
	<link href="assets/panel/plugins/jquery-ui/themes/base/minified/jquery-ui.min.css" rel="stylesheet" />
	<link href="assets/panel/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
	<link href="assets/panel/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
	<link href="assets/panel/plugins/ionicons/css/ionicons.min.css" rel="stylesheet" />
	<link href="assets/panel/css/animate.min.css" rel="stylesheet" />
	<link href="assets/panel/css/style.min.css" rel="stylesheet" />
	<link href="assets/panel/css/style-responsive.min.css" rel="stylesheet" />
	<link href="assets/panel/css/theme/default.css" rel="stylesheet" id="theme" />
	<link href="assets/panel/css/style-gue.css" rel="stylesheet">
	<!-- ================== END BASE CSS STYLE ================== -->

	<!-- ================== BEGIN PAGE LEVEL CSS STYLE ================== -->
    <link href="assets/panel/plugins/jquery-jvectormap/jquery-jvectormap.css" rel="stylesheet" />
    <link href="assets/panel/plugins/bootstrap-calendar/css/bootstrap_calendar.css" rel="stylesheet" />
    <link href="assets/panel/plugins/gritter/css/jquery.gritter.css" rel="stylesheet" />
    <link href="assets/panel/plugins/morris/morris.css" rel="stylesheet" />
	<!-- ================== END PAGE LEVEL CSS STYLE ================== -->

	<!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
	<link href="assets/panel/plugins/DataTables/media/css/dataTables.bootstrap.min.css" rel="stylesheet" />
	<link href="assets/panel/plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css" rel="stylesheet" />
	<link href="assets/panel/plugins/parsley/src/parsley.css" rel="stylesheet" />
	<!-- ================== END PAGE LEVEL STYLE ================== -->

	<!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
	<link href="assets/panel/plugins/bootstrap-datepicker/css/bootstrap-datepicker.css" rel="stylesheet" />
	<link href="assets/panel/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.css" rel="stylesheet" />
	<link href="assets/panel/plugins/ionRangeSlider/css/ion.rangeSlider.css" rel="stylesheet" />
	<link href="assets/panel/plugins/ionRangeSlider/css/ion.rangeSlider.skinNice.css" rel="stylesheet" />
	<link href="assets/panel/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css" rel="stylesheet" />
	<link href="assets/panel/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" />
	<link href="assets/panel/plugins/password-indicator/css/password-indicator.css" rel="stylesheet" />
	<link href="assets/panel/plugins/bootstrap-combobox/css/bootstrap-combobox.css" rel="stylesheet" />
	<link href="assets/panel/plugins/bootstrap-select/bootstrap-select.min.css" rel="stylesheet" />
	<link href="assets/panel/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css" rel="stylesheet" />
	<link href="assets/panel/plugins/jquery-tag-it/css/jquery.tagit.css" rel="stylesheet" />
    <link href="assets/panel/plugins/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet" />
    <link href="assets/panel/plugins/select2/dist/css/select2.min.css" rel="stylesheet" />
    <link href="assets/panel/plugins/bootstrap-eonasdan-datetimepicker/build/css/bootstrap-datetimepicker.min.css" rel="stylesheet" />
    <link href="assets/panel/plugins/bootstrap-colorpalette/css/bootstrap-colorpalette.css" rel="stylesheet" />
    <link href="assets/panel/plugins/jquery-simplecolorpicker/jquery.simplecolorpicker.css" rel="stylesheet" />
    <link href="assets/panel/plugins/jquery-simplecolorpicker/jquery.simplecolorpicker-fontawesome.css" rel="stylesheet" />
    <link href="assets/panel/plugins/jquery-simplecolorpicker/jquery.simplecolorpicker-glyphicons.css" rel="stylesheet" />
	<!-- ================== END PAGE LEVEL STYLE ================== -->

		<link href="assets/panel/plugins/bootstrap-wysihtml5/dist/bootstrap3-wysihtml5.min.css" rel="stylesheet" />

	<!-- ================== BEGIN BASE JS ================== -->
	<script src="assets/panel/plugins/pace/pace.min.js"></script>
	<!-- ================== END BASE JS ================== -->
	<link rel="stylesheet" type="text/css" href="assets/fancybox/jquery.fancybox.css">
	<script type="text/javascript" src="assets/js/jquery.min.js"></script>
	<script type="text/javascript" src="assets/fancybox/jquery.fancybox.js"></script>
</head>
<body>

<style type="text/css"></style>
	<!-- begin #page-loader -->
	<div id="page-loader" class="fade in"><span class="spinner"></span></div>
	<!-- end #page-loader -->

	<!-- begin #page-container -->
	<div id="page-container" class="fade page-sidebar-fixed page-header-fixed in"> <!--page-sidebar-minified-->
		<!-- begin #header -->
		<div id="header" class="header navbar navbar-default navbar-fixed-top" style="background:#29ABA3;color:#fff;">
			<!-- begin container-fluid -->
			<div class="container-fluid">
				<!-- begin mobile sidebar expand / collapse button -->
				<div class="navbar-header">
					<a href="" class="navbar-brand" style="color:#fff;">
						<span class="navbar-logo" style="color:#fff;">
							<i class="fa fa-file"></i>
						</span>
	<!-- ADMIN TULISAN PANEL -->
						<b> </b> <?php if($level=='user'){echo "Karyawan";}else{echo ucwords($level);} ?></a>
						<button type="button" class="navbar-toggle" data-click="sidebar-toggled">
						<span class="icon-bar" style="background:#fff;"></span>
						<span class="icon-bar" style="background:#fff;"></span>
						<span class="icon-bar" style="background:#fff;"></span>
					</button>
				</div>
				<!-- end mobile sidebar expand / collapse button -->

				<!-- begin header navigation right -->
				<ul class="nav navbar-nav navbar-right">
					<li class="dropdown navbar-user">
						<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
							<span class="user-image online">
								<img src="<?php echo $foto_profile; ?>" alt="" />
							</span>
							<span class="hidden-xs" style="color:#fff;"><?php echo ucwords($nama); ?></span> <b class="caret" style="color:#fff;"></b>
						</a>
						<ul class="dropdown-menu animated fadeInLeft">
							<li class="arrow"></li>
							<li<?php if($menu=='users' AND $sub_menu=='profile'){echo " class='active'";}?>><a href="users/profile.html">Akun</a></li>
							<li<?php if($menu=='users' AND $sub_menu=='ubah_pass'){echo " class='active'";}?>><a href="users/ubah_pass.html">Ubah Password</a></li>
							<!-- <li><a href="javascript:;"><span class="badge badge-danger pull-right">2</span> Inbox</a></li> -->
							<!-- <li><a href="javascript:;">Calendar</a></li> -->
							<!-- <li><a href="javascript:;">Setting</a></li> -->
							<li class="divider"></li>
							<li><a href="web/logout.html">Log Out</a></li>
						</ul>
					</li>
				</ul>
				<!-- end header navigation right -->
			</div>
			<!-- end container-fluid -->
		</div>
		<!-- end #header -->

		<!-- begin #sidebar -->
		<div id="sidebar" class="sidebar" style="background:#35414F">
			<!-- begin sidebar scrollbar -->
			<div data-scrollbar="true" data-height="100%">
				<!-- begin sidebar user -->
				<!-- <ul class="nav">
					<li class="nav-profile">
						<div class="image">
							<a href="users/profile"><img src="<?php echo $foto_profile; ?>" alt="" /></a>
						</div>
						<div class="info">
							<?php echo ucwords($nama); ?>
							<small>@<?php echo strtolower($username); ?></small>
						</div>
					</li>
				</ul> -->
				<!-- end sidebar user -->
				<!-- begin sidebar nav -->
				<ul class="nav">
					<li class="nav-header">Menu</li>
					<li class="has-sub<?php if($menu=='users' AND $sub_menu=='' or $menu=='dashboard'){echo " active";} ?>">
						<a href="dashboard.html">
						    <i class="ion-ios-pulse-strong"></i>
						    <span>Dashboard</span>
					   </a>
					</li>

					<?php if ($level!='user'): ?>
					<li <?php if($menu=='slide'){echo " class='active'";} ?>>
						<a href="slide.html">
							<div class="icon-img"><i class="fa fa-picture-o bg-red"></i></div>
						  <span>Slide</span>
						</a>
					</li>
					<li <?php if($menu=='profile'){echo " class='active'";} ?>>
						<a href="profile.html">
							<div class="icon-img"><i class="fa fa-file bg-orange"></i></div>
						  <span>Profile</span>
						</a>
					</li>
					<li <?php if($menu=='info_lowker'){echo " class='active'";} ?>>
						<a href="info_lowker.html">
							<div class="icon-img"><i class="fa fa-info bg-white"></i></div>
						  <span>Info Lowongan</span>
						</a>
					</li>

					<li <?php if($menu=='karyawan'){echo " class='active'";} ?>>
						<a href="karyawan.html">
							<div class="icon-img"><i class="fa fa-users bg-green"></i></div>
						  <span>Data Calon Pelamar</span>
						</a>
					</li>
					<li <?php if($menu=='kriteria' AND $sub_menu=='v'){echo " class='active'";} ?>>
						<a href="kriteria.html">
							<div class="icon-img"><i class="fa fa-clipboard bg-blue"></i></div>
						  <span>Kriteria</span>
						</a>
					</li>
					<li <?php if($menu=='kriteria' AND $sub_menu=='sub'){echo " class='active'";} ?>>
						<a href="kriteria/sub.html">
							<div class="icon-img"><i class="fa fa-bookmark bg-gray"></i></div>
						  <span>Sub Kriteria</span>
						</a>
					</li>
					<li <?php if($menu=='penyeleksian'){echo " class='active'";} ?>>
						<a href="penyeleksian.html">
							<div class="icon-img"><i class="fa fa-check-square bg-blue"></i></div>
						  <span>Penyeleksian</span>
						</a>
					</li>
					<li <?php if($menu=='pengumuman'){echo " class='active'";} ?>>
						<a href="pengumuman.html">
							<div class="icon-img"><i class="fa fa-desktop bg-green"></i></div>
						  <span>Pengumuman</span>
						</a>
					</li>
					<li <?php if($menu=='laporan'){echo " class='active'";} ?>>
						<a href="laporan.html">
							<div class="icon-img"><i class="fa fa-print bg-white"></i></div>
						  <span>laporan</span>
						</a>
					</li>
				<?php endif; ?>


				<?php if ($level=='user'): ?>
					<li <?php if($menu=='karyawan'){echo " class='active'";} ?>>
						<a href="karyawan/detail.html">
							<div class="icon-img"><i class="fa fa-user bg-green"></i></div>
						  <span> Formulir Pendaftaran</span>
						</a>
					</li>
					<li <?php if($menu=='pengumuman'){echo " class='active'";} ?>>
						<a href="pengumuman/view.html">
							<div class="icon-img"><i class="fa fa-desktop bg-blue"></i></div>
						  <span>Pengumuman</span>
						</a>
					</li>
					<li <?php if($menu=='profile'){echo " class='active'";} ?>>
						<a href="profile.html">
							<div class="icon-img"><i class="fa fa-file bg-orange"></i></div>
						  <span>Profile</span>
						</a>
					</li>
				<?php endif; ?>


					<li class="nav-header">Pengguna</li>
				<?php if ($level!='user'): ?>
					<li <?php if($menu=='manajemen_user'){echo " class='active'";} ?>>
						<a href="manajemen_user.html">
							<div class="icon-img"><i class="fa fa-users bg-red"></i></div>
						  <span>Manajemen User</span>
						</a>
					</li>
				<?php endif; ?>

					<?php if ($level=='superadmin'): ?>
						<li <?php if($menu=='operator'){echo " class='active'";} ?>>
							<a href="operator.html">
								<div class="icon-img"><i class="fa fa-users bg-orange"></i></div>
							  <span>Operator</span>
							</a>
						</li>
					<?php endif; ?>
					<li <?php if($menu=='users' AND $sub_menu=='profile'){echo " class='active'";} ?>>
						<a href="users/profile.html">
							<div class="icon-img"><i class="fa fa-user bg-green"></i></div>
						  <span>Akun</span>
						</a>
					</li>
					<li <?php if($menu=='users' AND $sub_menu=='ubah_pass'){echo " class='active'";} ?>>
						<a href="users/ubah_pass.html">
							<div class="icon-img"><i class="fa fa-key bg-blue"></i></div>
						  <span>Ubah Password</span>
						</a>
					</li>
					<li>
						<a href="web/logout.html">
							<div class="icon-img">
						    <i class="ion-log-out bg-black"></i>
						    </div>
						    <span>Log Out</span>
						</a>
					</li>
					    <!-- begin sidebar minify button -->
					<li><a href="javascript:;" class="sidebar-minify-btn" data-click="sidebar-minify"><i class="ion-ios-arrow-left"></i> <span>Collapse</span></a></li>
			        <!-- end sidebar minify button -->
				</ul>
				<!-- end sidebar nav -->
			</div>
			<!-- end sidebar scrollbar -->
		</div>
		<div class="sidebar-bg"></div>
		<!-- end #sidebar -->

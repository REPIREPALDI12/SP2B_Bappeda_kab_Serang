<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title><?php echo $judul_web; ?></title>
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
	<link href="assets/panel/css/animate.min.css" rel="stylesheet" />
	<link href="assets/panel/css/style.min.css" rel="stylesheet" />
	<link href="assets/panel/css/style-responsive.min.css" rel="stylesheet" />
	<link href="assets/panel/css/theme/default.css" rel="stylesheet" id="theme" />
	<link href="assets/panel/css/style-gue.css" rel="stylesheet">
	<!-- ================== END BASE CSS STYLE ================== -->

	<!-- ================== BEGIN BASE JS ================== -->
	<!-- <script src="assets/panel/plugins/pace/pace.min.js"></script> -->
	<!-- ================== END BASE JS ================== -->

	<style>
	@media (max-width: 767px){
		.page-header-fixed {
			padding-top: 54px;
		}
	}
	</style>
</head>
<body>

<style type="text/css"></style>
	<!-- begin #page-loader -->
	<div id="page-loader" class="fade in"><span class="spinner"></span></div>
	<!-- end #page-loader -->

	<!-- begin #page-container -->
	<div id="page-container" class="fade page-without-sidebar page-header-fixed"> <!--page-sidebar-minified-->
		<!-- begin #header -->
		<div id="header" class="header navbar navbar-default navbar-fixed-top" style="background:#29ABA3;">
			<!-- begin container-fluid -->
			<!-- <div class="container-fluid"> -->
				<!-- begin mobile sidebar expand / collapse button -->
				<!-- <div class="navbar-header"> -->
					<a href="" style="text-decoration:none;padding:90px;margin:0px;color:#fff;">
						<center><b style="font-size:16px;"><?php echo ucwords($this->Mcrud->judul_web()); ?></b></center>
					</a>
				<!-- </div> -->
				<!-- end mobile sidebar expand / collapse button -->
			<!-- </div> -->
			<!-- end container-fluid -->
		</div>
		<!-- end #header -->

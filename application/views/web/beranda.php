<!DOCTYPE html>
<html>
  <head>
    <title>Lowongan Kerja</title>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- css -->
	<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="css/style.css" rel="stylesheet" media="screen">
	<link href="color/default.css" rel="stylesheet" media="screen">
	<script src="js/modernizr.custom.js"></script>
	</head>

  <!-- begin #page-title -->
    <div id="page-title">
       <!-- class="page-title has-bg"  style="padding-top:60px;"-->
        <!-- <div class="bg-cover"> -->
        <div id="carousel-post" class="carousel slide" data-ride="carousel">
            <!-- begin carousel-indicators -->
            <ol class="carousel-indicators">
              <?php
                            $this->db->order_by('id_slide','DESC');
              $data_slide = $this->db->get('tbl_slide');
              $jml = $data_slide->num_rows();
              for ($i=0; $i < $jml; $i++) {
              ?>
                <li data-target="#carousel-post" data-slide-to="<?php echo $i; ?>"<?php if($i==0){ echo ' class="active"';} ?>></li>
              <?php
              }
              ?>

            </ol>
            <!-- end carousel-indicators -->
            <!-- begin carousel-inner -->
            <div class="carousel-inner">
              <?php
              $i=1;
               foreach ($data_slide->result() as $key => $value): ?>
                <div class="item <?php if($i==1){echo "active";} ?>">
                    <a href="javascript:;">
                      <img src="<?php echo $value->foto_slide; ?>" alt="<?php echo $value->ket_slide; ?>" style="max-height:610px;width:100%;">
                    </a>
                    <div class="carousel-caption">
                      <h3><?php echo $value->ket_slide; ?></h3>
                      <!-- <p>...</p> -->
                    </div>
                </div>
              <?php
              $i++;
              endforeach; ?>
            </div>
            <!-- end carousel-inner -->
            <!-- begin carousel-control -->
            <a class="left carousel-control" href="#carousel-post" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            </a>
            <a class="right carousel-control" href="#carousel-post" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            </a>

            <!-- end carousel-control -->
            
        </div>
        
        <!-- </div> -->
        <!-- <div class="container">
            <h1><?php echo $this->Mcrud->judul_web(1); ?></h1>
            <p><?php echo $this->Mcrud->judul_web(2); ?></p>
        </div> -->
    </div>
 
<!-- end #page-title -->
<section id="galeri" class="home-section bg-gray">
			<div class="container">
			  <div class="row">
				  <div class="col-md-offset-2 col-md-8">
					<div class="section-heading">
					 <h2>Galeri</h2>
					 <p>Kumpulan foto-foto kegiatan Badan Perancanaan Pembangunan Daerah Kabupaten Serang </p>
					</div>
				  </div>
			  </div>
				<div class="row">
					<div class="col-md-offset-2 col-md-8">
					<ul class="lb-album">

						<li>
							<a href="#image-1">
								<img src="img/works/thumbs/1.PNG" alt="">
								<span>+</span>
							</a>
							<div class="lb-overlay" id="image-1">
								<img src="img/works/1.PNG" alt="" />
								<div>
									<h3>Kegiatan</h3>
                 				 	<p>Penandatanganan Pakta Integritas Perjanjian Kinerja Tahun 2022 di lingkungan Bappeda Kabupaten Serang</p>
								</div>
							</div>
						</li>

						<li>
							<a href="#image-2">
								<img src="img/works/thumbs/2.PNG" alt="">
								<span>+</span>
							</a>
							<div class="lb-overlay" id="image-2">
								<img src="img/works/2.PNG" alt="" />
								<div>
									<h3>Kegiatan</h3>
									<p>pelaksanaan Musrenbang di Tingkat Kecamatan </p>
								</div>
								
							</div>
						</li>

						<li>
							<a href="#image-3">
								<img src="img/works/thumbs/3.JPG" alt="">
								<span>+</span>
							</a>
							<div class="lb-overlay" id="image-3">
								<img src="img/works/3.JPG" alt="" />
								<div>
									<h3>Kegiatan</h3>
									<p>rapat rencana program Penelitian dan pengembangan (Litbang) penjaringan inovasi.</p>
								</div>
								
							</div>
						</li>

						<li>
							<a href="#image-4">
								<img src="img/works/thumbs/4.JPG" alt="">
								<span>+</span>
							</a>
							<div class="lb-overlay" id="image-4">
								<img src="img/works/4.JPG" alt="" />
								<div>
									<h3>Kegiatan</h3>
									<p>Pelaksanaan program Penelitian dan pengembangan (Litbang) penjaringan inovasi. </p>
								</div>
								
							</div>
						</li>
						
						<li>
							<a href="#image-5">
								<img src="img/works/thumbs/5.JPG" alt="">
								<span>+</span>
							</a>
							<div class="lb-overlay" id="image-5">
								<img src="img/works/5.JPG" alt="" />
								<div>
									<h3>Kegiatan</h3>
									<p>BMP melakukan Audiensi program sekolah sehat bersama Kepala Bappeda Kabupaten Serang </p>
								</div>
								
							</div>
						</li>
						<li>
							<a href="#image-6">
								<img src="img/works/thumbs/6.JPEG" alt="">
								<span>+</span>
							</a>
							<div class="lb-overlay" id="image-6">
								<img src="img/works/6.JPEG" alt="" />
								<div>
									<h3>Kegiatan</h3>
									<p>Diskominfo Kab Tangerang Terima Kunker Bappeda Kab Serang</p>
								</div>
								
							</div>
						</li>
						<li>
							<a href="#image-7">
								<img src="img/works/thumbs/7.JPG" alt="">
								<span>+</span>
							</a>
							<div class="lb-overlay" id="image-7">
								<img src="img/works/7.JPG" alt="" />
								<div>
									<h3>Kegiatan</h3>
									<p>penandatanganan Kerjasama swakelola tipe 3 bertempat di ruang rapat Bappeda Kab.Serang.</p>
								</div>
								
							</div>
						</li>
						<li>
							<a href="#image-8">
								<img src="img/works/thumbs/8.JPG" alt="">
								<span>+</span>
							</a>
							<div class="lb-overlay" id="image-8">
								<img src="img/works/8.JPG" alt="" />
								<div>
									<h3>Kegiatan</h3>
									<p>menyusun rencana program jangka menengah daerah (RPJMD) 2021-2026 </p>
								</div>
								
							</div>
						</li>
					</ul>
					
					</div>
				</div>
			</div>
		</section>	  
    

    <!-- <center>
        <img src="img/cover/stukture.png" alt="" width="100%"/> </center>
	 Contact -->
   
	  <!-- <section id="contact" class="home-section bg-white">
	  	<div class="container">
			  <div class="row">
				  <div class="col-md-offset-2 col-md-8">
					<div class="section-heading">
					 <h2>Hubungi Kami</h2>
					 <p>Contact via form below and we will be get in touch with you within 24 hours. </p>
					</div>
				  </div>
			  </div>

	  		<div class="row">
	  			<div class="col-md-offset-1 col-md-10">

				<form class="form-horizontal" role="form">
				  <div class="form-group">
					<div class="col-md-offset-2 col-md-8">
					  <input type="text" class="form-control" id="inputName" placeholder="Name">
					</div>
				  </div>
				  <div class="form-group">
					<div class="col-md-offset-2 col-md-8">
					  <input type="email" class="form-control" id="inputEmail" placeholder="Email">
					</div>
				  </div>
				  <div class="form-group">
					<div class="col-md-offset-2 col-md-8">
					  <input type="text" class="form-control" id="inputSubject" placeholder="Subject">
					</div>
				  </div>
				  <div class="form-group">
					<div class="col-md-offset-2 col-md-8">
					  <textarea name="message" class="form-control" rows="3" placeholder="Message"></textarea>
					</div>
				  </div>
				  <div class="form-group">
					<div class="col-md-offset-2 col-md-8">
					 <button type="button" class="btn btn-theme btn-lg btn-block">Send message</button>
					</div>
				  </div>
				</form>
	
</div>
	</div>
		</div>
				</section>   -->
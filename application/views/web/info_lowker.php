<!-- begin #page-title -->
    <div id="page-title" class="page-title has-bg">
        <div class="bg-cover"><img src="img/cover/a.jpg" alt="" width="100%"/></div>
        <div class="container">
            <h1>Info Lowongan Kerja</h1>
            <h2 style="color: white;">Badan Perencanaan Pembangunan Daerah Kabupaten Serang</h2>
			<link rel="icon" type="image/x-icon" href="img/logo.ico"/>
        </div>
    </div>
<!-- end #page-title -->
<!-- begin #content -->
    <div id="content" class="content">
        <!-- begin container -->
        <div class="container">
            <!-- begin row -->
            <div class="row row-space-30">
							<div class="panel panel-inverse">
									<div class="panel-heading">
											<div class="panel-heading-btn">
													<!-- <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
													<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
													<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
													<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a> -->
											</div>
											<h4 class="panel-title"><b>TABEL INFO LOWONGAN KERJA</b> </h4>
									</div>
									<div class="panel-body">
										<div class="table-responsive">
											<table id="data-table" class="table table-striped table-bordered">
													<thead>
															<tr>
																<th width="1%">NO.</th>
																<th width="20%">Lowongan Pekerjaan</th>
																<th width="25%"><center>Keterangan</center></th>
																<th width="20%"><center>Waktu</center></th>
																<th width="15%"><center>Persyaratan</center></th>
															</tr>
													</thead>
													<tbody>
														<?php
														$no=1;
														 foreach ($query->result() as $baris):?>
															<tr>
																	<td><?php echo $no++; ?>.</td>
																	<td><?php echo $baris->nama; ?></td>
																	<td><center><?php echo $baris->ket; ?></center></td>
  																<td><?php echo $this->Mcrud->tgl_id(date('d-m-Y H:i:s', strtotime($baris->tgl_info_lowker)),'full'); ?></td>
																	<td align="center"><a href="<?php echo $baris->file; ?>" class="btn btn-primary btn-xs" target="_blank"><i class="fa fa-cloud-download"></i></a></td>
															</tr>
														<?php endforeach; ?>
													</tbody>
											</table>
										</div>
									</div>
							</div>

            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    <!-- end #content -->

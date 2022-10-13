<?php
$link1 = strtolower($this->uri->segment(1));
$link2 = strtolower($this->uri->segment(2));
$link3 = strtolower($this->uri->segment(3));
$link4 = strtolower($this->uri->segment(4));
?>
<!-- begin #content -->
		<div id="content" class="content">
			<!-- begin breadcrumb -->
			<ol class="breadcrumb pull-right">
				<li><a href="dashboard.html">Dashboard</a></li>
				<li class="active"><?php echo $judul_web; ?></li>
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header">Data <small><?php echo $judul_web; ?></small></h1>
			<!-- end page-header -->

			<!-- begin row -->
			<div class="row">
			    <!-- begin col-12 -->
			    <div class="col-md-12">
			        <!-- begin panel -->
              <?php
                echo $this->session->flashdata('msg');
              ?>
                    <div class="panel panel-inverse">
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                            </div>
                            <h4 class="panel-title">Data Table</h4>
                        </div>
                    <div class="panel-body">
							<div class="row">
								<div class="col-md-2">
									<div class="form-group"> <b>Dari Tanggal</b>
						            <div class="input-group">
						            <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
						             <input type="text" name="tgl1" id="tgl_1" class="form-control daterange-single" value="<?php echo $tgl1; ?>" maxlength="10" required>
						</div>
						</div>
						</div>
					<div class="col-md-2">
						                  <div class="form-group"> <b>Sampai dengan Tanggal</b>
						                    <div class="input-group">
						                      <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
						                      <input type="text" name="tgl2" id="tgl_2" class="form-control daterange-single" value="<?php echo $tgl2; ?>" maxlength="10" required>
						                    </div>
						                  		</div>
													</div>
														<div class="col-md-2">
															<br>
															<button onclick="tampilkan();" class="btn btn-success" style="width:100%;">Tampilkan</button>
														</div>
														
														<div class="col-md-3"></div>
																		<div class="col-md-3">
															<br>
		                         							 <a href="<?php echo $link1; ?>/<?php echo $link2; ?>/<?php echo $link3; ?>/<?php echo $link4; ?>/excel.html" class="btn btn-success" style="float:right;"><i class="fa fa-file-excel-o"></i> Download</a>
														</div>
															</div>
																<hr>
																<div class="table-responsive">
                            <table id="data-table" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th width="1%">NO.</th>
										<th width="3%">ID.Registrasi</th>
										<th width="25%">Nama Peserta</th>
                                        <th width="20%">Tgl. Lahir</th>
                                        <th width="14%">Alamat</th>
                                        <th width="15%">Email</th>
                                        <th width="14%">Terdaftar</th>
                                        <th width="10%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  <?php
                                  $no=1;
                                   foreach ($query->result() as $baris):?>
                                    <tr>
                                        <td><?php echo $no++; ?>.</td>
											<td><?php echo $baris->id_karyawan; ?></td>
											<td><?php echo $baris->nama; ?></td>
											<td><?php echo $this->Mcrud->tgl_id(date('d-m-Y', strtotime($baris->tgl_lahir)),'full'); ?></td>
											<td><?php echo $baris->alamat; ?></td>
											<td><?php echo $baris->email; ?></td>
										    <td><?php echo $this->Mcrud->tgl_id(date('d-m-Y H:i:s', strtotime($baris->tgl_karyawan)),'full'); ?></td>
										<td align="center">
										 <a href="<?php echo $link1; ?>/<?php echo $link2; ?>/<?php echo $link3; ?>/<?php echo $link4; ?>/d/<?php echo hashids_encrypt($baris->id_user); ?>" class="btn btn-primary btn-xs" title="Detail"><i class="fa fa-list"></i></a>
                                          <a href="<?php echo $link1; ?>/<?php echo $link2; ?>/<?php echo $link3; ?>/<?php echo $link4; ?>/h/<?php echo hashids_encrypt($baris->id_user); ?>" class="btn btn-danger btn-xs" title="Hapus" onclick="return confirm('Anda yakin?');"><i class="fa fa-trash-o"></i></a>
                                        </td>
                                    </tr>
                                  <?php endforeach; ?>
                                </tbody>
                            </table>
													</div>
                        </div>
                    </div>
                    <!-- end panel -->
                </div>
                <!-- end col-12 -->
            </div>
            <!-- end row -->
		</div>
		<!-- end #content -->

		<script src="assets/js/jquery.min.js"></script>
		<link rel="stylesheet" type="text/css" href="assets/panel/plugin/datetimepicker/jquery.datetimepicker.css"/>
		<script src="assets/panel/plugin/datetimepicker/jquery.datetimepicker.js"></script>
		<script>
		$('#tgl_1').datetimepicker({
			lang:'en',
			timepicker:false,
			format:'d-m-Y'
		});
		$('#tgl_2').datetimepicker({
			lang:'en',
			timepicker:false,
			format:'d-m-Y'
		});

		function tampilkan()
		{
			tgl1 = $('#tgl_1').val();
			tgl2 = $('#tgl_2').val();
			if (tgl1=='' || tgl2=='') {
				alert('Tanggal wajib diisi!');
				return false;
			}
			window.location.href = "karyawan/v/"+tgl1+"/"+tgl2;
		}
		</script>

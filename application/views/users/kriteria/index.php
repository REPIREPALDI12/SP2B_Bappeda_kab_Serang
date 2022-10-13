
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
												<style>
													 #bg {background:#222;color:#FFF;}
												</style>
                        <div class="panel-body">
													<?php if ($c_bobot < 1): ?>
													<a href="<?php echo strtolower($this->uri->segment(1)); ?>/<?php echo strtolower($this->uri->segment(2)); ?>/t.html" class="btn btn-primary">Tambah <?php echo $judul_web; ?></a>
													<hr>
													<?php endif; ?>
													<div class="table-responsive">
                            <table id="data-tablex" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th id="bg" width="1%">NO.</th>
                                        <th id="bg">Kriteria</th>
                                        <th id="bg" width="10%">Bobot</th>
                                        <th id="bg" width="10%">Persentase</th>
                                        <th id="bg" width="15%">Tanggal</th>
                                        <th id="bg" width="10%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  <?php
                                  $no=1;
																	$t_bobot=0;
                                   foreach ($query->result() as $baris):?>
                                    <tr>
                                        <td><?php echo $no++; ?>.</td>
																				<td><?php echo $baris->nama_kriteria; ?></td>
																				<td align="center"><?php echo $baris->bobot; ?></td>
																				<td align="center"><?php echo $this->Mcrud->persen($baris->bobot); ?></td>
																				<td><?php echo $this->Mcrud->tgl_id(date('d-m-Y H:i:s',strtotime($baris->tgl_kriteria))); ?></td>
																				<td align="center">
																					<a href="<?php echo strtolower($this->uri->segment(1)); ?>/<?php echo strtolower($this->uri->segment(2)); ?>/e/<?php echo hashids_encrypt($baris->id_kriteria); ?>" class="btn btn-success btn-xs" title="Edit"><i class="fa fa-edit"></i></a>
                                          <a href="<?php echo strtolower($this->uri->segment(1)); ?>/<?php echo strtolower($this->uri->segment(2)); ?>/h/<?php echo hashids_encrypt($baris->id_kriteria); ?>" class="btn btn-danger btn-xs" title="Hapus" onclick="return confirm('Anda yakin?');"><i class="fa fa-trash-o"></i></a>
                                        </td>
                                    </tr>
                                  <?php
																$t_bobot += $baris->bobot;
																		endforeach; ?>
                                </tbody>
																<tfoot>
																	<tr>
																		<th></th>
																		<th></th>
																		<th class="text-center"><?php echo $t_bobot; ?></th>
																		<th class="text-center"><?php echo $this->Mcrud->persen($t_bobot); ?></th>
																		<th></th>
																		<th></th>
																	</tr>
																</tfoot>
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

<!-- Main content -->
<div class="content-wrapper">
  <!-- Content area -->
  <div class="content">

    <!-- Dashboard content -->
    <div class="row">
      <div class="col-md-3"></div>
      <div class="col-md-6">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                </div>
                <h4 class="panel-title"><?php echo $judul_web; ?></h4>
            </div>
            <div class="panel-body">
                <?php
                $foto_profile = "assets/panel/img/user-default.jpg";
                $foto_k = $query->foto;
              	if ($foto_k!='') {
              		if(file_exists("$foto_k")){
              			$foto_profile = $foto_k;
              		}
              	}

                echo $this->session->flashdata('msg');
                ?>
                <?php $level = $this->session->userdata('level'); ?>
                <?php if ($level=='user'){ ?>
                  <a href="karyawan" class="btn btn-success"><i class="fa fa-pencil"></i> Edit Data</a>
                <?php } ?>
                <a href="karyawan/cetak_kartu/<?php echo hashids_encrypt($query->id_karyawan); ?>" class="btn btn-primary" style="float:right" target="_blank"><i class="fa fa-credit-card"></i> Cetak Kartu</a>
                <table class="table table-bordered table-striped" width="100%">
                  <tbody>
                    <tr>
                      <th colspan="3">
                        <center>
                          <img src="<?php echo $foto_profile; ?>" alt="" width="150">
                        </center>
                      </th>
                    </tr>
                    <tr>
                      <th width="150">ID Registrasi</th>
                      <th width="1">:</th>
                      <td><?php echo $query->id_karyawan; ?></td>
                    </tr>
                    <tr>
                      <th>Nama Lengkap</th>
                      <th>:</th>
                      <td><?php echo $query->nama_lengkap; ?></td>
                    </tr>
                    <tr>
                      <th>Tempat, Tgl. Lahir</th>
                      <th>:</th>
                      <td><?php echo $query->tempat_lahir; ?>, <?php echo $this->Mcrud->tgl_id(date('d-m-Y',strtotime($query->tgl_lahir)),'full'); ?></td>
                    </tr>
                    <tr>
                      <th>Jenis Kelamin</th>
                      <th>:</th>
                      <td><?php echo $query->jk; ?></td>
                    </tr>
                    <tr>
                      <th>Pengalaman Kerja</th>
                      <th>:</th>
                      <td><?php echo $query->pengalaman_kerja; ?> Tahun</td>
                    </tr>
                    <tr>
                      <th>Usia</th>
                      <th>:</th>
                      <td><?php echo $query->usia; ?> Tahun</td>
                    </tr>
                    <tr>
                      <th>Status Pernikahan</th>
                      <th>:</th>
                      <td><?php echo $query->status_pernikahan; ?></td>
                    </tr>
                    <tr>
                      <th>Agama</th>
                      <th>:</th>
                      <td><?php echo $query->agama; ?></td>
                    </tr>
                    <tr>
                      <th>Alamat</th>
                      <th>:</th>
                      <td><?php echo $query->alamat; ?></td>
                    </tr>
                    <tr>
                      <th>Provinsi</th>
                      <th>:</th>
                      <td><?php echo $query->provinsi; ?></td>
                    </tr>
                    <tr>
                      <th>Kota</th>
                      <th>:</th>
                      <td><?php echo $query->kota; ?></td>
                    </tr>
                    <tr>
                      <th>No. HP</th>
                      <th>:</th>
                      <td><?php echo $query->no_hp; ?></td>
                    </tr>
                    <tr>
                      <th>Email</th>
                      <th>:</th>
                      <td><?php echo $query->email; ?></td>
                    </tr>
                    <tr>
                      <th>Kesehatan</th>
                      <th>:</th>
                      <td><?php echo $query->kesehatan; ?></td>
                    </tr>
                    <!-- <tr>
                      <th>Penampilan</th>
                      <th>:</th>
                      <td><?php echo $query->penampilan; ?></td>
                    </tr> -->
                    <tr>
                      <th>Pendidikan Terakhir</th>
                      <th>:</th>
                      <td><?php echo $query->pendidikan_terakhir; ?></td>
                    </tr>
                    <tr>
                      <th>Asal Sekolah</th>
                      <th>:</th>
                      <td><?php echo $query->asal_sekolah; ?></td>
                    </tr>
                    <tr>
                      <th>Jurusan</th>
                      <th>:</th>
                      <td><?php echo $query->jurusan; ?></td>
                    </tr>
      
                    <tr>
                      <th>Nilai Ijasah/IPK</th>
                      <th>:</th>
                      <td><?php echo $query->nilai_ujian_akhir; ?></td>
                    </tr>
                    <tr>
                      <th>Username</th>
                      <th>:</th>
                      <td><?php echo $query->username; ?></td>
                    </tr>
                    <tr>
                      <th>Password</th>
                      <th>:</th>
                      <td><?php echo $query->password; ?></td>
                    </tr>
                    <tr>
                      <th>Tanggal Terdaftar</th>
                      <th>:</th>
                      <td><?php echo $this->Mcrud->tgl_id(date('d-m-Y H:i:s',strtotime($query->tgl_karyawan)),'full'); ?></td>
                    </tr>
                    <tr>
                      <th>Dokumen Pendidikan</th>
                      <th>:</th>
                      <td><?php echo !empty($query->pendidikan) ? 'Sudah Upload' : "Belum Upload" ?></td>
                    </tr>
                    <tr>
                      <th>Dokumen Nilai</th>
                      <th>:</th>
                      <td><?php echo !empty($query->nilai) ? 'Sudah Upload' : "Belum Upload" ?></td>
                    </tr>
                    <tr>
                      <th>Dokumen KTP</th>
                      <th>:</th>
                      <td><?php echo !empty($query->ktp) ? 'Sudah Upload' : "Belum Upload" ?></td>
                    </tr>
                    <tr>
                      <th>Dokumen Surat Kesehatan</th>
                      <th>:</th>
                      <td><?php echo !empty($query->surat_kesehatan) ? 'Sudah Upload' : "Belum Upload" ?></td>
                    </tr>
                  </tbody>
                </table>

                <center>
                  <?php if ($level!='user'){?>
                    <a href="karyawan" class="btn btn-primary">Kembali</a>
                  <?php } ?>
                </center>

            </div>

        </div>
      </div>
    </div>
    <!-- /dashboard content -->

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
                echo $this->session->flashdata('msg');
                ?>
                <form class="form-horizontal" action="" data-parsley-validate="true" method="post" enctype="multipart/form-data">
                  <div class="form-group">
                    <label class="control-label col-lg-3">ID Registrasi</label>
                    <div class="col-lg-9">
                      <input type="text" class="form-control" value="<?php echo $query->id_karyawan; ?>" readonly>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-lg-3">Foto</label>
                    <div class="col-lg-9">
                      <input type="file" name="foto" class="form-control">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-lg-3">Nama</label>
                    <div class="col-lg-9">
                      <input type="text" name="nama" class="form-control" value="<?php echo $query->nama; ?>" placeholder="Nama Lengkap" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-lg-3">Tempat Lahir</label>
                    <div class="col-lg-9">
                      <input type="text" name="tempat_lahir" class="form-control" value="<?php echo $query->tempat_lahir; ?>" placeholder="Tempat Lahir" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-lg-3">Tanggal Lahir</label>
                    <div class="col-lg-3">
                      <input type="text" name="tgl_lahir" id="tgl_1" class="form-control" value="<?php if($query->tgl_lahir!=''){echo date('d-m-Y',strtotime($query->tgl_lahir));}else{echo date('d-m-Y',strtotime('-20 year',strtotime(date('d-m-Y'))));} ?>" placeholder="Tanggal Lahir" maxlength="10" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-lg-3">Jenis Kelamin</label>
                    <div class="col-lg-9">
                      <div class="radio radio-css radio-inline radio-primary">
                        <input type="radio" name="jk" id="jk_1" value="Laki-Laki" <?php if($query->jk=="Laki-Laki"){echo "checked";} ?> required>
                        <label for="jk_1">
                          Laki-Laki
                        </label>
                      </div>
                      <div class="radio radio-css radio-inline radio-primary">
                        <input type="radio" name="jk" id="jk_2" value="Perempuan" <?php if($query->jk=="Perempuan"){echo "checked";} ?> required>
                        <label for="jk_2">
                          Perempuan
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-lg-3">Pengalamam Kerja (TAHUN)</label>
                    <div class="col-lg-3">
                      <input type="text" name="pengalaman_kerja" class="form-control" value="<?php echo $query->pengalaman_kerja; ?>" placeholder="Pengalaman Kerja" onkeypress="return hanyaAngka(event)" maxlength="3" required>
                    </div>
                    <label class="control-label col-lg-3">Usia (Tahun)</label>
                    <div class="col-lg-3">
                      <input type="text" name="usia" class="form-control" value="<?php echo $query->usia; ?>" placeholder="Usia" onkeypress="return hanyaAngka(event)" maxlength="3" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-lg-3">Status Pernikahan</label>
                    <div class="col-lg-9">
                      <select class="form-control default-select2" name="status_pernikahan" required>
                        <?php echo $this->Mcrud->sel_option('status_pernikahan',$query->status_pernikahan); ?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-lg-3">Agama</label>
                    <div class="col-lg-9">
                      <select class="form-control default-select2" name="agama" required>
                        <?php echo $this->Mcrud->sel_option('agama',$query->agama); ?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-lg-3">Alamat</label>
                    <div class="col-lg-9">
                      <textarea name="alamat" class="form-control" rows="4" cols="80" required placeholder="Alamat"><?php echo $query->alamat; ?></textarea>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-lg-3">Provinsi</label>
                    <div class="col-lg-9">
                      <input type="text" name="provinsi" class="form-control" value="<?php echo $query->provinsi; ?>" placeholder="Provinsi" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-lg-3">Kota</label>
                    <div class="col-lg-9">
                      <input type="text" name="kota" class="form-control" value="<?php echo $query->kota; ?>" placeholder="Kota" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-lg-3">No. HP</label>
                    <div class="col-lg-9">
                      <input type="text" name="no_hp" class="form-control" value="<?php echo $query->no_hp; ?>" placeholder="no. HP" maxlength="14" onkeypress="return hanyaAngka(event);" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-lg-3">Email</label>
                    <div class="col-lg-9">
                      <input type="email" name="email" class="form-control" value="<?php echo $query->email; ?>" placeholder="Email" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-lg-3">Kesehatan</label>
                    <div class="col-lg-9">
                      <select class="form-control default-select2" name="kesehatan" required>
                        <?php echo $this->Mcrud->sel_option('kesehatan',$query->kesehatan); ?>
                      </select>
                    </div>
                  </div>
                  <!-- <div class="form-group">
                    <label class="control-label col-lg-3">Penampilan</label>
                    <div class="col-lg-9">
                      <select class="form-control default-select2" name="penampilan" required>
                        <?php echo $this->Mcrud->sel_option('penampilan',$query->penampilan); ?>
                      </select>
                    </div>
                  </div> -->
                  <div class="form-group">
                    <label class="control-label col-lg-3">Pendidikan Terakhir</label>
                    <div class="col-lg-9">
                      <select class="form-control default-select2" name="pendidikan_terakhir" required>
                        <option value="S1" <?= $query->pendidikan_terakhir== "S1" ? "selected" : "" ?>>S1</option>
                        <option value="D3" <?= $query->pendidikan_terakhir== "D3" ? "selected" : "" ?>>D3</option>
                        <option value="D2" <?= $query->pendidikan_terakhir== "D2" ? "selected" : "" ?>>D2</option>
                        <option value="SMA" <?= $query->pendidikan_terakhir== "SMA" ? "selected" : "" ?>>SMA</option>
                        <option value="SMK" <?= $query->pendidikan_terakhir== "SMA" ? "selected" : "" ?>>SMK</option>
                        <option value="SMP" <?= $query->pendidikan_terakhir== "SMP" ? "selected" : "" ?>>SMP</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-lg-3">Asal Sekolah</label>
                    <div class="col-lg-9">
                      <input type="text" name="asal_sekolah" class="form-control" value="<?php echo $query->asal_sekolah; ?>" placeholder="Asal Sekolah" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-lg-3">Jurusan</label>
                    <div class="col-lg-9">
                      <input type="text" name="jurusan" class="form-control" value="<?php echo $query->jurusan; ?>" placeholder="Jurusan" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-lg-3">Nilai Ijasah/IPK</label>
                    <div class="col-lg-9">
                      <input type="text" name="nilai_ujian_akhir" class="form-control" value="<?php echo $query->nilai_ujian_akhir; ?>" placeholder="Nilai Ujian Akhir" required>
                    </div>
                  </div>
                  <hr>
                  <div class="form-group">
                    <label class="control-label col-lg-3">Dokumen Pendidikan</label>
                    <div class="col-lg-9">
                      <input type="file" name="dokumen_pendidikan" class="form-control">
                      <small id="passwordHelpBlock" class="form-text text-muted" style="color: red;">
                        Wajib Upload PDF**
                      </small>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-lg-3">Dokumen Nilai/IPK Ijasah </label>
                    <div class="col-lg-9">
                      <input type="file" name="dokumen_nilai" class="form-control">
                      <small id="passwordHelpBlock" class="form-text text-muted" style="color: red;">
                        Wajib Upload PDF**
                      </small>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-lg-3">Dokumen KTP </label>
                    <div class="col-lg-9">
                      <input type="file" name="dokumen_ktp" class="form-control">
                      <small id="passwordHelpBlock" class="form-text text-muted" style="color: red;">
                        Wajib Upload PDF**
                      </small>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-lg-3">Dokumen Surat Kesehatan </label>
                    <div class="col-lg-9">
                      <input type="file" name="dokumen_surat_kesehatan" class="form-control">
                      <small id="passwordHelpBlock" class="form-text text-muted" style="color: red;">
                        Wajib Upload PDF**
                      </small>
                    </div>
                  </div>
                  <?php $level = $this->session->userdata('level'); ?>
                  <?php if ($level=='user'){ ?>
                    <a href="karyawan/detail" class="btn btn-warning">Kembali</a>
                  <?php } ?>
                  <button type="submit" name="btnupdate" class="btn btn-primary" style="float:right;">Simpan</button>
                </form>
            </div>

        </div>
      </div>
    </div>
    <!-- /dashboard content -->


        <script src="assets/js/jquery.min.js"></script>
        <link rel="stylesheet" type="text/css" href="assets/panel/plugin/datetimepicker/jquery.datetimepicker.css"/>
        <script src="assets/panel/plugin/datetimepicker/jquery.datetimepicker.js"></script>
        <script>
        today = new Date();
        $('#tgl_1, #tgl_2').datetimepicker({
          lang:'en',
          timepicker:false,
          format:'d-m-Y'
        }).on("change", function() {
            hitung_usia();
        });

        hitung_usia();
        function hitung_usia(){
          tgl_lahir = $('#tgl_1').val();
          thn = tgl_lahir.substr(6,4);
          bln = tgl_lahir.substr(3,2);
          tgl = tgl_lahir.substr(0,2);
          past = new Date(thn,bln,tgl);
          $('[name="usia"]').val(calcDate(today,past)+1);
        }

        // alert(calcDate(today,past));
        function calcDate(date1,date2) {
            var diff = Math.floor(date1.getTime() - date2.getTime());
            var day = 1000 * 60 * 60 * 24;

            var days = Math.floor(diff/day);
            var months = Math.floor(days/31);
            var years = Math.floor(months/12);

            // var message = date2.toDateString();
            // message += " was "
            // message += days + " days "
            // message += months + " months "
            // message += years + " years ago \n"
            return years
        }
        </script>

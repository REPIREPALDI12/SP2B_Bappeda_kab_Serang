<!-- Main content -->
<div class="content-wrapper">
  <!-- Content area -->
  <div class="content">
    <!-- Dashboard content -->
    <div class="row">
      <div class="col-md-2"></div>
      <div class="panel panel-flat col-md-8">
        <?php
        echo $this->session->flashdata('msg');
    	  $level 	 = $this->session->userdata('level');
        ?>
          <div class="panel-body">
            <fieldset class="content-group">
              <legend class="text-bold"><i class="icon-printer"></i><?php echo $judul_web; ?></legend>
              <form class="form-inline" action="" method="post" target="_blank" data-parsley-validate="true">
                  <div class="col-lg-6">
                    <div class="form-group">Data Lap. &nbsp;&nbsp;&nbsp;
                      <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-file"></i></div>
                        <select class="form-control default-select2" name="jenis" required>
                        <option value="all">Pilih</option>
                          <option value="all">HASIL SELEKSI</option>
                          <!-- <option value="lulus">LULUS</option>
                          <option value="tdk_lulus">TIDAK LULUS</option> -->
                            <?php
                            for ($i=0; $i <20 ; $i++) {
                              echo "-";
                            } ?>
                          </option>
                          <option value="karyawan"> DATA PELAMAR</option>
                        </select>
                      </div>
                    </div>
                  </div>

                <div class="col-lg-12">&nbsp;</div>
                <div class="col-lg-12">
                  <div class="form-group">Dari Tanggal
                    <div class="input-group">
                      <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                      <input type="text" name="tgl1" id="tgl_1" class="form-control daterange-single" value="<?php echo date('01-m-Y'); ?>" maxlength="10" required>
                    </div>
                  </div>
                  &nbsp; Sampai dengan Tanggal
                  <div class="form-group">
                    <div class="input-group">
                      <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                      <input type="text" name="tgl2" id="tgl_2" class="form-control daterange-single" value="<?php echo date('d-m-Y',strtotime('+1 month',strtotime(date('d-m-Y')))); ?>" maxlength="10" required>
                    </div>
                  </div>
                </div>
                <div class="col-lg-12">
                <hr>
                <button type="submit" name="cetak_lap" class="btn btn-primary" style="float:right;"><i class="icon-printer2"></i> Cetak</button>
                </div>
              </form>
            </fieldset>
          </div>

      </div>
      <div class="col-md-2"></div>
    </div>
    <!-- /dashboard content -->

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
    </script>

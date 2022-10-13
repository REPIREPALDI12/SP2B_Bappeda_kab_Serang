<!-- Main content -->
<div class="content-wrapper">
  <!-- Content area -->
  <div class="content">

    <!-- Dashboard content -->
    <div class="row">
      <div class="col-md-2"></div>
      <div class="col-md-8">
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
                    <label class="control-label col-lg-2">Nama Kriteria</label>
                    <div class="col-lg-10">
                      <select class="form-control default-select2" name="id_kriteria" required>
                        <option value="">- Pilih -</option>
                        <?php foreach ($v_kriteria->result() as $key => $value):
                          if ($this->db->get_where('tbl_sub_kriteria', array('id_kriteria'=>$value->id_kriteria))->num_rows()==0) {?>
                          <option value="<?php echo $value->id_kriteria; ?>"><?php echo $value->nama_kriteria; ?></option>
                        <?php
                          }
                        endforeach; ?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-lg-12" style="border:1px solid #f1f1f1;padding:5px;">
                      <textarea name="ket" class="form-control" id="wysihtml5" rows="4" cols="80" placeholder="Keterangan" required></textarea>
                    </div>
                  </div>
                  <hr>
                  <a href="<?php echo strtolower($this->uri->segment(1)); ?>/<?php echo strtolower($this->uri->segment(2)); ?>.html" class="btn btn-default"><< Kembali</a>
                  <button type="submit" name="btnsimpan" class="btn btn-primary" style="float:right;">Simpan</button>
                </form>
            </div>

        </div>
      </div>
    </div>
    <!-- /dashboard content -->

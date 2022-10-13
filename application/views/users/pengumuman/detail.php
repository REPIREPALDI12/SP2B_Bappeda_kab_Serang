<?php
$link1 = strtolower($this->uri->segment(1));
$link2 = strtolower($this->uri->segment(2));
$link3 = strtolower($this->uri->segment(3));
$link4 = strtolower($this->uri->segment(4));
$link5 = strtolower($this->uri->segment(5));
$link6 = strtolower($this->uri->segment(6));
?>
<!-- Main content -->
<div class="content-wrapper">
  <!-- Content area -->
  <div class="content">

    <!-- Dashboard content -->
    <div class="row">
      <!-- <div class="col-md-1"></div> -->
      <div class="col-md-12">
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
                    <label class="col-lg-1">Nama:</label>
                    <label class="col-lg-11">
                      <?php echo $query->nama; ?>
                    </label>
                  </div>
                  <style>
                    #bg{background:#222;color:#fff;}
                    th{text-align: center;}
                  </style>
                  <table id="penyeleksian" class="table table-bordered table-striped" width="100%" >
                    <thead>
                      <tr>
                        <th id="bg">Kriteria</th>
                        <th id="bg">Analisis</th>
                        <th id="bg">Sub Kriteria</th>
                        <th id="bg" width="120">Bobot Kriteria</th>
                        <th id="bg" width="1%"></th>
                        <th id="bg" width="100">Nilai Range</th>
                        <th id="bg" width="100">Jumlah Nilai</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $t_bobot=0;
                      $t_jml_nilai=0;
                      $no=1;
                      $id_karyawan = hashids_decrypt($link6);
                      foreach ($v_kriteria->result() as $key => $value):
                                    $this->db->select("$value->field AS 'analisa'");
                        $analisa  = $this->db->get_where('tbl_karyawan', array('id_karyawan'=>$query->id_karyawan))->row()->analisa;
                        $data_sub = $this->db->get_where('tbl_sub_kriteria', array('id_kriteria'=>$value->id_kriteria));
                        if ($data_sub->num_rows()==0) {
                          $sub_kriteria = '-';
                        }else {
                          $sub_kriteria = $data_sub->row()->ket_sub_kriteria;
                        }
                        $data_p = $this->db->get_where('tbl_penyeleksian', array('id_karyawan'=>$id_karyawan,'id_kriteria'=>$value->id_kriteria));
                        if ($data_p->num_rows()!=0) {
                          $nilai     = $data_p->row()->nilai;
                          $jml_nilai = $data_p->row()->jml_nilai;
                        ?>
                        <tr>
                          <td><b><?php echo $value->nama_kriteria; ?></b></td>
                          <td><b><?php echo $analisa; ?></b></td>
                          <td><b><?php echo $sub_kriteria; ?></b></td>
                          <td align="center"><?php echo $value->bobot; ?></td>
                          <td><b>X</b> </td>
                          <td align="center"><?php echo $nilai; ?></td>
                          <td align="center" style="font-weight:bold"><?php echo $jml_nilai; ?></td>
                        </tr>
                      <?php
                          $no++;
                          $t_bobot += $value->bobot;
                          $t_jml_nilai += $jml_nilai;
                        }
                      endforeach; ?>
                    </tbody>
                    <tfoot>
                      <tr>
                        <td align="center"><b>TOTAL</b> </td>
                        <td></td>
                        <td></td>
                        <td align="center"><b><?php echo $t_bobot; ?></b></td>
                        <td></td>
                        <td></td>
                        <td align="center" id="total" style="background:#F1D51B;font-weight:bold"><?php echo number_format($t_jml_nilai,2); ?></td>
                      </tr>
                    </tfoot>
                  </table>
                  <center>
                    <b>KETERANGAN</b>
                    <div style="font-size:30px;">
                        <?php echo $this->Mcrud->ket_nilai($query->total_nilai,'lg'); ?>
                    </div>
                  </center>
                  <hr>
                  <a href="<?php echo $link1; ?>/<?php echo $link2; ?>/<?php echo $link3; ?>/<?php echo $link4; ?>" class="btn btn-default"><< Kembali</a>
                </form>
            </div>

        </div>
      </div>
    </div>
    <!-- /dashboard content -->

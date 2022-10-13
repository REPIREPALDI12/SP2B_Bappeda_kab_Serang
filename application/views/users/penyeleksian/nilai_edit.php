<?php
$link1 = strtolower($this->uri->segment(1));
$link2 = strtolower($this->uri->segment(2));
$link3 = strtolower($this->uri->segment(3));
$link4 = strtolower($this->uri->segment(4));
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
                  <div class="d-flex" style="margin-bottom: 10px;">
                    <?php
                      if($query->pendidikan){
                        echo '<a class="btn btn-xs btn-primary mr-2" href="'.$query->pendidikan.'" target="_blank" style="margin-right:10px;">Dokumen Pendidikan</a>';
                      }else{
                        echo '<button class="btn btn-xs btn-danger mr-2" type="button" onclick="alert(`Dokumen Belum Upload`)" style="margin-right:10px;">Dokumen Pendidikan</button>';
                      }
                      if($query->nilai){
                        echo '<a class="btn btn-xs btn-primary mr-2" href="'.$query->nilai.'" target="_blank" style="margin-right:10px;">Dokumen Nilai</a>';
                      }else{
                        echo '<button class="btn btn-xs btn-danger mr-2" type="button" onclick="alert(`Dokumen Belum Upload`)" style="margin-right:10px;">Dokumen Nilai</button>';
                      }
                      if($query->ktp){
                        echo '<a class="btn btn-xs btn-primary mr-2" href="'.$query->ktp.'" target="_blank" style="margin-right:10px;">Dokumen KTP</a>';
                      }else{
                        echo '<button class="btn btn-xs btn-danger mr-2" type="button" onclick="alert(`Dokumen Belum Upload`)" style="margin-right:10px;">Dokumen KTP</button>';
                      }
                      if($query->surat_kesehatan){
                        echo '<a class="btn btn-xs btn-primary mr-2" href="'.$query->surat_kesehatan.'" target="_blank" style="margin-right:10px;">Dokumen Surat Kesehatan</a>';
                      }else{
                        echo '<button class="btn btn-xs btn-danger mr-2" type="button" onclick="alert(`Dokumen Belum Upload`)" style="margin-right:10px;">Dokumen Surat Kesehatan</button>';
                      }
                    ?>
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
                      foreach ($v_kriteria->result() as $key => $value):
                                    $this->db->select("$value->field AS 'analisa'");
                        $analisa  = $this->db->get_where('tbl_karyawan', array('id_karyawan'=>$query->id_karyawan))->row()->analisa;
                        $data_sub = $this->db->get_where('tbl_sub_kriteria', array('id_kriteria'=>$value->id_kriteria));
                        if ($data_sub->num_rows()==0) {
                          $this->session->set_flashdata('msg',
            								'
            								<div class="alert alert-warning alert-dismissible" role="alert">
            									 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            										 <span aria-hidden="true">&times;</span>
            									 </button>
            									 <strong>Peringatan!</strong> Sub Kriteria untuk Kriteria "<b>'.$value->nama_kriteria.'</b>" belum ditambahkan.
            								</div>
            							 <br>'
            							);
                          redirect('kriteria/sub/t');
                        }else {
                          $sub_kriteria = $data_sub->row()->ket_sub_kriteria;
                        }
                        $data_p = $this->db->get_where('tbl_penyeleksian', array('id_karyawan'=>$query->id_karyawan,'id_kriteria'=>$value->id_kriteria));
                        if ($data_p->num_rows()==0) {
                          $nilai     = 0;
                          $jml_nilai = 0;
                        }else {
                          $nilai     = $data_p->row()->nilai;
                          $jml_nilai = $data_p->row()->jml_nilai;
                        }
                        ?>
                        <input type="hidden" name="analisa_<?php echo $value->id_kriteria; ?>" value="<?php echo $analisa; ?>">
                        <input type="hidden" name="sub_kriteria_<?php echo $value->id_kriteria; ?>" value="<?php echo $sub_kriteria; ?>">
                        <input type="hidden" name="bobot_<?php echo $value->id_kriteria; ?>" value="<?php echo $value->bobot; ?>">
                        <tr>
                          <td><b><?php echo $value->nama_kriteria; ?></b></td>
                          <td><b><?php echo $analisa; ?></b></td>
                          <td><b><?php echo $sub_kriteria; ?></b></td>
                          <td align="center" id="bobot_<?php echo $value->id_kriteria; ?>"><?php echo $value->bobot; ?></td>
                          <td><b>X</b> </td>
                          <td>
                            <input type="text" name="nilai_<?php echo $value->id_kriteria; ?>" value="<?php echo $nilai; ?>" onkeyup="return hitung('<?php echo $value->id_kriteria; ?>');" class="form-control" placeholder="Input Nilai" maxlength="5" style="text-align:center;width:100px;" <?php if($no==1){echo "autofocus onfocus='this.value=this.value'";} ?> required>
                          </td>
                          <td align="center" id="jumlah_<?php echo $value->id_kriteria; ?>" class="jumlah" style="font-weight:bold"><?php echo $jml_nilai; ?></td>
                        </tr>
                      <?php
                      $no++;
                      $t_bobot += $value->bobot;
                      $t_jml_nilai += $jml_nilai;
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
                  <hr>
                  <a href="<?php echo $link1; ?>/<?php echo $link2; ?>/<?php echo $link3; ?>/<?php echo $link4; ?>.html" class="btn btn-default"><< Kembali</a>
                  <button type="submit" name="btnupdate" class="btn btn-primary" style="float:right;">Simpan</button>
                </form>
            </div>

        </div>
      </div>
    </div>
    <!-- /dashboard content -->

      <script type="text/javascript">
        function hitung(id){
          nilai  = $('[name="nilai_'+id+'"]');
          jumlah = $('#jumlah_'+id+'');

          $.ajax({
           type: "POST",
           data: "id="+id+"&nilai="+nilai.val()+"&btnkirim=kirim",
           url: "penyeleksian/hitung",
           cache: false,
           dataType: "JSON",
           beforeSend:function()
           {
             jumlah.html('Menghitung...');
           },
           success: function(data){
             jumlah.html(data.jumlah);
             total();
           },
           error: function (jqXHR, textStatus, errorThrown)
           {
             jumlah.html('Error! Silahkan <b>Refresh</b> halaman :)');
           }
          });
        return false;
        }

        function total()
        {
          var sum = 0;
          $('#penyeleksian > tbody > tr').each(function() {
             var jumlah = parseFloat($(this).find('.jumlah').html());
             sum+=jumlah;
             $(this).find('.jumlah').html(''+jumlah);
          });
          $('#total').html(sum.toFixed(2));
        }
      </script>

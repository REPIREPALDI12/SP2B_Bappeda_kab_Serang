<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title><?php echo $judul_web; ?></title>
    <base href="<?php echo base_url();?>"/>
  	<link rel="icon" type="image/png" href="assets/favicon.png"/>
    <style>
    table {
        border-collapse: collapse;
    }
    th, td {
      padding: 0px;
      font-size: 12px;
    }
    th {
        color: #EDD062;
    }
    .p_left{padding-left: 2px;}
    </style>
    <!-- <style type="text/css" media="print">
      @page { size: landscape; }
    </style> -->
  </head>
  <body onload="window.print()">

  <center>
    <table border="0" width="450">
      <tr style="border:1px solid #EDD062;">
        <td>
          <center><img src="img/logo-kop.png" alt="" width="60" height="60" style="margin:5px;"></center>
        </td>
        <td valign="top" colspan="3" style="padding-left:5px;padding-top:15px;">
          <center>
            <span style="font-size:12px;"><b>Badan Perancanaan Pembangunan Daerah Kabupaten Serang</b></span>
            <br>
            <span style="font-size:12px;"></span>
            <span style="font-size:8px;">Jl. Veteran No.I, Kotabaru, Kec. Serang, Kota Serang, Banten 42112</span>
            <br>
          </center>
        </td>
      </tr>
      <tr style="border-left:1px solid #EDD062;border-right:1px solid #EDD062;">
        <td colspan="4"><br> </td>
      </tr>
      <tr style="border-left:1px solid #EDD062;border-right:1px solid #EDD062;">
        <td rowspan="6" width="100" style="border-bottom:1px solid #EDD062;">
          <center><img src="<?php echo $query->foto; ?>" alt="Foto" width="80" height="90" style="border:1px solid #EDD062;margin:5px;margin-top:0px;"></center>
        </td>
        <td valign="top" width="70" height="10" class="p_left">NO ID</td>
        <td valign="top" width="1">:</td>
        <td valign="top" class="p_left"><?php echo $query->id_karyawan; ?></td>
      </tr>
      <tr style="border-right:1px solid #EDD062;">
        <td valign="top" class="p_left" height="10">Nama</td>
        <td valign="top">:</td>
        <td valign="top" class="p_left"><?php echo $query->nama; ?></td>
      </tr>
      <tr style="border-right:1px solid #EDD062;">
        <td valign="top" class="p_left" height="10">Pendidikan</td>
        <td valign="top">:</td>
        <td valign="top" class="p_left"><?php echo $query->pendidikan_terakhir; ?></td>
      </tr>
      <tr style="border-right:1px solid #EDD062;">
        <td valign="top" class="p_left" height="10">Jurusan</td>
        <td valign="top">:</td>
        <td valign="top" class="p_left"><?php echo $query->jurusan; ?></td>
      </tr>
      <tr style="border-right:1px solid #EDD062;">
        <td valign="top" class="p_left" height="10">Alamat</td>
        <td valign="top">:</td>
        <td valign="top" class="p_left"><?php echo $query->alamat; ?></td>
      </tr>
      <tr style="border-right:1px solid #EDD062;border-bottom:1px solid #EDD062;">
        <td valign="top" class="p_left">Tanggal Lahir</td>
        <td valign="top">:</td>
        <td valign="top" class="p_left"><?php echo $query->tempat_lahir; ?>, <?php echo date('d-m-Y',strtotime($query->tgl_lahir)); ?></td>
      </tr>
    </table>
  </center>

  </body>
</html>

<?php
$tgl = "$tgl1 - $tgl2";
$file="$judul_web.xls";
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=$file");
?>
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
      padding: 2px;
    }

    th {
        color: #222;
    }
    </style>
    <style type="text/css" media="print">
      @page { size: landscape; }
    </style>
  </head>
  <body onload="window.print()">

    <?php //$this->load->view('users/laporan/kop'); ?>

    <center>
      <h3><?php echo strtoupper($judul_web); ?></h3>
    </center>

    <table border="1" width="100%">
        <thead>
            <tr>
                <th width="1%">NO.</th>
                <!-- <th>Foto</th> -->
                <th>Nama Pegawai</th>
                <th>Tempat, Tgl Lahir</th>
                <th>Jenis Kelamin</th>
                <th>Pengalaman Kerja</th>
                <th>Usia</th>
                <th>Status Pernikahan</th>
                <th>Agama</th>
                <th>Alamat</th>
                <th>No. HP</th>
                <th>Email</th>
                <th>Provinsi</th>
                <th>Kota</th>
                <th>Kesehatan</th>
                <!-- <th>Penampilan</th> -->
                <th>Pendidikan Terakhir</th>
                <th>Asal Sekolah</th>
                <th>Jurusan</th>
                <th>Nilai Ijasah/IPK</th>
            </tr>
        </thead>
        <tbody>
          <?php
          $no=1;
           foreach ($query->result() as $baris):?>
            <tr>
                <td valign="top"><b><?php echo $no++; ?>.</b> </td>
                <!-- <td><img src="<?php echo $baris->foto; ?>" alt="foto" width="50"></td> -->
                <td valign="top"><?php echo $baris->nama; ?></td>
                <td valign="top"><?php echo $baris->tempat_lahir; ?>, <?php echo date('d-m-Y',strtotime($baris->tgl_lahir)); ?></td>
                <td valign="top"><?php echo $baris->jk; ?></td>
                <td valign="top"><?php echo $baris->pengalaman_kerja; ?></td>
                <td valign="top"><?php echo $baris->usia; ?></td>
                <td valign="top"><?php echo $baris->status_pernikahan; ?></td>
                <td valign="top"><?php echo $baris->agama; ?></td>
                <td valign="top"><?php echo $baris->alamat; ?></td>
                <td valign="top"><?php echo $baris->no_hp; ?></td>
                <td valign="top"><?php echo $baris->email; ?></td>
                <td valign="top"><?php echo $baris->provinsi; ?></td>
                <td valign="top"><?php echo $baris->kota; ?></td>
                <td valign="top"><?php echo $baris->kesehatan; ?></td>
                <!-- <td valign="top"><?php echo $baris->penampilan; ?></td> -->
                <td valign="top"><?php echo $baris->pendidikan_terakhir; ?></td>
                <td valign="top"><?php echo $baris->asal_sekolah; ?></td>
                <td valign="top"><?php echo $baris->jurusan; ?></td>
                <td valign="top"><?php echo $baris->nilai_ujian_akhir; ?></td>
            </tr>
          <?php
          endforeach; ?>
        </tbody>
    </table>

  </body>
</html>

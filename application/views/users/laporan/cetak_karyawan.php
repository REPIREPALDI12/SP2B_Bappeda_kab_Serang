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

    <?php $this->load->view('users/laporan/kop'); ?>

    <table border="0" width="100%">
      <tr style="border:0px solid #222;border-bottom:1px solid #fff;">
        <th colspan="4"><?php echo strtoupper($judul_web); ?></th>
      </tr>
      <tr style="border:0px solid #222;border-top:1px solid #fff;font-size:10px;">
        <td colspan="4" align="center"><?php echo strtoupper($tgl); ?> <br><br> </td>
      </tr>
    </table>

    <table border="1" width="100%">
        <thead>
            <tr>
                <th width="1%">NO.</th>
                <th>Foto</th>
                <th>Nama Pegawai</th>
                <th>Tempat tanggal lahir</th>
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
                <th>Pendidikan Terakhir</th>
                <th>Asal Sekolah</th>
                <th>Jurusan</th>
            </tr>
        </thead>
        <tbody>
          <?php
          $no=1;
           foreach ($sql->result() as $baris):?>
            <tr>
                <td valign="top"><b><?php echo $no++; ?>.</b> </td>
                <td><img src="<?php echo $baris->foto; ?>" alt="foto" width="50"></td>
                <td valign="top"><?php echo $baris->nama; ?></td>
                <td valign="top"><?php echo $baris->tempat_lahir; ?>, <?php echo date('d-m-Y',strtotime($baris->tgl_lahir)); ?></td>
                <td valign="top"><center><?php echo $baris->jk; ?></center></td>
                <td valign="top"><center><?php echo $baris->pengalaman_kerja; ?></center></td>
                <td valign="top"><center><?php echo $baris->usia; ?></center></td>
                <td valign="top"><center><?php echo $baris->status_pernikahan; ?></center></td>
                <td valign="top"><center><?php echo $baris->agama; ?></td></center>
                <td valign="top"><center><?php echo $baris->alamat; ?></center></td>
                <td valign="top"><center><?php echo $baris->no_hp; ?></center></td>
                <td valign="top"><center><?php echo $baris->email; ?></center></td>
                <td valign="top"><center><?php echo $baris->provinsi; ?></center></td>
                <td valign="top"><center><?php echo $baris->kota; ?></center></td>
                <td valign="top"><center><?php echo $baris->kesehatan; ?></center></td>
                <td valign="top"><center><?php echo $baris->pendidikan_terakhir; ?></center></td>
                <td valign="top"><?php echo $baris->asal_sekolah; ?></td>
                <td valign="top"><center><?php echo $baris->jurusan; ?></center></td>
         
            </tr>
          <?php
          endforeach; ?>
        </tbody>
    </table>
    <br>
    <br>
    <?php $this->load->view('users/laporan/ttd'); ?>

  </body>
</html>

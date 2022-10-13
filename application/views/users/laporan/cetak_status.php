<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title><?php echo $judul_web; ?></title>
    <link rel="icon" type="image/x-icon" href="img/logo.ico"/>
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
                <th>Nama Pegawai</th>
                <?php
                 $this->db->order_by('id_kriteria','ASC');
                $v_kriteria = $this->db->get('tbl_kriteria');
                foreach ($v_kriteria->result() as $key => $value): ?>
                  <th><?php echo $value->nama_kriteria; ?></th>
                <?php
                endforeach; ?>
                <th>Hasil Akhir</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
        <?php

			$data = $sql->result();
			$keys = array_column($data, 'total_nilai');
			array_multisort($keys, SORT_DESC, $data);

			$no = 1;
			foreach ($data as $baris) :
				$this->db->order_by('id_kriteria', 'ASC');
				$data_nilai = $this->db->get_where('tbl_penyeleksian', array('id_karyawan' => $baris->id_karyawan));
				if ($data_nilai->num_rows() != 0) {
			?>
            <tr>
                <td><b><?php echo $no++; ?>.</b> </td>
                <td><?php echo $baris->nama; ?></td>
                <?php foreach ($data_nilai->result() as $key => $value): ?>
                  <td align="center"><?php echo $value->jml_nilai; ?></td>
                <?php endforeach; ?>
                <td align="center">
                    <?php echo $baris->total_nilai; ?>
                </td>
                <td align="center">
                    <?php echo $this->Mcrud->ket_nilai($baris->total_nilai); ?>
                </td>
            </tr>
          <?php
            }
          endforeach; ?>
        </tbody>
    </table>
    <br>
    <br>
    <?php $this->load->view('users/laporan/ttd'); ?>

  </body>
</html>

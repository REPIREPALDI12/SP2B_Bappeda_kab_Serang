<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mcrud extends CI_Model {

	var $tbl_users				 = 'tbl_user';

 public static function tgl_id($date, $bln='')
 {
	 date_default_timezone_set('Asia/Jakarta');
		 $str = explode('-', $date);
		 $bulan = array(
			 '01' => 'Januari',
			 '02' => 'Februari',
			 '03' => 'Maret',
			 '04' => 'April',
			 '05' => 'Mei',
			 '06' => 'Juni',
			 '07' => 'Juli',
			 '08' => 'Agustus',
			 '09' => 'September',
			 '10' => 'Oktober',
			 '11' => 'November',
			 '12' => 'Desember',
		 );
		 if ($bln == '') {
			 $hasil = $str['0'] . "-" . substr($bulan[$str[1]],0,3) . "-" .$str[2];
		 }elseif ($bln == 'full') {
			 $hasil = $str['0'] . " " . $bulan[$str[1]] . " " .$str[2];
		 }else {
			 $hasil = $bulan[$str[1]];
		 }
		 return $hasil;
 }

	public function hari_id($tanggal)
	{
		$day = date('D', strtotime($tanggal));
		$dayList = array(
			'Sun' => 'Minggu',
			'Mon' => 'Senin',
			'Tue' => 'Selasa',
			'Wed' => 'Rabu',
			'Thu' => 'Kamis',
			'Fri' => "Jum'at",
			'Sat' => 'Sabtu'
		);
		return $dayList[$day];
	}

	public function get_users()
	{
			return $this->db->get_where($this->tbl_users, "dihapus='tidak'");
	}

	public function get_id_user($id)
	{
			return $this->db->get_where($this->tbl_users, array('id_user'=>$id,'dihapus'=>'tidak'));
	}

	public function get_level_users()
	{
			// $this->db->where('tbl_user.level', 'user');
			return $this->db->get_where($this->tbl_users, "dihapus='tidak'");
	}

	public function get_users_by_un($id)
	{
				return $this->db->get_where($this->tbl_users, array('username'=>"$id", "dihapus"=>'tidak'));
	}

	public function get_level_users_by_id($id)
	{
			$this->db->from($this->tbl_users);
			$this->db->where('tbl_user.dihapus', 'tidak');
			$this->db->where('tbl_user.level', 'user');
			$this->db->where('tbl_user.id_user', $id);
			$query = $this->db->get();
			return $query->row();
	}

	public function save_user($data)
	{
		$this->db->insert($this->tbl_users, $data);
		return $this->db->insert_id();
	}

	public function update_user($where, $data)
	{
		$this->db->update($this->tbl_users, $data, $where);
		return $this->db->affected_rows();
	}

	public function delete_user_by_id($id)
	{
		$this->db->where('id_user', $id);
		$this->db->delete($this->tbl_users);
	}

	public function waktu($data,$aksi='')
	{
		$tgl_n = date('d-m-Y',strtotime($data));
		$hari = $this->Mcrud->hari_id($tgl_n);
		$tgl  = $this->Mcrud->tgl_id($tgl_n,$aksi);
		return $hari.", ".$tgl;
	}

	function judul_web($id='')
	
	{
		$nama_web = $this->db->get_where('tbl_web',"id_web='1'")->row()->nama_web;
		$ket_web  = $this->db->get_where('tbl_web',"id_web='1'")->row()->ket_web;
		
		if ($id==1) {
			$data = "$nama_web";
		}elseif ($id==2) {
			$data = "$ket_web";
		}else {
			$data = "$nama_web $ket_web";
		}
		return $data;
	}

	function footer()
	{
			return "Copyright &copy; 2022 | Developer by <a href='https://www.instagram.com/repi_repaldi/' target='_blank'>R2.PROJEK.ID</a>";
	}

	public function cek_filename($file='')
	{
		$data = "assets/favicon.png";
		if ($file != '') {
			if(file_exists("$file")){
				$data = $file;
			}
		}
		return $data;
	}

	public function sosmed($aksi='')
	{
		$data = "javascript:;";
		if ($aksi=='fb') {
			$data = "https://facebook.com/";
		}elseif ($aksi=='twit') {
			$data = "https://twitter.com/";
		}elseif ($aksi=='gplus') {
			$data = "https://plus.google.com/";
		}elseif ($aksi=='ig') {
			$data = "https://www.instagram.com/repi_repaldi/";
		}elseif ($aksi=='rss') {
			$data = "https://rss.com/";
		}
		return $data;
	}

	public function kontak($aksi='')
	{
		$data = "";
		if ($aksi=='nama') {
			$data = "Badan Perencanaan Pembangunan Daerah Kabupaten Serang";
		}elseif ($aksi=='alamat') {
			$data = "Jl. Veteran No.I, Kotabaru, Kec. Serang, Kota Serang, Banten 42112, Indonesia";
		}elseif ($aksi=='email') {
			$data = "bappeda@serangkab.go.id";
		}elseif ($aksi=='no_hp') {
			$data = "083874458252";
		}elseif ($aksi=='peta') {
			$data = "https://www.google.com/maps/uv?pb=!1s0x2e418b29f14358fb%3A0xddef5cd6283aef79!3m1!7e115!4s%2Fmaps%2Fplace%2FBAPPEDA%2BKABUPATEN%2BSERANG%2F%40-6.1147859%2C106.1516309%2C3a%2C75y%2C116.18h%2C90t%2Fdata%3D*213m4*211e1*213m2*211sZpHK3mSiAhNU-Pwt59b8lg*212e0*214m2*213m1*211s0x2e418b29f14358fb%3A0xddef5cd6283aef79%3Fsa%3DX!5sBAPPEDA%20KABUPATEN%20SERANG%20-%20Penelusuran%20Google!15sCgIgAQ&imagekey=!1e2!2sZpHK3mSiAhNU-Pwt59b8lg&hl=id&sa=X&ved=2ahUKEwiql7_Fq_L3AhXNPOwKHdZ4Ab4Qpx96BAhIEAg";
		}
		return $data;
	}


	public function sel_option($aksi='',$sel='')
	{
		$menu  = strtolower($this->uri->segment(1));
		$menu2 = strtolower($this->uri->segment(2));
		$menu3 = strtolower($this->uri->segment(3));
		if ($aksi=='gol_darah') {
			$data = array('A','B','AB','O');
			$val  = "Golongan Darah";
		}elseif ($aksi=='agama') {
			$data = array('Islam','Kristen Protestan','Katolik','Hindu','Buddha','Kong Hu Cu');
			$val  = "Agama";
		}elseif ($aksi=='status_pernikahan') {
			$data = array('Menikah','Belum');
			$val  = "Status Pernikahan";
		}elseif ($aksi=='kesehatan') {
			$data = array('SEHAT (tidak buta warna)','TIDAK SEHAT (buta warna)');
			$val  = "Kesehatan";
		}elseif ($aksi=='penampilan') {
			$data = array('Tidak berkacamata dan Tidak bertato','Berkacamata','Bertato');
			$val  = "Penampilan";
		}elseif ($aksi=='field_k') {
			$data = $this->db->list_fields('tbl_karyawan');
			$val  = "Field di Tabel Karyawan";
		}
		?>
		<option value="">- Pilih <?php echo $val; ?> -</option>
		<?php
		if ($aksi=='field_k') {
		 	foreach ($data as $key => $value):
				if ($value!='id_karyawan' AND $value!='foto' AND $value!='total_nilai' AND $value!='status_pengumuman' AND $value!='tgl_karyawan' AND $value!='id_user') {?>
			<option value="<?php echo $value; ?>" <?php if($sel==$value){echo "selected";} ?>><?php echo $value; ?></option>
		<?php
				}
			endforeach;
		}else{
			foreach ($data as $key => $value):?>
			<option value="<?php echo $value; ?>" <?php if($sel==$value){echo "selected";} ?>><?php echo $value; ?></option>
		<?php
				endforeach;
		}

	}

	function persen($data)
	{
		$data = $data*100;
		return $data."%";
	}

	function ket_nilai($data,$aksi='')
	{
		if ($aksi=='status') {
			if ($data=='Lulus') {
				$ket = '<label class="label label-success">LULUS</label>';
			}else {
				$ket = '<label class="label label-danger">TIDAK LULUS</label>';
			}
		}else{
			if ($data >= 75) { //lulus
				if ($aksi=='kirim') {
					$ket = 'x';
				}else {
					$ket = '<label class="label label-success">LULUS</label>';
				}
			}else { //tidak lulus
				if ($aksi=='kirim') {
					$ket = 'xx';
				}else {
					$ket = '<label class="label label-danger">TIDAK LULUS</label>';
				}
			}
		}
		return $ket;
	}

}

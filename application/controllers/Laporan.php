<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {

	public function index()
	{
		$ceks 	 = $this->session->userdata('username');
		$id_user = $this->session->userdata('id_user');
	  $level 	 = $this->session->userdata('level');
		if(!isset($ceks)) {
			redirect('web/login');
		}else{
			$data['user']  			    = $this->db->get_where('tbl_user', "username='$ceks'");
			if ($level=='admin') {
				$nama_lengkap  = $this->db->get_where('tbl_user', "id_user='$id_user'")->row()->nama_lengkap;
			}else {
				$nama_lengkap  = "Masjid";
			}
			$data['judul_web']			= "Laporan";

					$this->load->view('users/header', $data);
					$this->load->view('users/laporan/lap', $data);
					$this->load->view('users/footer');

					if (isset($_POST['cetak_lap'])) {
						$jenis  = htmlentities(strip_tags($this->input->post('jenis')));
						$tgl1 	= date('d-m-Y', strtotime(htmlentities(strip_tags($this->input->post('tgl1')))));
						$tgl2 	= date('d-m-Y', strtotime(htmlentities(strip_tags($this->input->post('tgl2')))));

						redirect("laporan/cetak_lap/$tgl1/$tgl2/$jenis");
					}
		}
	}

	public function cetak_lap($tgl_1='',$tgl_2='',$jenis='')
	{
		$ceks 	 = $this->session->userdata('username');
		$id_user = $this->session->userdata('id_user');
	    $level 	 = $this->session->userdata('level');
			if(!isset($ceks)) {
				redirect('web/login');
			}else{

				$data['user']  		 = $this->db->get_where('tbl_user', "username='$ceks'");

					if ($tgl_1 != '' AND $tgl_2 != '' AND $jenis != '') {
							$tgl1 	= date('Y-m-d', strtotime($tgl_1));
							$tgl2 	= date('Y-m-d', strtotime('+1 days', strtotime($tgl_2)));

							if ($tgl_1==$tgl_2) {
								$data['tgl'] = "TANGGAL ".date('d/ m/ Y',strtotime($tgl_1));
							}else {
								$data['tgl'] = "DARI TANGGAL ".date('d/ m/ Y',strtotime($tgl_1))." SAMPAI DENGAN TANGGAL ".date('d/ m/ Y',strtotime($tgl_2));
							}

							$v_cetak = 'cetak_status';
							if ($jenis=='lulus') {
								$qjenis = "AND status_pengumuman='Lulus'";
								$judul_web = 'LULUS';
							}elseif ($jenis=='tdk_lulus') {
								$qjenis = "AND status_pengumuman='Tidak Lulus'";
								$judul_web = 'TIDAK LULUS';
							}elseif ($jenis=='karyawan') {
								$v_cetak = 'cetak_karyawan';
								$qjenis  = '';
								$judul_web = 'Data Karyawan';
							}else {
								$qjenis = '';
								$judul_web = 'Keseluruhan';
							}
							$sql = $this->db->query("SELECT * FROM tbl_karyawan WHERE (tgl_karyawan BETWEEN '$tgl1' AND '$tgl2') $qjenis ORDER BY nama ASC");
							$data['sql'] 	 = $sql;
							$data['jenis'] = $jenis;
							$data['judul_web'] = "Laporan $judul_web";

							$this->load->view("users/laporan/$v_cetak", $data);

					}else{
							redirect('404_content');
					}

			}
	}

}

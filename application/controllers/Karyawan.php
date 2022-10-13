<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Karyawan extends CI_Controller {

	public function index()
	{
		date_default_timezone_set('Asia/Jakarta');
		$ceks 	 = $this->session->userdata('username');
		$id_user = $this->session->userdata('id_user');
		$level 	 = $this->session->userdata('level');
		if ($level!='user') {
			$tgl1 = date("01-01-Y");
			$tgl2 = date('d-m-Y',strtotime('+0 month',strtotime($tgl1)));
			redirect("karyawan/v/$tgl1/$tgl2");
		}
		$data['user']  		 = $this->Mcrud->get_users_by_un($ceks);
		$data['judul_web'] = "Data Karyawan";

		$this->db->where('id_user', $id_user);
		$data['query'] = $this->db->get("tbl_karyawan")->row();

		$this->load->view('users/header', $data);
		$this->load->view("users/karyawan/edit", $data);
		$this->load->view('users/footer');

		date_default_timezone_set('Asia/Jakarta');
		$tgl = date('Y-m-d H:i:s');

		$lokasi = 'img/karyawan';
		$file_size = 1024 * 3; // 3 MB
		$this->upload->initialize(array(
			"file_type"     => "image/jpeg",
			"upload_path"   => "./$lokasi",
			"allowed_types" => "jpg|jpeg|png",
			"max_size" => "$file_size"
		));

		if (isset($_POST['btnupdate'])) {
			$nama 	 			= htmlentities(strip_tags($this->input->post('nama')));
			$tempat_lahir 		= htmlentities(strip_tags($this->input->post('tempat_lahir')));
			$tgl_lahir 	 		= date('Y-m-d',strtotime(htmlentities(strip_tags($this->input->post('tgl_lahir')))));
			$jk 	 			= htmlentities(strip_tags($this->input->post('jk')));
			$pengalaman_kerja 	= htmlentities(strip_tags($this->input->post('pengalaman_kerja')));
			$usia 	 			= htmlentities(strip_tags($this->input->post('usia')));
			$status_pernikahan 	= htmlentities(strip_tags($this->input->post('status_pernikahan')));
			$agama 	 			= htmlentities(strip_tags($this->input->post('agama')));
			$alamat 	 		= htmlentities(strip_tags($this->input->post('alamat')));
			$no_hp 	 			= htmlentities(strip_tags($this->input->post('no_hp')));
			$email 	 			= htmlentities(strip_tags($this->input->post('email')));
			$provinsi 	 	 	= htmlentities(strip_tags($this->input->post('provinsi')));
			$kota 	 			= htmlentities(strip_tags($this->input->post('kota')));
			$kesehatan 	 		= htmlentities(strip_tags($this->input->post('kesehatan')));
			$interview	 		= htmlentities(strip_tags($this->input->post('interview')));
			$pendidikan_terakhir = htmlentities(strip_tags($this->input->post('pendidikan_terakhir')));
			$asal_sekolah 		= htmlentities(strip_tags($this->input->post('asal_sekolah')));
			$jurusan 	 		= htmlentities(strip_tags($this->input->post('jurusan')));
			$nilai_raport 		= htmlentities(strip_tags($this->input->post('nilai_raport')));
			$nilai_ujian_akhir 	= htmlentities(strip_tags($this->input->post('nilai_ujian_akhir')));

			$simpan = 'y';
			$pesan  = '';

			$cek_foto = $this->db->get_where('tbl_karyawan',"id_user='$id_user'")->row()->foto;
			if ($_FILES['foto']['error'] <> 4) {
				if ( ! $this->upload->do_upload('foto'))
				{
						$simpan = 'n';
						$pesan  = htmlentities(strip_tags($this->upload->display_errors('<p>', '</p>')));
				}
				 else
				{
					if ($cek_foto!='') {
						unlink($cek_foto);
					}
							$gbr = $this->upload->data();
							$filename = "$lokasi/".$gbr['file_name'];
							$foto = preg_replace('/ /', '_', $filename);
							$simpan = 'y';
				}
			}else {
				$foto = $cek_foto;
				$simpan = 'y';
			}
			
			$karyawan = $this->db->get_where('tbl_karyawan',"id_user='$id_user'")->row();
			$cek_dokumen = array(
				$karyawan->pendidikan, $karyawan->ktp, $karyawan->nilai, $karyawan->surat_kesehatan
			);
			$lokasi_dokumen = 'img/karyawan/dokumen';
			$this->upload->initialize(array(
				"file_type"     => "application/pdf",
				"upload_path"   => "./$lokasi_dokumen",
				"allowed_types" => "pdf",
				"max_size" => "$file_size",
				"encrypt_name" =>true,
			));
			$dokumen = [];
			$dokumen_hapus = [];
			
			if ($_FILES['dokumen_pendidikan']['error'] <> 4) {
				if ( ! $this->upload->do_upload('dokumen_pendidikan'))
				{
					$simpan = 'n';
					$pesan  = htmlentities(strip_tags($this->upload->display_errors('<p>', '</p>')));
				}
				else
				{
					$gbr = $this->upload->data();
					$filename = "$lokasi_dokumen/".$gbr['file_name'];
					$dokumen_pendidikan = preg_replace('/ /', '_', $filename);
					array_push($dokumen, $dokumen_pendidikan);
					array_push($dokumen_hapus, $karyawan->pendidikan);
					$simpan = 'y';
				}
			}else {
				$dokumen_pendidikan = $karyawan->pendidikan;
				$simpan = 'y';
			}

			if ($_FILES['dokumen_nilai']['error'] <> 4) {
				if ( ! $this->upload->do_upload('dokumen_nilai'))
				{
					$simpan = 'n';
					$pesan  = htmlentities(strip_tags($this->upload->display_errors('<p>', '</p>')));
				}
				else
				{
					$gbr = $this->upload->data();
					$filename = "$lokasi_dokumen/".$gbr['file_name'];
					$dokumen_nilai = preg_replace('/ /', '_', $filename);
					array_push($dokumen, $dokumen_nilai);
					array_push($dokumen_hapus, $karyawan->nilai);
					$simpan = 'y';
				}
			}else {
				$dokumen_nilai = $karyawan->nilai;
				$simpan = 'y';
			}

			if ($_FILES['dokumen_ktp']['error'] <> 4) {
				if ( ! $this->upload->do_upload('dokumen_ktp'))
				{
					$simpan = 'n';
					$pesan  = htmlentities(strip_tags($this->upload->display_errors('<p>', '</p>')));
				}
				else
				{
					$gbr = $this->upload->data();
					$filename = "$lokasi_dokumen/".$gbr['file_name'];
					$dokumen_ktp = preg_replace('/ /', '_', $filename);
					array_push($dokumen, $dokumen_ktp);
					array_push($dokumen_hapus, $karyawan->ktp);
					$simpan = 'y';
				}
			}else {
				$dokumen_ktp = $karyawan->ktp;
				$simpan = 'y';
			}

			if ($_FILES['dokumen_surat_kesehatan']['error'] <> 4) {
				if ( ! $this->upload->do_upload('dokumen_surat_kesehatan'))
				{
					$simpan = 'n';
					$pesan  = htmlentities(strip_tags($this->upload->display_errors('<p>', '</p>')));
				}
				else
				{
					$gbr = $this->upload->data();
					$filename = "$lokasi_dokumen/".$gbr['file_name'];
					$dokumen_surat_kesehatan = preg_replace('/ /', '_', $filename);
					array_push($dokumen, $dokumen_surat_kesehatan);
					array_push($dokumen_hapus, $karyawan->surat_kesehatan);
					$simpan = 'y';
				}
			}else {
				$dokumen_surat_kesehatan = $karyawan->surat_kesehatan;
				$simpan = 'y';
			}




			if ($simpan=='y') {
							$data = array(
								'nama_lengkap' => $nama
							);
							$this->db->update('tbl_user',$data, array('id_user' => $id_user));

							$data2 = array(
								'nama' 					 => $nama,
								'foto' 					 => $foto,
								'tempat_lahir' 			 => $tempat_lahir,
								'tgl_lahir' 	 		 => $tgl_lahir,
								'jk' 					 => $jk,
								'pengalaman_kerja' 		  => $pengalaman_kerja,
								'usia' 				 	 => $usia,
								'status_pernikahan'      => $status_pernikahan,
								'agama' 				 => $agama,
								'alamat'				 => $alamat,
								'no_hp' 			 	 => $no_hp,
								'kota' 				 	 => $kota,
								'email' 				 => $email,
								'provinsi' 	 	 		 => $provinsi,
								'kesehatan' 		 	 => $kesehatan,
								'interview' 	 		 => $interview,
								'pendidikan_terakhir' 	 => $pendidikan_terakhir,
								'asal_sekolah' 			 => $asal_sekolah,
								'jurusan' 		 		 => $jurusan,
								'nilai_raport' 			 => $nilai_raport,
								'nilai_ujian_akhir' 	 => $nilai_ujian_akhir,
								'pendidikan'			 => $dokumen_pendidikan,
								'nilai' 				 => $dokumen_nilai,
								'ktp' 					 => $dokumen_ktp,
								'surat_kesehatan'		 => $dokumen_surat_kesehatan,
							);
							$this->db->update('tbl_karyawan',$data2, array('id_user' => $id_user));
							foreach($dokumen_hapus as $v){
								if($v){
									unlink($v);
								}
							}

							$this->session->set_flashdata('msg',
								'
								<div class="alert alert-success alert-dismissible" role="alert">
									 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
										 <span aria-hidden="true">&times;</span>
									 </button>
									 <strong>Sukses!</strong> Berhasil disimpan.
								</div>
							 <br>'
							);
			 }else {
				foreach($dokumen as $v){
					unlink($v);
				}
					 $this->session->set_flashdata('msg',
						'
						<div class="alert alert-warning alert-dismissible" role="alert">
							 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
								 <span aria-hidden="true">&times;</span>
							 </button>
							 <strong>Gagal!</strong> '.$pesan.'.
						</div>
					 <br>'
					);
			 }
			 redirect("karyawan/detail");

		}

	}

	public function detail()
	{
		$ceks 	 = $this->session->userdata('username');
		$id_user = $this->session->userdata('id_user');
		$level 	 = $this->session->userdata('level');
		if(!isset($ceks)) {
			redirect('web/login');
		}
			$data['user']  			  = $this->Mcrud->get_users_by_un($ceks);
			if ($level!='user') {
				redirect('404');
			}

			$data['judul_web'] 	  = "Detail Karyawan";
			$this->db->join('tbl_karyawan','tbl_karyawan.id_user=tbl_user.id_user');
			$this->db->where('level', 'user');
			$data['query'] = $this->db->get_where("tbl_user", array('tbl_user.id_user' => "$id_user"))->row();
			if ($data['query']->id_user=='') {redirect('404');}
			if ($data['query']->tempat_lahir=='') {
				redirect('karyawan');
			}
			$this->load->view('users/header', $data);
			$this->load->view("users/karyawan/detail", $data);
			$this->load->view('users/footer');
	}

	public function v($tgl1='',$tgl2='',$aksi='',$id='')
	{
		if ($tgl1=='' or $tgl2=='') {redirect('404');}
		$id = hashids_decrypt($id);
		$ceks 	 = $this->session->userdata('username');
		$id_user = $this->session->userdata('id_user');
		$level 	 = $this->session->userdata('level');
		if(!isset($ceks)) {
			redirect('web/login');
		}

			$data['user']  	= $this->Mcrud->get_users_by_un($ceks);

			if ($level=='user') {
				redirect('404');
			}

			$tgl_1 = date('Y-m-d H:i:s',strtotime($tgl1));
			$tgl_2 = date('Y-m-d H:i:s',strtotime($tgl2));
			$this->db->where('tgl_karyawan >=',$tgl_1);
			$this->db->where('tgl_karyawan <=',$tgl_2);
			$this->db->order_by('id_karyawan', 'DESC');
			$data['query'] = $this->db->get("tbl_karyawan");
			$data['tgl1']	= $tgl1;
			$data['tgl2']	= $tgl2;

			if ($aksi == 'd') {
				$p = "detail";
				$data['judul_web'] 	  = "Detail Karyawan";
				$this->db->join('tbl_karyawan','tbl_karyawan.id_user=tbl_user.id_user');
				$this->db->where('level', 'user');
				$data['query'] = $this->db->get_where("tbl_user", array('tbl_user.id_user' => "$id"))->row();
				if ($data['query']->id_user=='') {redirect('404');}
			}elseif ($aksi == 'excel') {
				$p = "export";
				$data['judul_web'] 	  = "Data Karyawan $tgl1 - $tgl2";
				// if ($data['query']->num_rows()==0) {redirect('404');}
			}
			elseif ($aksi == 'h') {
				$this->db->where('level', 'user');
				$cek_data = $this->db->get_where("tbl_user", array('id_user' => "$id"));
				if ($cek_data->num_rows() != 0) {
						$cek_data2 = $this->db->get_where("tbl_karyawan", array('id_user' => "$id"));
						if ($cek_data2->row()->foto != '') {
							unlink($cek_data->row()->foto);
						}
						$this->db->delete('tbl_karyawan', array('id_user' => $id));
						$this->db->delete('tbl_user', array('id_user' => $id));
						$this->session->set_flashdata('msg',
							'
							<div class="alert alert-success alert-dismissible" role="alert">
								 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
									 <span aria-hidden="true">&times;</span>
								 </button>
								 <strong>Sukses!</strong> Berhasil dihapus.
							</div>
							<br>'
						);
						redirect("karyawan/v");
				}else {
					redirect('404_content');
				}
			}else{
				$p = "index";
				$data['judul_web'] 	  = "Karyawan";
			}

			if ($aksi=='excel') {
				$this->load->view("users/karyawan/$p", $data);
			}else {
				$this->load->view('users/header', $data);
				$this->load->view("users/karyawan/$p", $data);
				$this->load->view('users/footer');
			}

				date_default_timezone_set('Asia/Jakarta');
				$tgl = date('Y-m-d H:i:s');

	}

	public function cetak_kartu($id='')
	{
		$id = hashids_decrypt($id);
		$ceks 	 = $this->session->userdata('username');
		$id_user = $this->session->userdata('id_user');
		$level 	 = $this->session->userdata('level');
		if(!isset($ceks)) {
			redirect('web/login');
		}
		$this->db->order_by('id_karyawan', 'DESC');
		$data['query'] = $this->db->get_where("tbl_karyawan", array('id_karyawan'=>$id))->row();
		$data['judul_web'] = "Cetak Kartu Karyawan";
		$this->load->view("users/karyawan/cetak_kartu", $data);
	}

}

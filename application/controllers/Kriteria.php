<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kriteria extends CI_Controller {

	public function index()
	{
		redirect('kriteria/v');
	}

	public function v($aksi='',$id='')
	{
		$id = hashids_decrypt($id);
		$ceks 	 = $this->session->userdata('username');
		$id_user = $this->session->userdata('id_user');
		$level 	 = $this->session->userdata('level');
		if(!isset($ceks)) {
			redirect('web/login');
		}

			$data['user']  			  = $this->Mcrud->get_users_by_un($ceks);

			if ($level=='user') {
				redirect('404');
			}

			$this->db->order_by('id_kriteria', 'ASC');
			$data['query'] = $this->db->get("tbl_kriteria");

			$this->db->select_sum('bobot');
			$data['c_bobot'] = $this->db->get("tbl_kriteria")->row()->bobot;

			if ($aksi == 't') {
				$p = "tambah";
				$data['judul_web'] 	  = "+ Kriteria";
			}elseif ($aksi == 'e') {
				$p = "edit";
				$data['judul_web'] 	  = "Edit Kriteria";
				$data['query'] = $this->db->get_where("tbl_kriteria", array('id_kriteria' => "$id"))->row();
				if ($data['query']->id_kriteria=='') {redirect('404');}
			}
			elseif ($aksi == 'h') {
				$cek_data = $this->db->get_where("tbl_kriteria", array('id_kriteria' => "$id"));
				if ($cek_data->num_rows() != 0) {
						$this->db->delete('tbl_sub_kriteria', array('id_kriteria' => $id));
						$this->db->delete('tbl_penyeleksian', array('id_kriteria' => $id));
						$this->db->delete('tbl_hasil', array('id_kriteria' => $id));
						$this->db->delete('tbl_kriteria', array('id_kriteria' => $id));
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
						redirect("kriteria/v");
				}else {
					redirect('404_content');
				}
			}else{
				$p = "index";
				$data['judul_web'] 	  = "Kriteria";
			}

				$this->load->view('users/header', $data);
				$this->load->view("users/kriteria/$p", $data);
				$this->load->view('users/footer');

				date_default_timezone_set('Asia/Jakarta');
				$tgl = date('Y-m-d H:i:s');

				if (isset($_POST['btnsimpan'])) {
					$nama_kriteria = htmlentities(strip_tags($this->input->post('nama_kriteria')));
					$field  			 = htmlentities(strip_tags($this->input->post('field')));
					$bobot  			 = htmlentities(strip_tags($this->input->post('bobot')));

					$simpan = 'y';
					$pesan  = '';
					if ($bobot > 1) {
						$simpan = 'n';
						$pesan  = "Bobot tidak boleh lebih dari 1";
					}else {
						$cek_bobot = $data['c_bobot'] + $bobot;
						if ($cek_bobot > 1) {
							$simpan = 'n';
							$pesan  = "TOTAL BOBOT tidak boleh lebih dari 1";
						}
					}

					if ($simpan=='y') {
									$data = array(
										'nama_kriteria' => $nama_kriteria,
										'field' 		=> $field,
										'bobot'  		=> $bobot,
										'tgl_kriteria'  => $tgl
									);
									$this->db->insert('tbl_kriteria',$data);

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
	 					 redirect("kriteria/v/t");
					 }
					 redirect("kriteria/v");
				}

				if (isset($_POST['btnupdate'])) {
					$nama_kriteria = htmlentities(strip_tags($this->input->post('nama_kriteria')));
					$field  			 = htmlentities(strip_tags($this->input->post('field')));
					$bobot  			 = htmlentities(strip_tags($this->input->post('bobot')));

					$simpan = 'y';
					$pesan  = '';
					if ($bobot > 1) {
						$simpan = 'n';
						$pesan  = "Bobot tidak boleh lebih dari 1";
					}else {
						$cek_bobot = ($data['c_bobot'] - $data['query']->bobot) + $bobot;
						if ($cek_bobot > 1) {
							$simpan = 'n';
							$pesan  = "TOTAL BOBOT tidak boleh lebih dari 1";
						}
					}

					if ($simpan=='y') {
									$data = array(
										'nama_kriteria' => $nama_kriteria,
										'field' 				=> $field,
										'bobot'  			  => $bobot
									);
									$this->db->update('tbl_kriteria',$data, array('id_kriteria' => $id));

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
									redirect("kriteria/v");
					 }else {
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
							redirect("kriteria/v/e/".hashids_encrypt($id));
					 }

				}

	}


	public function sub($aksi='',$id='')
	{
		$id = hashids_decrypt($id);
		$ceks 	 = $this->session->userdata('username');
		$id_user = $this->session->userdata('id_user');
		$level 	 = $this->session->userdata('level');
		if(!isset($ceks)) {
			redirect('web/login');
		}

			$data['user']  			  = $this->Mcrud->get_users_by_un($ceks);

			if ($level=='user') {
				redirect('404');
			}

			$this->db->join('tbl_kriteria','tbl_kriteria.id_kriteria=tbl_sub_kriteria.id_kriteria');
			$this->db->order_by('id_sub_kriteria', 'ASC');
			$data['query'] = $this->db->get("tbl_sub_kriteria");

			$this->db->order_by('id_kriteria', 'ASC');
			$data['v_kriteria'] = $this->db->get("tbl_kriteria");

			if ($aksi == 't') {
				$p = "tambah";
				$data['judul_web'] 	  = "+ Sub Kriteria";
			}elseif ($aksi == 'e') {
				$p = "edit";
				$data['judul_web'] 	  = "Edit Sub Kriteria";
				$data['sql'] = $this->db->get_where("tbl_sub_kriteria", array('id_sub_kriteria' => "$id"))->row();
				if ($data['sql']->id_sub_kriteria=='') {redirect('404');}
			}
			elseif ($aksi == 'h') {
				$cek_data = $this->db->get_where("tbl_sub_kriteria", array('id_sub_kriteria' => "$id"));
				if ($cek_data->num_rows() != 0) {
						$this->db->delete('tbl_sub_kriteria', array('id_sub_kriteria' => $id));
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
						redirect("kriteria/sub");
				}else {
					redirect('404_content');
				}
			}else{
				$p = "index";
				$data['judul_web'] 	  = "Sub Kriteria";
			}

				$this->load->view('users/header', $data);
				$this->load->view("users/kriteria/sub/$p", $data);
				$this->load->view('users/footer');

				date_default_timezone_set('Asia/Jakarta');
				$tgl = date('Y-m-d H:i:s');

				if (isset($_POST['btnsimpan'])) {
					$id_kriteria = htmlentities(strip_tags($this->input->post('id_kriteria')));
					$ket  			 = $this->input->post('ket');

					$simpan = 'y';
					$pesan  = '';
					$cek_data = $this->db->get_where('tbl_sub_kriteria', array('id_kriteria'=>$id_kriteria));
					if ($cek_data->num_rows() != 0) {
						$simpan = 'n';
						$pesan  = "Kriteria yang dipilih sudah terdaftar";
					}

					if ($simpan=='y') {
									$data = array(
										'id_kriteria' 	   => $id_kriteria,
										'ket_sub_kriteria' => $ket,
										'tgl_sub_kriteria' => $tgl
									);
									$this->db->insert('tbl_sub_kriteria',$data);

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
	 					 redirect("kriteria/sub/t");
					 }
					 redirect("kriteria/sub");
				}

				if (isset($_POST['btnupdate'])) {
					$id_kriteria = htmlentities(strip_tags($this->input->post('id_kriteria')));
					$ket  			 = $this->input->post('ket');

					$simpan = 'y';
					$pesan  = '';
					$data_lama = $this->db->get_where('tbl_sub_kriteria', array('id_kriteria'=>$id_kriteria))->row();
					$cek_data = $this->db->get_where('tbl_sub_kriteria', array('id_kriteria'=>$id_kriteria,'id_kriteria!='=>$data_lama->id_kriteria));
					if ($cek_data->num_rows() != 0) {
						$simpan = 'n';
						$pesan  = "Kriteria yang dipilih sudah terdaftar";
					}

					if ($simpan=='y') {
									$data = array(
										// 'id_kriteria' 		 => $id_kriteria,
										'ket_sub_kriteria' => $ket
									);
									$this->db->update('tbl_sub_kriteria',$data, array('id_sub_kriteria' => $id));

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
									redirect("kriteria/sub");
					 }else {
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
							redirect("kriteria/sub/e/".hashids_encrypt($id));
					 }

				}

	}

}

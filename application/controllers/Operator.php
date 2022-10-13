<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Operator extends CI_Controller {

	public function index()
	{
		redirect('operator/v');
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

			if ($level!='superadmin') {
				redirect('404');
			}

			$this->db->where('level', 'admin');
			$this->db->order_by('id_user', 'DESC');
			$data['query'] = $this->db->get("tbl_user");

			if ($aksi == 't') {
				$p = "tambah";
				$data['judul_web'] 	  = "+ Operator";
			}elseif ($aksi == 'e') {
				$p = "edit";
				$data['judul_web'] 	  = "Edit Operator";
				$this->db->where('level', 'admin');
				$data['query'] = $this->db->get_where("tbl_user", array('id_user' => "$id"))->row();
				if ($data['query']->id_user=='') {redirect('404');}
			}
			elseif ($aksi == 'h') {
				$this->db->where('level', 'admin');
				$cek_data = $this->db->get_where("tbl_user", array('id_user' => "$id"));
				if ($cek_data->num_rows() != 0) {
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
						redirect("operator/v");
				}else {
					redirect('404_content');
				}
			}else{
				$p = "index";
				$data['judul_web'] 	  = "Operator";
			}

				$this->load->view('users/header', $data);
				$this->load->view("users/operator/$p", $data);
				$this->load->view('users/footer');

				date_default_timezone_set('Asia/Jakarta');
				$tgl = date('Y-m-d H:i:s');

				if (isset($_POST['btnsimpan'])) {
					$nama_lengkap = htmlentities(strip_tags($this->input->post('nama_lengkap')));
					$username  		= htmlentities(strip_tags($this->input->post('username')));
					$password 		= htmlentities(strip_tags($this->input->post('password')));
					$password2 		= htmlentities(strip_tags($this->input->post('password2')));

					$cek_data = $this->db->get_where('tbl_user', array('username'=>$username));
					$simpan = 'y';
					$pesan  = '';
					if ($cek_data->num_rows()!=0) {
						$simpan = 't';
						$pesan  = "Username <b>$username</b> sudah ada";
					}else {
						if ($password!=$password2) {
							$simpan = 't';
							$pesan  = "Password tidak cocok";
						}
					}

					if ($simpan=='y') {
									$data = array(
										'nama_lengkap' => $nama_lengkap,
										'username'  	 => $username,
										'password'  	 => $password,
										'level' 			 => 'admin',
										'tgl_daftar' 	 => $tgl,
										'dihapus'			 => 'tidak'
									);
									$this->db->insert('tbl_user',$data);

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
	 					 redirect("operator/v/t");
					 }
					 redirect("operator/v");
				}

				if (isset($_POST['btnupdate'])) {
					$nama_lengkap = htmlentities(strip_tags($this->input->post('nama_lengkap')));
					$username  		= htmlentities(strip_tags($this->input->post('username')));
					$password 		= htmlentities(strip_tags($this->input->post('password')));
					$password2 		= htmlentities(strip_tags($this->input->post('password2')));

					$data_lama = $this->db->get_where('tbl_user', array('id_user'=>$id))->row();
					$cek_data = $this->db->get_where('tbl_user', array('username'=>$username,'username!='=>$data_lama->username));
					$simpan = 'y';
					$pesan  = '';
					if ($cek_data->num_rows()!=0) {
						$simpan = 't';
						$pesan  = "Username <b>$username</b> sudah ada";
					}else {
						if ($password=='') {
							$password = $data_lama->password;
						}else{
							if ($password!=$password2) {
								$simpan = 't';
								$pesan  = "Password tidak cocok";
							}
						}
					}

					if ($simpan=='y') {
									$data = array(
										'nama_lengkap' => $nama_lengkap,
										'username'  	 => $username,
										'password'  	 => $password,
										'level' 			 => 'admin'
									);
									$this->db->update('tbl_user',$data, array('id_user' => $id));

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
									redirect("operator/v");
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
							redirect("operator/v/e/".hashids_encrypt($id));
					 }

				}

	}


}

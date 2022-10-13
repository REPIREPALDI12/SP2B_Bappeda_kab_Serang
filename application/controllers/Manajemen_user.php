<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manajemen_user extends CI_Controller {

	public function index()
	{
		redirect('manajemen_user/v');
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

			$this->db->where('level', 'user');
			$this->db->order_by('id_user', 'DESC');
			$data['query'] = $this->db->get("tbl_user");

			if ($aksi == 'e') {
				$p = "edit";
				$data['judul_web'] 	  = "Edit Manajemen User";
				$this->db->where('level', 'user');
				$data['query'] = $this->db->get_where("tbl_user", array('id_user' => "$id"))->row();
				if ($data['query']->id_user=='') {redirect('404');}
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
						redirect("manajemen_user/v");
				}else {
					redirect('404_content');
				}
			}else{
				$p = "index";
				$data['judul_web'] 	  = "Manajemen User";
			}

				$this->load->view('users/header', $data);
				$this->load->view("users/manajemen_user/$p", $data);
				$this->load->view('users/footer');

				date_default_timezone_set('Asia/Jakarta');
				$tgl = date('Y-m-d H:i:s');

				if (isset($_POST['btnupdate'])) {
					$nama 	 = htmlentities(strip_tags($this->input->post('nama')));
					$username  = htmlentities(strip_tags($this->input->post('username')));
					$password  = htmlentities(strip_tags($this->input->post('password')));
					$password2 = htmlentities(strip_tags($this->input->post('password2')));

					$simpan = 'y';
					$pesan  = '';
					$data_lama = $this->db->get_where('tbl_user', array('id_user'=>$id))->row();
					$cek_data  = $this->db->get_where('tbl_user', array('username'=>$username,'username!='=>$data_lama->username));
					if ($cek_data->num_rows()!=0) {
						$simpan = 'n';
						$pesan  = "Username '<b>$username</b>' sudah ada";
					}else {
							if ($password!=$password2) {
								$simpan = 'n';
								$pesan  = "Password tidak cocok";
							}else {
								if ($password=='') {
									$password = $data_lama->password;
								}
							}
					}

					if ($simpan=='y') {
									$data = array(
										'nama_lengkap' => $nama,
										'username' => $username,
										'password' => $password
									);
									$this->db->update('tbl_user',$data, array('id_user' => $id));

									$data2 = array(
										'nama' => $nama
									);
									$this->db->update('tbl_karyawan',$data2, array('id_user' => $id));

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
									redirect("manajemen_user/v");
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
							redirect("manajemen_user/v/e/".hashids_encrypt($id));
					 }

				}

	}


}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

	public function index()
	{
		$ceks = $this->session->userdata('username');
		$id_user = $this->session->userdata('id_user');
		if(!isset($ceks)) {
			redirect('web/login');
		}else{
			$data['user']   	 = $this->Mcrud->get_users_by_un($ceks);
			$data['users']  	 = $this->Mcrud->get_users();
			$data['judul_web'] = "Dashboard";

			$this->load->view('users/header', $data);
			$this->load->view('users/dashboard', $data);
			$this->load->view('users/footer');
		}
	}

	public function profile()
	{
		$ceks = $this->session->userdata('username');
		$id_user = $this->session->userdata('id_user');
		$level = $this->session->userdata('level');
		if(!isset($ceks)) {
			redirect('web/login');
		}else{
			$data['user']  			  = $this->Mcrud->get_users_by_un($ceks);
			$data['level_users']  = $this->Mcrud->get_level_users();
			$data['judul_web'] 		= "Akun Profile";

					$this->load->view('users/header', $data);
					$this->load->view('users/akun', $data);
					$this->load->view('users/footer');

					if (isset($_POST['btnupdate'])) {
						$username	 		= htmlentities(strip_tags($this->input->post('username')));
						$nama_lengkap	= htmlentities(strip_tags($this->input->post('nama_lengkap')));

						$pesan = '';
						if ($ceks == $username) {
							$update = 'yes';
						}else{
							$cek_un = $this->Mcrud->get_users_by_un($username)->num_rows();
							if ($cek_un == 0) {
									$update = 'yes';
							}else{
									$update = 'no';
									$pesan  = 'Username "<b>'.$username.'</b>" sudah ada';
							}
						}

						if ($update == 'yes') {
									$data = array(
										'username'			=> $username,
										'nama_lengkap'	=> $nama_lengkap
									);
									$this->Mcrud->update_user(array('username' => $ceks), $data);

									if ($level=='user') {
										$data2 = array(
											'nama' => $nama_lengkap
										);
										$this->db->update('tbl_karyawan', $data2, array('id_user'=>$id_user));
									}

									$this->session->has_userdata('username');
									$this->session->set_userdata('username', "$username");

									$this->session->set_flashdata('msg',
										'
										<div class="alert alert-success alert-dismissible" role="alert">
											 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
												 <span aria-hidden="true">&times;</span>
											 </button>
											 <strong>Sukses!</strong> Profile berhasil disimpan.
										</div>
	 								 <br>'
									);
									redirect('users/profile');
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
							redirect('users/profile');
						}
					}
		}
	}

	public function ubah_pass()
	{
		$ceks = $this->session->userdata('username');
		if(!isset($ceks)) {
			redirect('web/login');
		}else{
			$data['user']  			  = $this->Mcrud->get_users_by_un($ceks);
			$data['level_users']  = $this->Mcrud->get_level_users();
			$data['judul_web'] 		= "Ubah Password";

					$this->load->view('users/header', $data);
					$this->load->view('users/ubah_pass', $data);
					$this->load->view('users/footer');

					if (isset($_POST['btnupdate2'])) {
						$password0 	= htmlentities(strip_tags($this->input->post('password0')));
						$password 	= htmlentities(strip_tags($this->input->post('password')));
						$password2 	= htmlentities(strip_tags($this->input->post('password2')));

						if ($password0 != $data['user']->row()->password) {
								$this->session->set_flashdata('msg2',
									'
									<div class="alert alert-warning alert-dismissible" role="alert">
										 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
											 <span aria-hidden="true">&times;</span>
										 </button>
										 <strong>Gagal!</strong> Password lama salah.
									</div>
 								 <br>'
								);
								redirect('users/ubah_pass');
						}

						if ($password != $password2) {
								$this->session->set_flashdata('msg2',
									'
									<div class="alert alert-warning alert-dismissible" role="alert">
										 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
											 <span aria-hidden="true">&times;</span>
										 </button>
										 <strong>Gagal!</strong> Password tidak cocok.
									</div>
 								 <br>'
								);
						}else{
									$data = array(
										'password'	=> $password
									);
									$this->Mcrud->update_user(array('username' => $ceks), $data);

									$this->session->set_flashdata('msg2',
										'
										<div class="alert alert-success alert-dismissible" role="alert">
											 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
												 <span aria-hidden="true">&times;</span>
											 </button>
											 <strong>Sukses!</strong> Password berhasil disimpan.
										</div>
	 								 <br>'
									);
						}
									redirect('users/ubah_pass');
					}
		}
	}

}

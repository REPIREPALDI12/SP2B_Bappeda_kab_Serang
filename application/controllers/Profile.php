<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

	public function index()
	{
		$level 	 = $this->session->userdata('level');
		if ($level=='user') {
			redirect('profile/vm');
		}else {
			redirect('profile/v');
		}
	}

	public function vm()
	{
		$ceks 	 = $this->session->userdata('username');
		$id_user = $this->session->userdata('id_user');
		$level 	 = $this->session->userdata('level');
		if(!isset($ceks)) {
			redirect('web/login');
		}
		$data['user']  			  = $this->Mcrud->get_users_by_un($ceks);

										 $this->db->order_by('id_profile', 'DESC');
		$data['query'] = $this->db->get_where("tbl_profile", array('judul'=>'Visi &amp; Misi'))->row();
		$data['judul_web'] 	  = $data['query']->judul;

		$this->load->view('users/header', $data);
		$this->load->view("users/profile/vm", $data);
		$this->load->view('users/footer');
	}

	public function v($aksi='', $id='')
	{
		$id = hashids_decrypt($id);
		$ceks 	 = $this->session->userdata('username');
		$id_user = $this->session->userdata('id_user');
		$level 	 = $this->session->userdata('level');
		if(!isset($ceks)) {
			redirect('web/login');
		}else{
			$data['user']  			  = $this->Mcrud->get_users_by_un($ceks);

			if ($level=='user') {
				redirect('404');
			}

			$this->db->order_by('id_profile', 'DESC');
			$data['query'] = $this->db->get("tbl_profile");

				if ($aksi == 't') {
					$p = "tambah";
					$data['judul_web'] 	  = "+ Profile";
				}elseif ($aksi == 'e') {
					$p = "edit";
					$data['judul_web'] 	  = "Edit Profile";
					$data['query'] = $this->db->get_where("tbl_profile", array('id_profile' => "$id"))->row();
					if ($data['query']->id_profile=='') {redirect('404');}
				}
				elseif ($aksi == 'h') {
					$cek_data = $this->db->get_where("tbl_profile", array('id_profile' => "$id"));
					if ($cek_data->num_rows() != 0) {
							$this->db->delete('tbl_profile', array('id_profile' => $id));
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
							redirect("profile/v");
					}else {
						redirect('404_content');
					}
				}else{
					$p = "index";
					$data['judul_web'] 	  = "Profile";
				}

					$this->load->view('users/header', $data);
					$this->load->view("users/profile/$p", $data);
					$this->load->view('users/footer');

					date_default_timezone_set('Asia/Jakarta');
					$tgl = date('Y-m-d H:i:s');

					if (isset($_POST['btnsimpan'])) {
						$judul = htmlentities(strip_tags($this->input->post('judul')));
						$ket 	 = $this->input->post('ket');

										$data = array(
											'judul' 			=> $judul,
											'ket' 	  		=> $ket,
											'tgl_profile' => $tgl,
										);
										$this->db->insert('tbl_profile',$data);

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

						 redirect("profile/v/t");
					}


					if (isset($_POST['btnupdate'])) {
						$judul = htmlentities(strip_tags($this->input->post('judul')));
						$ket 	 = $this->input->post('ket');

										$data = array(
											'judul' 			=> $judul,
											'ket' 	  		=> $ket,
											'tgl_profile' => $tgl,
										);
										$this->db->update('tbl_profile',$data, array('id_profile' => $id));

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

						 redirect("profile/v");
					}
		}
	}


}

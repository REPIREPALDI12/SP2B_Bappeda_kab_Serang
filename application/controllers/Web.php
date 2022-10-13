<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Web extends CI_Controller
{

	public function index()
	{
		$data['judul_web'] = $this->Mcrud->judul_web();
		$this->load->view('web/header', $data);
		$this->load->view('web/beranda', $data);
		$this->load->view('web/footer', $data);
	}

	public function visi_misi()
	{
		$data['judul_web'] = "Visi & Misi";
		$this->db->order_by('id_profile', 'DESC');
		$data['query'] = $this->db->get_where("tbl_profile", array('judul' => 'Visi &amp; Misi'))->row();
		$this->load->view('web/header', $data);
		$this->load->view('web/profile', $data);
		$this->load->view('web/footer', $data);
	}

	public function Tugas()
	{
		$data['judul_web'] = "Tugas & Fungsi";
		$this->db->order_by('id_profile', 'DESC');
		$data['query'] = $this->db->get_where("tbl_profile", array('judul' => 'Tugas'))->row();
		$this->load->view('web/header', $data);
		$this->load->view('web/profile', $data);
		$this->load->view('web/footer', $data);
	}

	public function info_lowker()
	{
		$data['judul_web'] = "Info Lowongan Kerja - " . $this->Mcrud->judul_web();
		$this->db->order_by('id_info_lowker', 'DESC');
		$data['query'] = $this->db->get("tbl_info_lowker");

		$this->load->view('web/header', $data);
		$this->load->view('web/info_lowker', $data);
		$this->load->view('web/footer', $data);
	}

	public function daftar()
	{
		$ceks = $this->session->userdata('username');
		if (isset($ceks)) {
			redirect('dashboard');
		}
		$data['judul_web'] = "Halaman Pendaftaran : " . $this->Mcrud->judul_web();
		$query  = $this->db->get('tbl_info_lowker');
		// $jumlah = $query->num_rows();
		// $data['lowoongan'] = $this->Mcrud->


		if ($query->num_rows() == 0) {
			$data['error'] = true;
			$data['lowongan'] = [];
		} else {
			$data['error'] = false;
			$data['lowongan'] = $query->result_array();
		}
		// echo json_encode($query->num_rows());
		// die;
		$this->load->view('web/log/header', $data);
		$this->load->view('web/log/daftar', $data);
		$this->load->view('web/log/footer', $data);

		if (isset($_POST['btndaftar'])) {
			$nama 		 = htmlentities(strip_tags($_POST['nama']));
			$username = htmlentities(strip_tags($_POST['username']));
			$pass	   = htmlentities(strip_tags($_POST['password']));
			$pass2	   = htmlentities(strip_tags($_POST['password2']));
			$lowongan	   = htmlentities(strip_tags($_POST['lowongan']));

			$query  = $this->db->get_where('tbl_user', array('username' => $username));
			$jumlah = $query->num_rows();
			$simpan = 'y';
			$pesan  = '';
			if ($jumlah != 0) {
				$simpan = 'n';
				$pesan  = "Username '<b>$username</b>' sudah ada";
			} else {
				if ($pass != $pass2) {
					$simpan = 'n';
					$pesan  = "Password tidak cocok";
				}
			}

			date_default_timezone_set('Asia/Jakarta');
			$tgl = date('Y-m-d H:i:s');
			if ($simpan == 'y') {
				$level = 'user';
				$data = array(
					'nama_lengkap' => $nama,
					'username' 	 => $username,
					'password' 	 => $pass,
					'level'		 	 => $level,
					'tgl_daftar' => $tgl,
					'lamaran'	 => $lowongan,
					'dihapus'	 	 => 'tidak'
				);
				$this->db->insert('tbl_user', $data);
				$id_user = $this->db->insert_id();
				$data2 = array(
					'nama' 		=> $nama,
					'id_user' => $id_user,
					'lamaran'	=> $lowongan,
					'tgl_karyawan' => $tgl
				);
				$this->db->insert('tbl_karyawan', $data2);

				$this->session->set_userdata('username', "$username");
				$this->session->set_userdata('id_user', $id_user);
				$this->session->set_userdata('level', "$level");
				redirect('dashboard');
			} else {
				$this->session->set_flashdata(
					'msg',
					'
	 								<div class="alert alert-warning alert-dismissible" role="alert">
	 									 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	 										 <span aria-hidden="true">&times;</span>
	 									 </button>
	 									 <strong>Gagal!</strong> ' . $pesan . '.
	 								</div>
									<br>'
				);
				redirect('web/daftar');
			}
		}
	}


	public function login()
	{
		$ceks = $this->session->userdata('username');
		if (isset($ceks)) {
			// $this->load->view('404_content');
			redirect('dashboard');
		} else {
			$data['judul_web'] = "Halaman Login : " . $this->Mcrud->judul_web();
			$this->load->view('web/log/header', $data);
			$this->load->view('web/log/login', $data);
			$this->load->view('web/log/footer', $data);

			if (isset($_POST['btnlogin'])) {
				$username = htmlentities(strip_tags($_POST['username']));
				$pass	   = htmlentities(strip_tags($_POST['password']));

				$query  = $this->Mcrud->get_users_by_un($username);
				$cek    = $query->result();
				$cekun  = $cek[0]->username;
				$jumlah = $query->num_rows();

				if ($jumlah == 0) {
					$this->session->set_flashdata(
						'msg',
						'
									 <div class="alert alert-danger alert-dismissible" role="alert">
									 		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
												<span aria-hidden="true">&times;&nbsp;</span>
											</button>
											<strong>Username "' . $username . '"</strong> belum terdaftar.
									 </div>
									 <br>'
					);
					redirect('web/login');
				} else {
					$row = $query->row();
					$cekpass = $row->password;
					if ($cekpass <> $pass) {
						$this->session->set_flashdata(
							'msg',
							'<div class="alert alert-warning alert-dismissible" role="alert">
													 		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
																<span aria-hidden="true">&times;&nbsp;</span>
															</button>
															<strong>Username atau Password Salah!</strong>.
													 </div>
													 <br>'
						);
						redirect('web/login');
					} else {

						$this->session->set_userdata('username', "$cekun");
						$this->session->set_userdata('id_user', "$row->id_user");
						$this->session->set_userdata('level', "$row->level");

						redirect('dashboard');
					}
				}
			}
		}
	}


	public function logout()
	{
		if ($this->session->has_userdata('username') and $this->session->has_userdata('id_user')) {
			$this->session->sess_destroy();
		}
		redirect('web/login');
	}

	function error_not_found()
	{
		$this->load->view('404_content');
	}
}

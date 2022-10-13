<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Info_lowker extends CI_Controller {

	public function index()
	{
		redirect('info_lowker/v');
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

			$this->db->order_by('id_info_lowker', 'DESC');
			$data['query'] = $this->db->get("tbl_info_lowker");

			if ($aksi == 't') {
				$p = "tambah";
				$data['judul_web'] 	  = "+ Info Lowongan Kerja";
			}elseif ($aksi == 'e') {
				$p = "edit";
				$data['judul_web'] 	  = "Edit Info Lowongan Kerja";
				$data['query'] = $this->db->get_where("tbl_info_lowker", array('id_info_lowker' => "$id"))->row();
				if ($data['query']->id_info_lowker=='') {redirect('404');}
			}
			elseif ($aksi == 'h') {
				$cek_data = $this->db->get_where("tbl_info_lowker", array('id_info_lowker' => "$id"));
				if ($cek_data->num_rows() != 0) {
						if ($cek_data->row()->file != '') {
							unlink($cek_data->row()->file);
						}
						$this->db->delete('tbl_info_lowker', array('id_info_lowker' => $id));
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
						redirect("info_lowker/v");
				}else {
					redirect('404_content');
				}
			}else{
				$p = "index";
				$data['judul_web'] 	  = "Info Lowongan Kerja";
			}

				$this->load->view('users/header', $data);
				$this->load->view("users/info_lowker/$p", $data);
				$this->load->view('users/footer');

				date_default_timezone_set('Asia/Jakarta');
				$tgl = date('Y-m-d H:i:s');

				$lokasi = 'file';
				$file_size = 1024 * 10; // 10 MB
				$this->upload->initialize(array(
					"upload_path"   => "./$lokasi",
					"allowed_types" => "pdf|doc|docx",
					"max_size" => "$file_size"
				));

				if (isset($_POST['btnsimpan'])) {
					$nama = htmlentities(strip_tags($this->input->post('nama')));
					$ket  = htmlentities(strip_tags($this->input->post('ket')));
					if ( ! $this->upload->do_upload('file'))
					{
							$simpan = 'n';
							$pesan  = htmlentities(strip_tags($this->upload->display_errors('<p>', '</p>')));
					}
					 else
					{
								$gbr = $this->upload->data();
								$filename = "$lokasi/".$gbr['file_name'];
								$file = preg_replace('/ /', '_', $filename);
								$simpan = 'y';
					}

					if ($simpan=='y') {
									$data = array(
										'nama' => $nama,
										'ket'  => $ket,
										'file' => $file,
										'tgl_info_lowker' => $tgl
									);
									$this->db->insert('tbl_info_lowker',$data);

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
	 					 redirect("info_lowker/v/t");
					 }
					 redirect("info_lowker/v");
				}

				if (isset($_POST['btnupdate'])) {
					$nama = htmlentities(strip_tags($this->input->post('nama')));
					$ket  = htmlentities(strip_tags($this->input->post('ket')));
					$cek_file = $this->db->get_where('tbl_info_lowker',"id_info_lowker='$id'")->row()->file;
					if ($_FILES['file']['error'] <> 4) {
						if ( ! $this->upload->do_upload('file'))
						{
								$simpan = 'n';
								$pesan  = htmlentities(strip_tags($this->upload->display_errors('<p>', '</p>')));
						}
						 else
						{
							if ($cek_file!='') {
								unlink($cek_file);
							}
									$gbr = $this->upload->data();
									$filename = "$lokasi/".$gbr['file_name'];
									$file = preg_replace('/ /', '_', $filename);
									$simpan = 'y';
						}
					}else {
						$file = $cek_file;
						$simpan = 'y';
					}

					if ($simpan=='y') {
									$data = array(
										'nama' => $nama,
										'ket'  => $ket,
										'file' => $file
									);
									$this->db->update('tbl_info_lowker',$data, array('id_info_lowker' => $id));

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
									redirect("info_lowker/v");
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
							redirect("info_lowker/v/e/".hashids_encrypt($id));
					 }

				}

	}


}

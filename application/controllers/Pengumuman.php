<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengumuman extends CI_Controller {

	public function index()
	{
		$tgl1 = date("01-01-Y");
		$tgl2 = date('d-m-Y',strtotime('+0 month',strtotime($tgl1)));
		redirect("pengumuman/v/$tgl1/$tgl2");
	}

	public function v($tgl1='',$tgl2='',$aksi='',$id='',$id2='')
	{
		if ($tgl1=='' or $tgl2=='') {redirect('404');}
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
			$tgl_1 = date('Y-m-d H:i:s',strtotime($tgl1));
			$tgl_2 = date('Y-m-d H:i:s',strtotime($tgl2));
			$this->db->where('tgl_karyawan >=',$tgl_1);
			$this->db->where('tgl_karyawan <=',$tgl_2);
			$this->db->order_by('nama', 'ASC');
			$data['query'] = $this->db->get("tbl_karyawan");
			$data['tgl1']	= $tgl1;
			$data['tgl2']	= $tgl2;

			$this->db->order_by('id_kriteria', 'ASC');
			$data['v_kriteria'] = $this->db->get("tbl_kriteria");

			if ($aksi == 'd') {
				$p = "detail";
				$data['judul_web'] 	  = "Detail Eksekusi Perengkingan";
				$data['query'] = $this->db->get_where("tbl_karyawan", array('id_karyawan' => "$id"))->row();
				if ($data['query']->id_karyawan=='') {redirect('404');}
			}elseif ($aksi == 'set_pengumuman') {
				$p = "set_pengumuman";
				$data['judul_web'] 	  = "Pengaturan Keterangan Pengumuman";
        $data['query'] = $this->db->get_where("tbl_set_pengumuman", array('id_set_pengumuman' => "1"))->row();
				if ($data['query']->id_set_pengumuman=='') {redirect('404');}
			}elseif ($aksi == 'kirim') {
        if ($id2=='x') {
          $stt = 'Lulus';
        }elseif ($id2=='xx') {
          $stt = 'Tidak Lulus';
        }else{
          redirect('404');
        }
        $cek_data = $this->db->get_where("tbl_penyeleksian", array('id_karyawan' => "$id"));
				if ($cek_data->num_rows() != 0) {
						$this->db->update('tbl_karyawan', array('status_pengumuman'=>$stt), array('id_karyawan' => $id));
						$this->session->set_flashdata('msg',
							'
							<div class="alert alert-success alert-dismissible" role="alert">
								 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
									 <span aria-hidden="true">&times;</span>
								 </button>
								 <strong>Sukses!</strong> Berhasil dikirim.
							</div>
							<br>'
						);
						redirect("pengumuman/v/$tgl1/$tgl2");
				}else {
					redirect('404_content');
				}
			}else{
				$p = "index";
				$data['judul_web'] 	  = "Eksekusi Perengkingan";
			}

				$this->load->view('users/header', $data);
				$this->load->view("users/pengumuman/$p", $data);
				$this->load->view('users/footer');

        date_default_timezone_set('Asia/Jakarta');
        $tgl = date('Y-m-d H:i:s');
        
        if (isset($_POST['btnsimpan_p'])) {
          $isi = $this->input->post('isi');

                  $data = array(
                    'isi' => $isi,
                    'tgl_set_pengumuman' => $tgl,
                  );
                  $this->db->update('tbl_set_pengumuman',$data, array('id_set_pengumuman'=>1));

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
           redirect("pengumuman/v/$tgl1/$tgl2/set_pengumuman");
        }

	}


  public function view()
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

			$data['query'] = $this->db->get_where("tbl_karyawan", array('id_user'=>$id_user))->row();

				$p = "view";
				$data['judul_web'] 	  = "Pengumuman";

				$this->load->view('users/header', $data);
				$this->load->view("users/pengumuman/$p", $data);
				$this->load->view('users/footer');

	}

}

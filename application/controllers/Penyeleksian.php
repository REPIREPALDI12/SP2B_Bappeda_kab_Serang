<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penyeleksian extends CI_Controller {

	public function index()
	{
		date_default_timezone_set('Asia/Jakarta');
		$tgl1 = date("01-01-Y");
		$tgl2 = date('d-m-Y',strtotime('+0 month',strtotime($tgl1)));
		redirect("penyeleksian/v/$tgl1/$tgl2");
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

			if ($aksi == 't') {
				$p = "tambah";
				$data['judul_web'] 	  = "Pilih Peserta Konfigurasi";
			}elseif ($aksi == 'grafik') {
				$p = "grafik";
				$data['judul_web'] 	  = "Grafik Keterangan Nilai Penyeleksian";
				$data['lulus'] 		 = $this->db->get_where("tbl_karyawan", array('tgl_karyawan>='=>$tgl_1,'tgl_karyawan<='=>$tgl_2,'total_nilai>='=>'75'))->num_rows();
				$data['tdk_lulus'] = $this->db->get_where("tbl_karyawan", array('tgl_karyawan>='=>$tgl_1,'tgl_karyawan<='=>$tgl_2,'total_nilai<'=>'75'))->num_rows();
				$data['total']		 = $data['lulus'] + $data['tdk_lulus'];
			}elseif ($aksi == 'd') {
				$p = "detail";
				$data['judul_web'] 	  = "Detail Nilai Penyeleksian";
				$data['query'] = $this->db->get_where("tbl_karyawan", array('id_karyawan' => "$id"))->row();
				if ($data['query']->id_karyawan=='') {redirect('404');}
			}elseif ($aksi == 'n') {
				$p = "nilai";
				$data['judul_web'] 	  = "Input Penilaian";
				$data['query'] = $this->db->get_where("tbl_karyawan", array('id_karyawan' => "$id"))->row();
				if ($data['query']->id_karyawan=='') {redirect('404');}
				$cek_p = $this->db->get_where("tbl_penyeleksian", array('id_karyawan' => "$id"))->num_rows();
				if ($cek_p!=0) {
					redirect('404');
				}
			}elseif ($aksi == 'ne') {
				$p = "nilai_edit";
				$data['judul_web'] 	  = "Edit Penilaian";
				$data['query'] = $this->db->get_where("tbl_karyawan", array('id_karyawan' => "$id"))->row();
				if ($data['query']->id_karyawan=='') {redirect('404');}
				$data['cek_p'] = $this->db->get_where("tbl_penyeleksian", array('id_karyawan' => "$id"))->row();
				if ($data['cek_p']->id_penyeleksian=='') {
					redirect('404');
				}
			}
			elseif ($aksi == 'h') {
				$cek_data = $this->db->get_where("tbl_penyeleksian", array('id_karyawan' => "$id"));
				if ($cek_data->num_rows() != 0) {
						$this->db->delete('tbl_penyeleksian', array('id_karyawan' => $id));
            $this->db->delete('tbl_hasil', array('id_karyawan' => $id));
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
						redirect("penyeleksian/v/$tgl1/$tgl2");
				}else {
					redirect('404_content');
				}
			}else{
				$p = "index";
				$data['judul_web'] 	  = "Penyeleksian Multi Factor Evolution";
			}

				$this->load->view('users/header', $data);
				$this->load->view("users/penyeleksian/$p", $data);
				$this->load->view('users/footer');

				date_default_timezone_set('Asia/Jakarta');
				$tgl = date('Y-m-d H:i:s');

        $t_bobot=0;
				if (isset($_POST['btnsimpan'])) {
					$total = 0;
					foreach ($data['v_kriteria']->result() as $key => $value) {
						$nilai = preg_replace('/[,]/','.', htmlentities(strip_tags($this->input->post('nilai_'.$value->id_kriteria))));
						if(preg_match("/^[0-9.]+$/", $nilai) == 1) {
							$bobot  = $this->db->get_where('tbl_kriteria', array('id_kriteria'=>$value->id_kriteria))->row()->bobot;
							$jml_nilai = $bobot*$nilai;
						}else {
							$jml_nilai = '0';
						}
						$data = array(
							'id_karyawan' => $id,
							'id_kriteria' => $value->id_kriteria,
							'nilai'  			=> $nilai,
							'jml_nilai'  	=> $jml_nilai,
							'tgl_penyeleksian' => $tgl
						);
						$this->db->insert('tbl_penyeleksian',$data);

            $bobot = $this->input->post('bobot_'.$value->id_kriteria);
            $data = array(
							'id_karyawan' => $id,
							'id_kriteria' => $value->id_kriteria,
							'kriteria'    => $value->nama_kriteria,
              'analisa'     => $this->input->post('analisa_'.$value->id_kriteria),
              'sub_kriteria'=> $this->input->post('sub_kriteria_'.$value->id_kriteria),
							'bobot_kriteria' => $bobot,
							'nilai_range'  	 => $nilai,
              'jumlah_nilai'   => $jml_nilai,
							'tgl_hasil' => $tgl
						);
						$this->db->insert('tbl_hasil',$data);

            $t_bobot += $bobot;
						$total   += $jml_nilai;
					}
									$total = number_format($total,2);
									$data2 = array(
										'total_nilai' => $total
									);
									$this->db->update('tbl_karyawan',$data2, array('id_karyawan'=>$id));

                  $data = array(
      							'id_karyawan' => $id,
      							'kriteria'    => '',
                    'analisa'     => '',
                    'sub_kriteria'=> '',
      							'bobot_kriteria' => $t_bobot,
      							'nilai_range'  	 => '',
                    'jumlah_nilai'   => $total,
      							'tgl_hasil' => $tgl
      						);
      						$this->db->insert('tbl_hasil',$data);

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
					 redirect("penyeleksian/v/$tgl1/$tgl2");
				}


        if (isset($_POST['btnupdate'])) {
					$total = 0;
					foreach ($data['v_kriteria']->result() as $key => $value) {
						$nilai = preg_replace('/[,]/','.', htmlentities(strip_tags($this->input->post('nilai_'.$value->id_kriteria))));
						if(preg_match("/^[0-9.]+$/", $nilai) == 1) {
							$bobot  = $this->db->get_where('tbl_kriteria', array('id_kriteria'=>$value->id_kriteria))->row()->bobot;
							$jml_nilai = $bobot*$nilai;
						}else {
							$jml_nilai = '0';
						}
						$data_p = $this->db->get_where('tbl_penyeleksian', array('id_karyawan'=>$id,'id_kriteria'=>$value->id_kriteria));
						if ($data_p->num_rows()==0) {
							$data = array(
								'id_karyawan' => $id,
								'id_kriteria' => $value->id_kriteria,
								'nilai'  			=> $nilai,
								'jml_nilai'  	=> $jml_nilai,
								'tgl_penyeleksian' => $tgl
							);
							$this->db->insert('tbl_penyeleksian',$data);
						}else{
							$data = array(
								'id_karyawan' => $id,
								'id_kriteria' => $value->id_kriteria,
								'nilai'  			=> $nilai,
								'jml_nilai'  	=> $jml_nilai
							);
							$this->db->update('tbl_penyeleksian',$data, array('id_karyawan'=>$id,'id_kriteria'=>$value->id_kriteria));
						}
            $bobot = $this->input->post('bobot_'.$value->id_kriteria);
						  $data = array(
								'id_karyawan' => $id,
								'id_kriteria' => $value->id_kriteria,
								'kriteria'    => $value->nama_kriteria,
	              'analisa'     => $this->input->post('analisa_'.$value->id_kriteria),
	              'sub_kriteria'=> $this->input->post('sub_kriteria_'.$value->id_kriteria),
								'bobot_kriteria' => $bobot,
								'nilai_range'  	 => $nilai,
	              'jumlah_nilai'   => $jml_nilai,
								'tgl_hasil' => $tgl
							);
						if ($data_p->num_rows()==0) {
		         	$this->db->update('tbl_hasil',$data, array('id_karyawan'=>$id,'id_kriteria'=>$value->id_kriteria));
						}else{
							$this->db->insert('tbl_hasil',$data);
						}
            $t_bobot += $bobot;
						$total   += $jml_nilai;
					}
									$total = number_format($total,2);
									$data2 = array(
										'total_nilai' => $total
									);
									$this->db->update('tbl_karyawan',$data2, array('id_karyawan'=>$id));

                  $data = array(
      							'id_karyawan' => $id,
      							'kriteria'    => '',
                    'analisa'     => '',
                    'sub_kriteria'=> '',
      							'bobot_kriteria' => $t_bobot,
      							'nilai_range'  	 => '',
                    'jumlah_nilai'   => $total,
      							'tgl_hasil' => $tgl
      						);
      						$this->db->update('tbl_hasil',$data, array('id_karyawan'=>$id,'kriteria'=>''));

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
					 redirect("penyeleksian/v/$tgl1/$tgl2");
				}

	}


		public function hitung()
		{
			if (isset($_POST['btnkirim'])) {
				$id  	 = htmlentities(strip_tags($this->input->post('id')));
				$nilai = preg_replace('/[,]/','.',htmlentities(strip_tags($this->input->post('nilai'))));
				if(preg_match("/^[0-9.]+$/", $nilai) == 1) {
					$bobot  = $this->db->get_where('tbl_kriteria', array('id_kriteria'=>$id))->row()->bobot;
					$jumlah = $bobot*$nilai;
				}else {
					$jumlah = 0;
				}
				echo json_encode(array('jumlah'=>$jumlah));
			}else {
				redirect('404');
			}
		}

}

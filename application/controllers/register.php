<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->library(array('form_validation'));
		$this->load->model('register_model');
	}

	public function index()
	{
		$this->load->view('register');
	}

	public function api_reg(){
		if ( !isset($_POST['submiten']) ) {
			redirect('register');
		}else{
			$config['upload_path'] = 'asset/img/';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size']	= '1000';
			$config['max_width']  = '1024';
			$config['max_height']  = '768';
	 
			$this->load->library('upload', $config);
	 
			if ( ! $this->upload->do_upload('userfile')){
				$error = array('error' => $this->upload->display_errors());
	 
				$this->load->view('register', $error);
			}
			else{
				$data = $this->upload->data();
	 
				extract($_POST);
				$data = array(
							'id_peserta' 		=> '',
							'nama_suami' 		=> $nama_suami,
							'nama_istri' 		=> $nama_istri,
							'jml_anak' 			=> $jml_anak,
							'alamat' 			=> $alamat,
							'no_telp' 			=> $no_telp,
							'bapak_suami' 		=> $bapak_suami,
							'ibu_suami'			=> $ibu_suami,
							'bapak_istri'		=> $bapak_istri,
							'ibu_istri'			=> $ibu_istri,
							'jorong_suami'		=> $jorong_suami,
							'jorong_istri'		=> $jorong_istri,
							'suku_suami'		=> $suku_suami,
							'suku_istri'		=> $suku_istri,
							'link_photo'		=> $data['full_path']
						);
				$reg_data	= $this->register_model->registration( $data );

				if ( $reg_data ) {
					$data = array('nama_suami' => $nama_suami,'nama_istri' => $nama_istri );
					$result = $this->register_model->get_data( $data );
					print_r( $result );
				}
				
				if ( $reg_data == TRUE) {
					$param = array('flashdata' => 'Registraion Success !!', );
				}else{
					$param = array('flashdata' => 'Registraion Failed !!', );
				}
				$this->load->view("register", $param );
			}
		}
	}

}

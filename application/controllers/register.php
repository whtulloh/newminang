<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {

	public function __construct(){
		parent::__construct();
		//$this->load->model('bukutamu_model', 'bktm');
	}

	public function index()
	{
		$this->load->view('register');
	}

}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Header_Controller extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library("session");
	}

	public function index()
	{
		$this->load->model("header_model");
		$this->load->model("login_model");
		$user_id = $this->session->userdata('user_id');
		$data = array(
			"styles"=>array(

			),
			"scripts"=>array(
				"util.js",
				"login.js"
			),
			'usuario_session' =>$this->login_model->get_nome_completo($user_id)->result_array()[0],
			'versao_sistema'=>$this->header_model->get_versao_sistema()->result_array()[0]
		);

		print_r($user_id);

		$this->load->view('header.php', $data);
	}

}

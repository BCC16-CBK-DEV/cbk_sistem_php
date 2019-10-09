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
		//$this->load->model("login_model");

		$data = array(
			"styles"=>array(

			),
			"scripts"=>array(
				"util.js"

			)

			//'versao_sistema' => $this->header_model->get_versao_sistema()
			//'usuario_session' => $this->login_model->get_nome_completo($this->session->userdata('user_id'))
		);
			
		//print_r('USUARIO: '.$this->session->userdata('user_id'));

		// $data_usuario['usuario_session'] = $this->login_model->get_nome_completo($this->session->userdata('user_id'));

		$this->load->view('header.php', $data);
	}

}

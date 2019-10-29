<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Header_Controller extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library("session");
		$this->load->model("login_model");
		$autorizada = $this->login_model->info_autorizada($this->session->userdata('autorizada'))->result_array()[0];

		$this->session->set_userdata("nome_autorizada", $autorizada['nome_autorizada']);
	}

	public function index()
	{
		$this->load->model("header_model");

		$user_id = $this->session->userdata('user_id');


		if(!empty($user_id)) {
			//print_r($autorizada);

			$data = array(
				"styles" => array(),
				"scripts" => array(
					"util.js",
					"login.js"
				),
				'usuario_session' => $this->login_model->get_nome_completo($user_id)->result_array()[0],
				'versao_sistema' => $this->header_model->get_versao_sistema()->result_array()[0]
			);

			//print_r($autorizada);

			$this->load->view('header.php', $data);

		} else {
			$data = array(
				"scripts" => array(
					"util.js",
					"login.js"
				),
			);
			$this->load->view("login.php", $data);
		}
	}

}

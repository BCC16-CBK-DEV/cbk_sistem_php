<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_Controller extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library('session');
	}

	public function index()
	{
		if ($this->session->userdata("user_id")) {
		 	$data = array(
				"scripts" => array(
		 			"util.js",
					"login.js"
		 		),
		 		"user_id" => $this->session->userdata("user_id")
		 	);
		 	$this->load->view("principal.php", $data);
		} else {
			$data = array(
				"scripts" => array(
					"util.js",
					"login.js" 
				),
			);
			$this->load->view("login.php", $data);
		}
		//$this->load->view("login.php", $data);
	}

	public function acesso(){

		$json = array();
		$json["status"] = 1;
		$json["error_list"] = array();

		$username = $this->input->post("username");
		$password = $this->input->post("password");

		if (empty($username)) {
			$json["status"] = 0;
			$json["error_list"]["#username"] = "Usuário não pode ser vazio!";
		} else {
			$this->load->model("login_model");
			$result = $this->login_model->get_acesso_sistema($username);
			if ($result) {
				$user_id = $result->nome_usuario;
				$password_hash = $result->senha;
				if (password_verify($password, $password_hash)) {
					$this->session->set_userdata("user_id", $user_id);
				} else {
					$json["status"] = 0;
				}
			} else {
				$json["status"] = 0;
			}
			if ($json["status"] == 0) {
				$json["error_list"]["#botao_login"] = "Usuário e/ou senha incorretos!";
			}
		}

		echo json_encode($json);

	}

	public function logout(){

		$this->session->unset_userdata("user_id");
		$this->index();
	}

}

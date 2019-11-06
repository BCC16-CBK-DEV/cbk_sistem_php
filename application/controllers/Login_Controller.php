<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_Controller extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library('session');
	}

	public function index()
	{
		$data = array(
			"scripts" => array(
				"util.js",
				"login.js"));

		$this->load->view("login.php", $data);
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
				$id_usuario = $result->id_usuario;
				$id_autorizada = $result->id_autorizada;
				$departamento = $result->id_departamento;
				$password_hash = $result->senha;
				if (password_verify($password, $password_hash)) {
					$this->session->set_userdata("user_id", $user_id);
					$this->session->set_userdata("id_usuario", $id_usuario);
					$this->session->set_userdata("autorizada",$id_autorizada);
					$this->session->set_userdata("departamento",$departamento);
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
		$this->session->unset_userdata("autorizada");
		$this->session->unset_userdata("nome_autorizada");
		$this->index();
	}

}

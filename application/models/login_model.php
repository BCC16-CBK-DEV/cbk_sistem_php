<?php
class Login_model extends CI_Model {

	public function __construct() {
		parent::__construct();
		//$this->load->database();
	}

	public function get_acesso_sistema($username){

		$this->db
			->select("*")
			->from("usuario")
			->where("nome_usuario", $username);

		$result = $this->db->get();

		if ($result->num_rows() > 0) {
			return $result->row();
		} else {
			return NULL;
		}

	}

	public function get_nome_completo($user_id){

		$this->db
			->select("*")
			->from("usuario")
			->where("nome_usuario", $user_id);

		return $this->db->get();
	}

	public function info_autorizada($autorizada){

		$this->db
			->select("*")
			->from("autorizada")
			->where("id_autorizada", $autorizada);

		return $this->db->get();
	}

}

<?php

class Header_model extends CI_Model {
	
	public function __construct() {
		parent::__construct();
	}


	public function get_versao_sistema() {

		$this->db
			->select("*")
			->from("versao")
			->order_by("id_versao DESC")
			->limit(1);

		return $this->db->get();
	}
}

?>

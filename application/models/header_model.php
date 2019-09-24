<?php

class Header_model extends CI_Model {
	
	public function __construct() {
		parent::__construct();
	}


	public function get_versao_sistema() {

		$this->db
			->select("versao_num")
			->from("versao")
			->order_by("id_versao DESC")
			->limit(1);

		$result = $this->db->get();

		if ($result->num_rows() > 0) {
			return $result->row();
		} else {
			return NULL;
		}
	}
}

?>
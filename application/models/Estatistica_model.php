<?php


class Estatistica_model extends CI_Model
{

	public function __construct() {
		parent::__construct();
	}

	public function graficos_link($id_autorizada,$id_grafico) {

		$this->db
			->select('*')
			->from('estatistica_autorizada')
			->where('id_estatistica_grafico',$id_grafico)
			->where('id_autorizada',$id_autorizada);

		return $this->db->get();

	}


}

<?php


class estatistica_model extends CI_Model
{

	public function __construct() {
		parent::__construct();
	}

	public function est_qtdano($id_autorizada) {

		$this->db
			->select('*')
			->from('estatistica_autorizada')
			->where('id_estatistica_grafico',1)
			->where('id_autorizada',$id_autorizada);

		return $this->db->get();

	}

	public function lucro_ano($id_autorizada) {

		$this->db
			->select('*')
			->from('estatistica_autorizada')
			->where('id_estatistica_grafico',2)
			->where('id_autorizada',$id_autorizada);

		return $this->db->get();

	}

}

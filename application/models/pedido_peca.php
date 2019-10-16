<?php


class pedido_peca extends CI_Model
{

	public function __construct() {
		parent::__construct();
	}

	public function nova_peca($descricao,$codigo,$valor,$quantidade) {

		$data = array(
			'descricao_peca'=>$descricao,
			'valor_peca_unidade'=>$valor,
			'quantidade_peca'=>$quantidade,
			'codigo_peca'=>$codigo
		);

		$this->db->insert('peca',$data);

	}

	public function pecas() {

		$this->db
			->select('*')
			->from('peca');

		return $this->db->get()->result_array();

	}

	public function carregar_peca($id_peca) {

		$this->db
			->select('*')
			->from('peca')
			->where('id_peca', $id_peca);

		return $this->db->get();

	}

	public function updatePeca($id_peca,$descricao,$codigo,$valor,$quantidade) {

		$data = array(
			'descricao_peca'=>$descricao,
			'valor_peca_unidade'=>$valor,
			'quantidade_peca'=>$quantidade,
			'codigo_peca'=>$codigo
		);

		$this->db->where('id_peca', $id_peca);
		$this->db->update('peca', $data);


	}

	public function deletePeca($id_peca) {

		$this->db->where('id_peca', $id_peca);
		$this->db->delete('peca');


	}


}

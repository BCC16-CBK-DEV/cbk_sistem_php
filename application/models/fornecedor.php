<?php


class fornecedor extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
	}

	public function adicionar_fornecedor($nome,$cnpj,$telefone,$email,$id_autorizada) {

		$data = array(
			"nome_fornecedor"=>$nome,
			"cnpj_fornecedor"=>$cnpj,
			"email_fornecedor"=>$email,
			"telefone_fornecedor"=>$telefone,
			"id_autorizada"=>$id_autorizada
		);

		$this->db->insert("fornecedor", $data);
	}

	public function lista_fornecedores ($id_autorizada) {
		$this->db
			->select('*')
			->from('fornecedor')
			->where('id_autorizada',$id_autorizada);

		return $this->db->get()->result_array();
	}

	public function carregarFornecedor ($id) {
		$this->db
			->select('*')
			->from('fornecedor')
			->where('id_fornecedor',$id);

		return $this->db->get();

	}

	public function alterar_fornecedor($id,$nome,$cnpj,$email,$telefone) {

		$data = array(
			"nome_fornecedor"=>$nome,
			"cnpj_fornecedor"=>$cnpj,
			"email_fornecedor"=>$email,
			"telefone_fornecedor"=>$telefone
		);
		$this->db->where('id_fornecedor',$id);
		$this->db->update("fornecedor", $data);
	}

	public function excluir_fornecedor($id) {

		$this->db->where('id_fornecedor',$id);
		$this->db->delete("fornecedor");
	}

}

<?php


class Fornecedor extends CI_Model
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

	public function filtro_fornecedor($option,$id_autorizada,$nome,$cnpj,$email,$telefone) {

		switch($option) {
			case 1:
				$where = ('id_autorizada = '.$id_autorizada.' AND nome_fornecedor LIKE "%'.$nome.'%"');

				$this->db
					->select("*")
					->from("fornecedor")
					->where($where);
				break;

			case 2:
				$where = ('id_autorizada = '.$id_autorizada.' AND cnpj_fornecedor LIKE "%'.$cnpj.'%"');

				$this->db
					->select("*")
					->from("fornecedor")
					->where($where);
				break;

			case 3:
				$where = ('id_autorizada = '.$id_autorizada.' AND email_fornecedor LIKE "%'.$email.'%"');

				$this->db
					->select("*")
					->from("fornecedor")
					->where($where);
				break;

			case 4:
				$where = ('id_autorizada = '.$id_autorizada.' AND telefone_fornecedor LIKE "%'.$telefone.'%"');

				$this->db
					->select("*")
					->from("fornecedor")
					->where($where);
				break;

			case 5:
				$where = ('id_autorizada = '.$id_autorizada.' AND nome_fornecedor LIKE "%'.$nome.'%" AND cnpj_fornecedor LIKE "%'.$cnpj.'%"');

				$this->db
					->select("*")
					->from("fornecedor")
					->where($where);
				break;

			case 6:
				$where = ('id_autorizada = '.$id_autorizada.' AND nome_fornecedor LIKE "%'.$nome.'%" AND email_fornecedor LIKE "%'.$email.'%"');

				$this->db
					->select("*")
					->from("fornecedor")
					->where($where);
				break;

			case 7:
				$where = ('id_autorizada = '.$id_autorizada.' AND nome_fornecedor LIKE "%'.$nome.'%" AND telefone_fornecedor LIKE "%'.$telefone.'%"');

				$this->db
					->select("*")
					->from("fornecedor")
					->where($where);
				break;

			case 8:
				$where = ('id_autorizada = '.$id_autorizada.' AND nome_fornecedor LIKE "%'.$nome.'%" AND cnpj_fornecedor LIKE "%'.$cnpj.'%" 
				AND email_fornecedor LIKE "%'.$email.'%"');

				$this->db
					->select("*")
					->from("fornecedor")
					->where($where);
				break;

			case 9:
				$where = ('id_autorizada = '.$id_autorizada.' AND nome_fornecedor LIKE "%'.$nome.'%" AND cnpj_fornecedor LIKE "%'.$cnpj.'%" 
				AND telefone_fornecedor LIKE "%'.$telefone.'%"');

				$this->db
					->select("*")
					->from("fornecedor")
					->where($where);
				break;

			case 10:
				$where = ('id_autorizada = '.$id_autorizada.' AND nome_fornecedor LIKE "%'.$nome.'%" AND cnpj_fornecedor LIKE "%'.$cnpj.'%" 
				AND email_fornecedor LIKE "%'.$email.'%" AND telefone_fornecedor LIKE "%'.$telefone.'%"');

				$this->db
					->select("*")
					->from("fornecedor")
					->where($where);
				break;

			case 11:
				$where = ('id_autorizada = '.$id_autorizada.' AND cnpj_fornecedor LIKE "%'.$cnpj.'%" AND email_fornecedor LIKE "%'.$email.'%"');

				$this->db
					->select("*")
					->from("fornecedor")
					->where($where);
				break;

			case 12:
				$where = ('id_autorizada = '.$id_autorizada.' AND email_fornecedor LIKE "%'.$email.'%" AND telefone_fornecedor LIKE "%'.$telefone.'%"');

				$this->db
					->select("*")
					->from("fornecedor")
					->where($where);
				break;

			case 13:
				$where = ('id_autorizada = '.$id_autorizada.' AND cnpj_fornecedor LIKE "%'.$cnpj.'%" AND email_fornecedor LIKE "%'.$email.'%" 
				AND telefone_fornecedor LIKE "%'.$telefone.'%"');

				$this->db
					->select("*")
					->from("fornecedor")
					->where($where);
				break;

			default:
				$this->db
					->select("*")
					->from("fornecedor")
					->where('id_autorizada',$id_autorizada);
				break;

		}

		$result = $this->db->get()->result_array();


		return $result;
	}

}

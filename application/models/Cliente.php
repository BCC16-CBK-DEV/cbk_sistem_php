<?php
class Cliente extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
	}

	public function NovoCliente($nome,$cpf,$rg,$cep,$endereco,$bairro,$numero,$cidade,$email,
								$uf,$complemento,$telefone,$celular,$id_autorizada){
		$data = array(
			'nome_cliente' => $nome,
			'cpf' => $cpf,
			'rg'=>$rg,
			'cep'=>$cep,
			'endereco'=>$endereco,
			'bairro'=>$bairro,
			'numero'=>$numero,
			'complemento'=>$complemento,
			'email'=>$email,
			'telefone'=>$telefone,
			'celular' => $celular,
			'cidade'=>$cidade,
			'uf'=>$uf,
			'id_autorizada'=>$id_autorizada);

		$this->db->insert('cliente',$data);

	}

	public function listaClientes($id_autorizada) {
		$this->db
			->select('id_cliente,nome_cliente,cpf,email,celular')
			->from('cliente')
			->where('id_autorizada',$id_autorizada);

		return $this->db->get()->result_array();
	}

	public function carregarCliente($id_cliente) {

		$this->db
			->select('*')
			->from('cliente')
			->where('id_cliente',$id_cliente);

		return $this->db->get();

	}

	public function updateCliente($id_cliente,$nome,$cpf,$rg,$cep,$endereco,$bairro,$numero,$cidade,$email,
								  $uf,$complemento,$telefone,$celular) {
		$data = array(
			'nome_cliente' => $nome,
			'cpf' => $cpf,
			'rg'=>$rg,
			'cep'=>$cep,
			'endereco'=>$endereco,
			'bairro'=>$bairro,
			'numero'=>$numero,
			'complemento'=>$complemento,
			'email'=>$email,
			'telefone'=>$telefone,
			'celular' => $celular,
			'cidade'=>$cidade,
			'uf'=>$uf);

		$this->db->where('id_cliente',$id_cliente);
		$this->db->update('cliente',$data);
	}

	public function deleteCliente($id_cliente) {
		$this->db->where('id_cliente',$id_cliente);
		$this->db->delete('cliente');
	}

	public function filtro_cliente($option,$id_autorizada,$nome,$cpf,$email,$celular) {

		switch($option) {
			case 1:
				$where = ('id_autorizada = '.$id_autorizada.' AND nome_cliente LIKE "%'.$nome.'%"');

				$this->db
					->select("*")
					->from("cliente")
					->where($where);
				break;

			case 2:
				$where = ('id_autorizada = '.$id_autorizada.' AND cpf LIKE "%'.$cpf.'%"');

				$this->db
					->select("*")
					->from("cliente")
					->where($where);
				break;

			case 3:
				$where = ('id_autorizada = '.$id_autorizada.' AND email LIKE "%'.$email.'%"');

				$this->db
					->select("*")
					->from("cliente")
					->where($where);
				break;

			case 4:
				$where = ('id_autorizada = '.$id_autorizada.' AND celular LIKE "%'.$celular.'%"');

				$this->db
					->select("*")
					->from("cliente")
					->where($where);
				break;

			case 5:
				$where = ('id_autorizada = '.$id_autorizada.' AND nome_cliente LIKE "%'.$nome.'%" AND cpf LIKE "%'.$cpf.'%"');

				$this->db
					->select("*")
					->from("cliente")
					->where($where);
				break;

			case 6:
				$where = ('id_autorizada = '.$id_autorizada.' AND nome_cliente LIKE "%'.$nome.'%" AND email LIKE "%'.$email.'%"');

				$this->db
					->select("*")
					->from("cliente")
					->where($where);
				break;

			case 7:
				$where = ('id_autorizada = '.$id_autorizada.' AND nome_cliente LIKE "%'.$nome.'%" AND celular LIKE "%'.$celular.'%"');

				$this->db
					->select("*")
					->from("cliente")
					->where($where);
				break;

			case 8:
				$where = ('id_autorizada = '.$id_autorizada.' AND nome_cliente LIKE "%'.$nome.'%" AND cpf LIKE "%'.$cpf.'%" 
				AND email LIKE "%'.$email.'%"');

				$this->db
					->select("*")
					->from("cliente")
					->where($where);
				break;

			case 9:
				$where = ('id_autorizada = '.$id_autorizada.' AND nome_cliente LIKE "%'.$nome.'%" AND cpf LIKE "%'.$cpf.'%" 
				AND celular LIKE "%'.$celular.'%"');

				$this->db
					->select("*")
					->from("cliente")
					->where($where);
				break;

			case 10:
				$where = ('id_autorizada = '.$id_autorizada.' AND nome_cliente LIKE "%'.$nome.'%" AND cpf LIKE "%'.$cpf.'%" 
				AND email LIKE "%'.$email.'%" AND celular LIKE "%'.$celular.'%"');

				$this->db
					->select("*")
					->from("cliente")
					->where($where);
				break;

			case 11:
				$where = ('id_autorizada = '.$id_autorizada.' AND cpf LIKE "%'.$cpf.'%" AND email LIKE "%'.$email.'%"');

				$this->db
					->select("*")
					->from("cliente")
					->where($where);
				break;

			case 12:
				$where = ('id_autorizada = '.$id_autorizada.' AND email LIKE "%'.$email.'%" AND celular LIKE "%'.$celular.'%"');

				$this->db
					->select("*")
					->from("cliente")
					->where($where);
				break;

			case 13:
				$where = ('id_autorizada = '.$id_autorizada.' AND cpf LIKE "%'.$cpf.'%" AND email LIKE "%'.$email.'%" 
				AND celular LIKE "%'.$celular.'%"');

				$this->db
					->select("*")
					->from("cliente")
					->where($where);
				break;

			default:
				$this->db
					->select("*")
					->from("cliente")
					->where('id_autorizada',$id_autorizada);
				break;

		}

		$result = $this->db->get()->result_array();


		return $result;
	}
}

?>

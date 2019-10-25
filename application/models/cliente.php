<?php
class Cliente extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
	}

	public function NovoCliente($nome,$cpf,$rg,$cep,$endereco,$bairro,$numero,$cidade,$email,
								$uf,$complemento,$telefone,$celular){
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

		$this->db->insert('cliente',$data);

	}

	public function listaClientes() {
		$this->db
			->select('id_cliente,nome_cliente,cpf,email,celular')
			->from('cliente');

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
}

?>

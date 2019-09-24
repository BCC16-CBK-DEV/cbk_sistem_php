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
}

?>

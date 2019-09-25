<?php
class Ordem_Servico extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
	}

	public function carregarCliente(){
		$this->db
			->select("id_cliente, nome_cliente")
			->from("cliente")
			->order_by('nome_cliente');

		return $this->db->get()->result_array();
	}

	public function novo_cliente($nome,$cpf,$celular){
		$data = array(
		'nome_cliente' => $nome,
		'cpf' => $cpf,
		'celular' => $celular);

		$this->db->insert('cliente',$data);

	}

	public function dados_cliente($valor) {
		$this->db
			->select('*')
			->from('cliente')
			->where('id_cliente',$valor);

		return $this->db->get();;

	}

	public function os_abertas() {
		$this->db
			->select('*')
			->from('ordem_servico')
			->where('id_status', 1);

		return $this->db->get()->result_array();
	}

	public function os_fechadas() {
		$this->db
			->select('*')
			->from('ordem_servico')
			->where('id_status', 2);

		return $this->db->get()->result_array();
	}

}
?>

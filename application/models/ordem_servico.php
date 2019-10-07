<?php
class Ordem_Servico extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
	}

	public function carregarCliente(){
		$this->db
			->select("id_cliente, nome_cliente, cpf")
			->from("cliente")
			->order_by('nome_cliente');

		return $this->db->get()->result_array();
	}

	public function carregarNomeCliente($idcliente){
		$this->db
			->select("id_cliente, nome_cliente")
			->from("cliente")
			->where("id_cliente", $idcliente);

		return $this->db->get();
	}

	public function carregarNomeUltimoCliente(){
		$this->db
			->select("id_cliente, nome_cliente")
			->from("cliente")
			->order_by("id_cliente DESC")
			->limit(1);

		return $this->db->get();
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

	public function UltimaOrdem(){
		$this->db
			->select("numero_ordem")
			->from("ordem_servico")
			->order_by("numero_ordem DESC")
			->limit(1);

		$query = $this->db->get();

		if ($query->num_rows() > 0) {
			return $query->row()->numero_ordem;
		}
		return false;
	}

	public function novaOrdem($data_abertura,$nota_fiscal,$codigo_produto,$data_compra,$descricao_produto,$numero_serie,
					$voltagem,$defeito_reclamado,$idcliente){

		$numero_ordem = (int)$this->UltimaOrdem();

		$numero_ordem++;

		$data = array(
			'numero_ordem'=>$numero_ordem,
			'nota_fiscal' => $nota_fiscal,
			'data_compra' => $data_compra,
			'defeito_reclamado' => $defeito_reclamado,
			'codigo_produto' => $codigo_produto,
			'descricao_produto' => $descricao_produto,
			'voltagem' => $voltagem,
			'numero_serie_produto' => $numero_serie,
			'data_abertura' => $data_abertura,
			'id_cliente' => $idcliente);

		$this->db->insert('ordem_servico',$data);

	}

	public function filtro_ordem ($numero_inicial) {

		$this->db
			->select("numero_ordem")
			->from("ordem_servico")
			->where("numero_ordem", $numero_inicial);

		//print_r($this->db->get()->result_array());

		return $this->db->get()->result_array();

	}

}
?>

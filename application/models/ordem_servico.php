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

	public function filtro_ordem_fechada ($option,$numero_inicial,$numero_final,$data_inicial,$data_final,$descricao,
								  $nota_fiscal,$codigo_produto) {

		switch ($option) {
			case '1':
				$where = ('numero_ordem <='.$numero_final.' AND data_abertura >= "'.$data_inicial.'" AND data_abertura <= "'.$data_final.'" 
				AND descricao_produto LIKE "%'.$descricao.'%" AND nota_fiscal LIKE "%'.$nota_fiscal.'%" 
				AND codigo_produto LIKE "%'.$codigo_produto.'%" AND id_status = 2');

				$this->db
				->select("*")
				->from("ordem_servico")
				->where($where);
				break;

			case '2':
				$where = ('numero_ordem >='.$numero_inicial.' AND data_abertura >= "'.$data_inicial.'" AND data_abertura <= "'.$data_final.'" 
				AND descricao_produto LIKE "%'.$descricao.'%" AND nota_fiscal LIKE "%'.$nota_fiscal.'%" 
				AND codigo_produto LIKE "%'.$codigo_produto.'%" AND id_status = 22');

				$this->db
					->select("*")
					->from("ordem_servico")
					->where($where);
				break;

			case '3':
				$where = ('numero_ordem <='.$numero_final.' AND data_abertura <= "'.$data_final.'" 
				AND descricao_produto LIKE "%'.$descricao.'%" AND nota_fiscal LIKE "%'.$nota_fiscal.'%" 
				AND codigo_produto LIKE "%'.$codigo_produto.'%" AND id_status = 2');

				$this->db
					->select("*")
					->from("ordem_servico")
					->where($where);
				break;

			case '4':
				$where = ('numero_ordem >='.$numero_inicial.' AND data_abertura >= "'.$data_inicial.'" 
				AND descricao_produto LIKE "%'.$descricao.'%" AND nota_fiscal LIKE "%'.$nota_fiscal.'%" 
				AND codigo_produto LIKE "%'.$codigo_produto.'%" AND id_status = 2');

				$this->db
					->select("*")
					->from("ordem_servico")
					->where($where);
				break;

			case '5':
				$where = ('numero_ordem >='.$numero_inicial.' AND numero_ordem <= '.$numero_final.' AND data_abertura <= "'.$data_final.'"
				AND descricao_produto LIKE "%'.$descricao.'%" AND nota_fiscal LIKE "%'.$nota_fiscal.'%" 
				AND codigo_produto LIKE "%'.$codigo_produto.'%" AND id_status = 2');

				$this->db
					->select("*")
					->from("ordem_servico")
					->where($where);
				break;

			case '6':
				$where = ('numero_ordem >='.$numero_inicial.' AND numero_ordem <= '.$numero_final.' AND data_abertura >= "'.$data_inicial.'" 
				AND descricao_produto LIKE "%'.$descricao.'%" AND nota_fiscal LIKE "%'.$nota_fiscal.'%" 
				AND codigo_produto LIKE "%'.$codigo_produto.'%" AND id_status = 2');

				$this->db
					->select("*")
					->from("ordem_servico")
					->where($where);
				break;

			case '7':
				$where = ('descricao_produto LIKE "%'.$descricao.'%" AND nota_fiscal LIKE "%'.$nota_fiscal.'%" 
				AND codigo_produto LIKE "%'.$codigo_produto.'%" AND id_status = 2');

				$this->db
					->select("*")
					->from("ordem_servico")
					->where($where);
				break;


			case '8':
				$where = ('numero_ordem >='.$numero_inicial.' AND numero_ordem <= '.$numero_final.' AND data_abertura >= "'.$data_inicial.'" 
				AND data_abertura <= "'.$data_final.'" AND nota_fiscal LIKE "%'.$nota_fiscal.'%" 
				AND codigo_produto LIKE "%'.$codigo_produto.'%" AND id_status = 2');

				$this->db
					->select("*")
					->from("ordem_servico")
					->where($where);
				break;

			case '9':
				$where = ('numero_ordem >='.$numero_inicial.' AND numero_ordem <= '.$numero_final.' AND data_abertura >= "'.$data_inicial.'" 
				AND data_abertura <= "'.$data_final.'" AND codigo_produto LIKE "%'.$codigo_produto.'%" AND id_status = 2');

				$this->db
					->select("*")
					->from("ordem_servico")
					->where($where);
				break;

			case '10':
				$where = ('numero_ordem >='.$numero_inicial.' AND numero_ordem <= '.$numero_final.' AND data_abertura >= "'.$data_inicial.'" 
				AND data_abertura <= "'.$data_final.'" AND id_status = 2');

				$this->db
					->select("*")
					->from("ordem_servico")
					->where($where);
				break;

			case '11':
				$where = ('numero_ordem >='.$numero_inicial.' AND descricao_produto LIKE "%'.$descricao.'%" AND id_status = 2');

				$this->db
					->select("*")
					->from("ordem_servico")
					->where($where);
				break;

			case '12':
				$where = ('numero_ordem >='.$numero_inicial.' AND numero_ordem <= '.$numero_final.' 
				AND descricao_produto LIKE "%'.$descricao.'%" AND id_status = 2');

				$this->db
					->select("*")
					->from("ordem_servico")
					->where($where);
				break;

			case '13':
				$where = ('numero_ordem >='.$numero_inicial.' AND numero_ordem <= '.$numero_final.' AND data_abertura >= "'.$data_inicial.'" 
				AND descricao_produto LIKE "%'.$descricao.'%" AND id_status = 2');

				$this->db
					->select("*")
					->from("ordem_servico")
					->where($where);
				break;

			case '14':
				$where = ('numero_ordem >='.$numero_inicial.' AND numero_ordem <= '.$numero_final.' AND data_abertura >= "'.$data_inicial.'" 
				AND data_abertura <= "'.$data_final.'" AND descricao_produto LIKE "%'.$descricao.'%" AND id_status = 2');

				$this->db
					->select("*")
					->from("ordem_servico")
					->where($where);
				break;

			case '15':
				$where = ('numero_ordem >='.$numero_inicial.' AND numero_ordem <= '.$numero_final.' AND data_abertura >= "'.$data_inicial.'" 
				AND data_abertura <= "'.$data_final.'" AND descricao_produto LIKE "%'.$descricao.'%" 
				AND nota_fiscal LIKE "%'.$nota_fiscal.'%" AND id_status = 2');

				$this->db
					->select("*")
					->from("ordem_servico")
					->where($where);
				break;

			case '16':
				$where = ('numero_ordem >='.$numero_inicial.' AND nota_fiscal LIKE "%'.$nota_fiscal.'%" AND id_status = 2');

				$this->db
					->select("*")
					->from("ordem_servico")
					->where($where);
				break;

			case '17':
				$where = ('numero_ordem >='.$numero_inicial.'  AND numero_ordem <= '.$numero_final.' 
				AND nota_fiscal LIKE "%'.$nota_fiscal.'%" AND id_status = 2');

				$this->db
					->select("*")
					->from("ordem_servico")
					->where($where);
				break;

			case '18':
				$where = ('numero_ordem >='.$numero_inicial.'  AND numero_ordem <= '.$numero_final.' AND data_abertura >= "'.$data_inicial.'"
				AND nota_fiscal LIKE "%'.$nota_fiscal.'%" AND id_status = 2');

				$this->db
					->select("*")
					->from("ordem_servico")
					->where($where);
				break;

			case '19':
				$where = ('numero_ordem >='.$numero_inicial.'  AND numero_ordem <= '.$numero_final.' AND data_abertura >= "'.$data_inicial.'"
				AND data_abertura <= "'.$data_final.'" AND nota_fiscal LIKE "%'.$nota_fiscal.'%" AND id_status = 2');

				$this->db
					->select("*")
					->from("ordem_servico")
					->where($where);
				break;

			case '20':
				$where = ('numero_ordem >='.$numero_inicial.' AND codigo_produto LIKE "%'.$codigo_produto.'%" AND id_status = 2');

				$this->db
					->select("*")
					->from("ordem_servico")
					->where($where);
				break;

			case '21':
				$where = ('descricao_produto LIKE "%'.$descricao.'%" AND id_status = 2');

				$this->db
					->select("*")
					->from("ordem_servico")
					->where($where);
				break;

			case '22':
				$where = ('nota_fiscal LIKE "%'.$nota_fiscal.'%" AND id_status = 2');

				$this->db
					->select("*")
					->from("ordem_servico")
					->where($where);
				break;

			case '23':
				$where = ('codigo_produto LIKE "%'.$codigo_produto.'%" AND id_status = 2');

				$this->db
					->select("*")
					->from("ordem_servico")
					->where($where);
				break;

			case '24':
				$where = ('numero_ordem >= '.$numero_inicial.' AND id_status = 2');

				$this->db
					->select("*")
					->from("ordem_servico")
					->where($where);
				break;

			case '25':
				$where = ('numero_ordem <= '.$numero_final.' AND id_status = 2');

				$this->db
					->select("*")
					->from("ordem_servico")
					->where($where);
				break;

			case '26':
				$where = ('data_abertura >= "'.$data_inicial.'" AND id_status = 2');

				$this->db
					->select("*")
					->from("ordem_servico")
					->where($where);
				break;

			case '27':
				$where = ('data_abertura <= '.$data_final.' AND id_status = 2');

				$this->db
					->select("*")
					->from("ordem_servico")
					->where($where);
				break;

			case '28':
				$where = ('numero_ordem >= '.$numero_inicial.' AND numero_ordem <= '.$numero_final.' AND id_status = 2');

				$this->db
					->select("*")
					->from("ordem_servico")
					->where($where);
				break;

			case '29':
				$where = ('data_abertura >= "'.$data_inicial.'" AND data_abertura <= "'.$data_final.'" AND id_status = 2');

				$this->db
					->select("*")
					->from("ordem_servico")
					->where($where);
				break;

			case '30':
				$where = ('numero_ordem >='.$numero_inicial.' AND numero_ordem <= '.$numero_final.' AND data_abertura >= "'.$data_inicial.'" 
				AND data_abertura <= "'.$data_final.'" AND descricao_produto LIKE "%'.$descricao.'%" AND nota_fiscal LIKE "%'.$nota_fiscal.'%" 
				AND codigo_produto LIKE "%'.$codigo_produto.'%" AND id_status = 2');

				$this->db
					->select("*")
					->from("ordem_servico")
					->where($where);
				break;

			default:
				$this->db
					->select("*")
					->from("ordem_servico")
					->where("id_status", 2);
				break;

		}

		$result = $this->db->get()->result_array();


		return $result;

	}

	public function filtro_ordem_aberta ($option,$numero_inicial,$numero_final,$data_inicial,$data_final,$descricao,
										 $nota_fiscal,$codigo_produto) {

		switch ($option) {
			case '1':
				$where = ('numero_ordem <='.$numero_final.' AND data_abertura >= "'.$data_inicial.'" AND data_abertura <= "'.$data_final.'" 
				AND descricao_produto LIKE "%'.$descricao.'%" AND nota_fiscal LIKE "%'.$nota_fiscal.'%" 
				AND codigo_produto LIKE "%'.$codigo_produto.'%" AND id_status = 1');

				$this->db
					->select("*")
					->from("ordem_servico")
					->where($where);
				break;

			case '2':
				$where = ('numero_ordem >='.$numero_inicial.' AND data_abertura >= "'.$data_inicial.'" AND data_abertura <= "'.$data_final.'" 
				AND descricao_produto LIKE "%'.$descricao.'%" AND nota_fiscal LIKE "%'.$nota_fiscal.'%" 
				AND codigo_produto LIKE "%'.$codigo_produto.'%" AND id_status = 1');

				$this->db
					->select("*")
					->from("ordem_servico")
					->where($where);
				break;

			case '3':
				$where = ('numero_ordem <='.$numero_final.' AND data_abertura <= "'.$data_final.'" 
				AND descricao_produto LIKE "%'.$descricao.'%" AND nota_fiscal LIKE "%'.$nota_fiscal.'%" 
				AND codigo_produto LIKE "%'.$codigo_produto.'%" AND id_status = 1');

				$this->db
					->select("*")
					->from("ordem_servico")
					->where($where);
				break;

			case '4':
				$where = ('numero_ordem >='.$numero_inicial.' AND data_abertura >= "'.$data_inicial.'" 
				AND descricao_produto LIKE "%'.$descricao.'%" AND nota_fiscal LIKE "%'.$nota_fiscal.'%" 
				AND codigo_produto LIKE "%'.$codigo_produto.'%" AND id_status = 1');

				$this->db
					->select("*")
					->from("ordem_servico")
					->where($where);
				break;

			case '5':
				$where = ('numero_ordem >='.$numero_inicial.' AND numero_ordem <= '.$numero_final.' AND data_abertura <= "'.$data_final.'"
				AND descricao_produto LIKE "%'.$descricao.'%" AND nota_fiscal LIKE "%'.$nota_fiscal.'%" 
				AND codigo_produto LIKE "%'.$codigo_produto.'%" AND id_status = 1');

				$this->db
					->select("*")
					->from("ordem_servico")
					->where($where);
				break;

			case '6':
				$where = ('numero_ordem >='.$numero_inicial.' AND numero_ordem <= '.$numero_final.' AND data_abertura >= "'.$data_inicial.'" 
				AND descricao_produto LIKE "%'.$descricao.'%" AND nota_fiscal LIKE "%'.$nota_fiscal.'%" 
				AND codigo_produto LIKE "%'.$codigo_produto.'%" AND id_status = 1');

				$this->db
					->select("*")
					->from("ordem_servico")
					->where($where);
				break;

			case '7':
				$where = ('descricao_produto LIKE "%'.$descricao.'%" AND nota_fiscal LIKE "%'.$nota_fiscal.'%" 
				AND codigo_produto LIKE "%'.$codigo_produto.'%" AND id_status = 1');

				$this->db
					->select("*")
					->from("ordem_servico")
					->where($where);
				break;


			case '8':
				$where = ('numero_ordem >='.$numero_inicial.' AND numero_ordem <= '.$numero_final.' AND data_abertura >= "'.$data_inicial.'" 
				AND data_abertura <= "'.$data_final.'" AND nota_fiscal LIKE "%'.$nota_fiscal.'%" 
				AND codigo_produto LIKE "%'.$codigo_produto.'%" AND id_status = 1');

				$this->db
					->select("*")
					->from("ordem_servico")
					->where($where);
				break;

			case '9':
				$where = ('numero_ordem >='.$numero_inicial.' AND numero_ordem <= '.$numero_final.' AND data_abertura >= "'.$data_inicial.'" 
				AND data_abertura <= "'.$data_final.'" AND codigo_produto LIKE "%'.$codigo_produto.'%" AND id_status = 1');

				$this->db
					->select("*")
					->from("ordem_servico")
					->where($where);
				break;

			case '10':
				$where = ('numero_ordem >='.$numero_inicial.' AND numero_ordem <= '.$numero_final.' AND data_abertura >= "'.$data_inicial.'" 
				AND data_abertura <= "'.$data_final.'" AND id_status = 1');

				$this->db
					->select("*")
					->from("ordem_servico")
					->where($where);
				break;

			case '11':
				$where = ('numero_ordem >='.$numero_inicial.' AND descricao_produto LIKE "%'.$descricao.'%" AND id_status = 1');

				$this->db
					->select("*")
					->from("ordem_servico")
					->where($where);
				break;

			case '12':
				$where = ('numero_ordem >='.$numero_inicial.' AND numero_ordem <= '.$numero_final.' 
				AND descricao_produto LIKE "%'.$descricao.'%" AND id_status = 1');

				$this->db
					->select("*")
					->from("ordem_servico")
					->where($where);
				break;

			case '13':
				$where = ('numero_ordem >='.$numero_inicial.' AND numero_ordem <= '.$numero_final.' AND data_abertura >= "'.$data_inicial.'" 
				AND descricao_produto LIKE "%'.$descricao.'%" AND id_status = 1');

				$this->db
					->select("*")
					->from("ordem_servico")
					->where($where);
				break;

			case '14':
				$where = ('numero_ordem >='.$numero_inicial.' AND numero_ordem <= '.$numero_final.' AND data_abertura >= "'.$data_inicial.'" 
				AND data_abertura <= "'.$data_final.'" AND descricao_produto LIKE "%'.$descricao.'%" AND id_status = 1');

				$this->db
					->select("*")
					->from("ordem_servico")
					->where($where);
				break;

			case '15':
				$where = ('numero_ordem >='.$numero_inicial.' AND numero_ordem <= '.$numero_final.' AND data_abertura >= "'.$data_inicial.'" 
				AND data_abertura <= "'.$data_final.'" AND descricao_produto LIKE "%'.$descricao.'%" 
				AND nota_fiscal LIKE "%'.$nota_fiscal.'%" AND id_status = 1');

				$this->db
					->select("*")
					->from("ordem_servico")
					->where($where);
				break;

			case '16':
				$where = ('numero_ordem >='.$numero_inicial.' AND nota_fiscal LIKE "%'.$nota_fiscal.'%" AND id_status = 1');

				$this->db
					->select("*")
					->from("ordem_servico")
					->where($where);
				break;

			case '17':
				$where = ('numero_ordem >='.$numero_inicial.'  AND numero_ordem <= '.$numero_final.' 
				AND nota_fiscal LIKE "%'.$nota_fiscal.'%" AND id_status = 1');

				$this->db
					->select("*")
					->from("ordem_servico")
					->where($where);
				break;

			case '18':
				$where = ('numero_ordem >='.$numero_inicial.'  AND numero_ordem <= '.$numero_final.' AND data_abertura >= "'.$data_inicial.'"
				AND nota_fiscal LIKE "%'.$nota_fiscal.'%" AND id_status = 1');

				$this->db
					->select("*")
					->from("ordem_servico")
					->where($where);
				break;

			case '19':
				$where = ('numero_ordem >='.$numero_inicial.'  AND numero_ordem <= '.$numero_final.' AND data_abertura >= "'.$data_inicial.'"
				AND data_abertura <= "'.$data_final.'" AND nota_fiscal LIKE "%'.$nota_fiscal.'%" AND id_status = 1');

				$this->db
					->select("*")
					->from("ordem_servico")
					->where($where);
				break;

			case '20':
				$where = ('numero_ordem >='.$numero_inicial.' AND codigo_produto LIKE "%'.$codigo_produto.'%" AND id_status = 1');

				$this->db
					->select("*")
					->from("ordem_servico")
					->where($where);
				break;

			case '21':
				$where = ('descricao_produto LIKE "%'.$descricao.'%" AND id_status = 1');

				$this->db
					->select("*")
					->from("ordem_servico")
					->where($where);
				break;

			case '22':
				$where = ('nota_fiscal LIKE "%'.$nota_fiscal.'%" AND id_status = 1');

				$this->db
					->select("*")
					->from("ordem_servico")
					->where($where);
				break;

			case '23':
				$where = ('codigo_produto LIKE "%'.$codigo_produto.'%" AND id_status = 1');

				$this->db
					->select("*")
					->from("ordem_servico")
					->where($where);
				break;

			case '24':
				$where = ('numero_ordem >= '.$numero_inicial.' AND id_status = 1');

				$this->db
					->select("*")
					->from("ordem_servico")
					->where($where);
				break;

			case '25':
				$where = ('numero_ordem <= '.$numero_final.' AND id_status = 1');

				$this->db
					->select("*")
					->from("ordem_servico")
					->where($where);
				break;

			case '26':
				$where = ('data_abertura >= "'.$data_inicial.'" AND id_status = 1');

				$this->db
					->select("*")
					->from("ordem_servico")
					->where($where);
				break;

			case '27':
				$where = ('data_abertura <= '.$data_final.' AND id_status = 1');

				$this->db
					->select("*")
					->from("ordem_servico")
					->where($where);
				break;

			case '28':
				$where = ('numero_ordem >= '.$numero_inicial.' AND numero_ordem <= '.$numero_final.' AND id_status = 1');

				$this->db
					->select("*")
					->from("ordem_servico")
					->where($where);
				break;

			case '29':
				$where = ('data_abertura >= "'.$data_inicial.'" AND data_abertura <= "'.$data_final.'" AND id_status = 1');

				$this->db
					->select("*")
					->from("ordem_servico")
					->where($where);
				break;

			case '30':
				$where = ('numero_ordem >='.$numero_inicial.' AND numero_ordem <= '.$numero_final.' AND data_abertura >= "'.$data_inicial.'" 
				AND data_abertura <= "'.$data_final.'" AND descricao_produto LIKE "%'.$descricao.'%" AND nota_fiscal LIKE "%'.$nota_fiscal.'%" 
				AND codigo_produto LIKE "%'.$codigo_produto.'%" AND id_status = 1');

				$this->db
					->select("*")
					->from("ordem_servico")
					->where($where);
				break;

			default:
				$this->db
					->select("*")
					->from("ordem_servico")
					->where("id_status", 1);
				break;

		}

		$result = $this->db->get()->result_array();


		return $result;

	}

	public function carregarOrdem($idOrdem) {

		$this->db
			->select('*')
			->from('ordem_servico')
			->join('cliente','ordem_servico.id_cliente = cliente.id_cliente')
			->where('id_ordem',$idOrdem);

		return $this->db->get();;

	}

	public function updateOrdem($id_ordem,$numero_ordem,$data_abertura,$nota_fiscal,$codigo_produto,$data_compra,$descricao_produto,$numero_serie,
								$voltagem,$defeito_reclamado,$idcliente,$valor_os,$data_prazo,$tecnico,$id_status,$observacao) {

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
			'observacao_tecnico'=>$observacao,
			'id_tecnico'=>$tecnico,
			'id_status'=>$id_status,
			'id_cliente' => $idcliente,
			'prazo_ordem'=>$data_prazo,
			'valor_ordem'=>$valor_os
		);

		$this->db->where('id_ordem', $id_ordem);
		$this->db->update('ordem_servico', $data);


	}

	public function carregarTecnicos() {

		$this->db
			->select('id_usuario,nome_completo')
			->from('usuario')
			->where('id_departamento',2)
			->or_where('id_departamento',1);

		return $this->db->get()->result_array();;

	}

	public function carregarStatus() {

		$this->db
			->select('*')
			->from('status_os');

		return $this->db->get()->result_array();

	}

	public function excluir_ordem($id) {

		$this->db->where('id_ordem', $id);
		$this->db->delete('ordem_servico');


	}


}
?>

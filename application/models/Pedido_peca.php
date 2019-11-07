<?php


class Pedido_peca extends CI_Model
{

	public function __construct() {
		parent::__construct();
	}

	public function nova_peca($descricao,$codigo,$valor,$quantidade,$id_autorizada) {

		$data = array(
			'descricao_peca'=>$descricao,
			'valor_peca_unidade'=>$valor,
			'quantidade_peca'=>$quantidade,
			'codigo_peca'=>$codigo,
			'id_autorizada'=>$id_autorizada
		);

		$this->db->insert('peca',$data);

	}

	public function pecas($id_autorizada) {

		$this->db
			->select('*')
			->from('peca')
			->where('id_autorizada',$id_autorizada);

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

	public function fornecedores($id_autorizada) {
		$this->db
			->select("*")
			->from("fornecedor")
			->where('id_autorizada',$id_autorizada);

		return $this->db->get()->result_array();
	}

	public function pedidos ($id_autorizada) {

		$this->db
			->select('*')
			->from('pedido_peca')
			->join('fornecedor','pedido_peca.id_fornecedor = fornecedor.id_fornecedor')
			->where('pedido_peca.id_autorizada',$id_autorizada);

		return $this->db->get()->result_array();

	}

	public function info_fornecedor($id_fornecedor) {
		$this->db
			->select("*")
			->from("fornecedor")
			->where("id_fornecedor", $id_fornecedor);

		return $this->db->get();
	}

	public function UltimoPedido($id_autorizada) {
		$this->db
			->select("num_pedido")
			->from("pedido_peca")
			->where("id_autorizada",$id_autorizada)
			->order_by("num_pedido DESC")
			->limit(1);

		$query = $this->db->get();

		if ($query->num_rows() > 0) {
			return $query->row()->num_pedido;
		}
		return false;
	}

	public function filtro_pedido ($option,$numero_inicial,$numero_final,$data_inicial,$data_final,$assunto,
								   $fornecedor,$id_autorizada) {

		switch ($option) {
			case '1':
				$where = ('pedido_peca.id_autorizada = '.$id_autorizada.' AND num_pedido >='.$numero_inicial);

				$this->db
					->select("*")
					->from("pedido_peca")
					->join("fornecedor","pedido_peca.id_fornecedor = fornecedor.id_fornecedor")
					->where($where);
				break;

			case '2':
				$where = ('pedido_peca.id_autorizada = '.$id_autorizada.' AND num_pedido >='.$numero_final);

				$this->db
					->select("*")
					->from("pedido_peca")
					->join("fornecedor","pedido_peca.id_fornecedor = fornecedor.id_fornecedor")
					->where($where);
				break;

			case '3':
				$where = ('pedido_peca.id_autorizada = '.$id_autorizada.' AND data_pedido <= "'.$data_inicial.'"');

				$this->db
					->select("*")
					->from("pedido_peca")
					->join("fornecedor","pedido_peca.id_fornecedor = fornecedor.id_fornecedor")
					->where($where);
				break;

			case '4':
				$where = ('pedido_peca.id_autorizada = '.$id_autorizada.' AND data_pedido <= "'.$data_final.'"');

				$this->db
					->select("*")
					->from("pedido_peca")
					->join("fornecedor","pedido_peca.id_fornecedor = fornecedor.id_fornecedor")
					->where($where);
				break;

			case '5':
				$where = ('pedido_peca.id_autorizada = '.$id_autorizada.' AND assunto_pedido LIKE "%'.$assunto.'%"');

				$this->db
					->select("*")
					->from("pedido_peca")
					->join("fornecedor","pedido_peca.id_fornecedor = fornecedor.id_fornecedor")
					->where($where);
				break;

			case '6':
				$where = ('pedido_peca.id_autorizada = '.$id_autorizada.' AND pedido_peca.id_fornecedor = '.$fornecedor);

				$this->db
					->select("*")
					->from("pedido_peca")
					->join("fornecedor","pedido_peca.id_fornecedor = fornecedor.id_fornecedor")
					->where($where);
				break;

			case '7':
				$where = ('pedido_peca.id_autorizada = '.$id_autorizada.' AND num_pedido >='.$numero_inicial.' AND num_pedido <= '.$numero_final);

				$this->db
					->select("*")
					->from("pedido_peca")
					->join("fornecedor","pedido_peca.id_fornecedor = fornecedor.id_fornecedor")
					->where($where);
				break;

			case '8':
				$where = ('pedido_peca.id_autorizada = '.$id_autorizada.' AND num_pedido >='.$numero_inicial.' AND num_pedido <= '.$numero_final.' AND data_pedido >= "'.$data_inicial.'"');

				$this->db
					->select("*")
					->from("pedido_peca")
					->join("fornecedor","pedido_peca.id_fornecedor = fornecedor.id_fornecedor")
					->where($where);
				break;


			case '9':
				$where = ('pedido_peca.id_autorizada = '.$id_autorizada.' AND num_pedido >='.$numero_inicial.' AND num_pedido <= '.$numero_final.' AND data_pedido >= "'.$data_inicial.'" AND data_pedido <= "'.$data_final.'"');

				$this->db
					->select("*")
					->from("pedido_peca")
					->join("fornecedor","pedido_peca.id_fornecedor = fornecedor.id_fornecedor")
					->where($where);
				break;

			case '10':
				$where = ('pedido_peca.id_autorizada = '.$id_autorizada.' AND num_pedido >='.$numero_inicial.' AND num_pedido <= '.$numero_final.' AND data_pedido >= "'.$data_inicial.'" AND data_pedido <= "'.$data_final.'" AND assunto_pedido LIKE "%'.$assunto.'%"');

				$this->db
					->select("*")
					->from("pedido_peca")
					->join("fornecedor","pedido_peca.id_fornecedor = fornecedor.id_fornecedor")
					->where($where);
				break;

			case '11':
				$where = ('pedido_peca.id_autorizada = '.$id_autorizada.' AND num_pedido >='.$numero_inicial.' AND num_pedido <= '.$numero_final.' AND data_pedido >= "'.$data_inicial.'" AND data_pedido <= "'.$data_final.'" AND assunto_pedido LIKE "%'.$assunto.'%" AND pedido_peca.id_fornecedor = '.$fornecedor);

				$this->db
					->select("*")
					->from("pedido_peca")
					->join("fornecedor","pedido_peca.id_fornecedor = fornecedor.id_fornecedor")
					->where($where);
				break;

			case '12':
				$where = ('pedido_peca.id_autorizada = '.$id_autorizada.' AND num_pedido >='.$numero_inicial.' AND data_pedido >= "'.$data_inicial.'"');

				$this->db
					->select("*")
					->from("pedido_peca")
					->join("fornecedor","pedido_peca.id_fornecedor = fornecedor.id_fornecedor")
					->where($where);
				break;

			case '13':
				$where = ('pedido_peca.id_autorizada = '.$id_autorizada.' AND num_pedido >='.$numero_inicial.' AND data_pedido >= "'.$data_inicial.'" AND data_pedido <= "'.$data_final.'"');

				$this->db
					->select("*")
					->from("pedido_peca")
					->join("fornecedor","pedido_peca.id_fornecedor = fornecedor.id_fornecedor")
					->where($where);
				break;

			case '14':
				$where = ('pedido_peca.id_autorizada = '.$id_autorizada.' AND num_pedido >='.$numero_inicial.' AND data_pedido >= "'.$data_inicial.'" AND data_pedido <= "'.$data_final.'" AND assunto_pedido LIKE "%'.$assunto.'%"');

				$this->db
					->select("*")
					->from("pedido_peca")
					->join("fornecedor","pedido_peca.id_fornecedor = fornecedor.id_fornecedor")
					->where($where);
				break;

			case '15':
				$where = ('pedido_peca.id_autorizada = '.$id_autorizada.' AND num_pedido >='.$numero_inicial.' AND data_pedido >= "'.$data_inicial.'" 
				AND data_pedido <= "'.$data_final.'" AND assunto_pedido LIKE "%'.$assunto.'%" AND pedido_peca.id_fornecedor = '.$fornecedor);

				$this->db
					->select("*")
					->from("pedido_peca")
					->join("fornecedor","pedido_peca.id_fornecedor = fornecedor.id_fornecedor")
					->where($where);
				break;

			case '16':
				$where = ('pedido_peca.id_autorizada = '.$id_autorizada.' AND num_pedido >='.$numero_inicial.' AND data_pedido <= "'.$data_final.'"');

				$this->db
					->select("*")
					->from("pedido_peca")
					->join("fornecedor","pedido_peca.id_fornecedor = fornecedor.id_fornecedor")
					->where($where);
				break;

			case '17':
				$where = ('pedido_peca.id_autorizada = '.$id_autorizada.' AND num_pedido >='.$numero_inicial.' AND data_pedido <= "'.$data_final.'" 
				AND assunto_pedido LIKE "%'.$assunto.'%"');

				$this->db
					->select("*")
					->from("pedido_peca")
					->join("fornecedor","pedido_peca.id_fornecedor = fornecedor.id_fornecedor")
					->where($where);
				break;

			case '18':
				$where = ('pedido_peca.id_autorizada = '.$id_autorizada.' AND num_pedido >='.$numero_inicial.'  AND data_pedido <= "'.$data_final.'" 
				AND assunto_pedido LIKE "%'.$assunto.'%" AND pedido_peca.id_fornecedor = '.$fornecedor);

				$this->db
					->select("*")
					->from("pedido_peca")
					->join("fornecedor","pedido_peca.id_fornecedor = fornecedor.id_fornecedor")
					->where($where);
				break;

			case '19':
				$where = ('pedido_peca.id_autorizada = '.$id_autorizada.' AND num_pedido >='.$numero_inicial.' AND assunto_pedido LIKE "%'.$assunto.'%"');

				$this->db
					->select("*")
					->from("pedido_peca")
					->join("fornecedor","pedido_peca.id_fornecedor = fornecedor.id_fornecedor")
					->where($where);
				break;

			case '20':
				$where = ('pedido_peca.id_autorizada = '.$id_autorizada.' AND num_pedido >='.$numero_inicial.' AND assunto_pedido LIKE "%'.$assunto.'%" AND pedido_peca.id_fornecedor = '.$fornecedor);

				$this->db
					->select("*")
					->from("pedido_peca")
					->join("fornecedor","pedido_peca.id_fornecedor = fornecedor.id_fornecedor")
					->where($where);
				break;

			case '21':
				$where = ('pedido_peca.id_autorizada = '.$id_autorizada.' AND num_pedido >='.$numero_inicial.' AND pedido_peca.id_fornecedor = '.$fornecedor);

				$this->db
					->select("*")
					->from("pedido_peca")
					->join("fornecedor","pedido_peca.id_fornecedor = fornecedor.id_fornecedor")
					->where($where);
				break;

			case '22':
				$where = ('pedido_peca.id_autorizada = '.$id_autorizada.' AND num_pedido <='.$numero_final.'  AND data_pedido >= "'.$data_inicial.'"');

				$this->db
					->select("*")
					->from("pedido_peca")
					->join("fornecedor","pedido_peca.id_fornecedor = fornecedor.id_fornecedor")
					->where($where);
				break;

			case '23':
				$where = ('pedido_peca.id_autorizada = '.$id_autorizada.' AND num_pedido <='.$numero_final.'  AND data_pedido >= "'.$data_inicial.'"
				AND data_pedido <= "'.$data_final.'"');

				$this->db
					->select("*")
					->from("pedido_peca")
					->join("fornecedor","pedido_peca.id_fornecedor = fornecedor.id_fornecedor")
					->where($where);
				break;

			case '24':
				$where = ('pedido_peca.id_autorizada = '.$id_autorizada.' AND num_pedido <='.$numero_final.'  AND data_pedido >= "'.$data_inicial.'"
				AND data_pedido <= "'.$data_final.'" AND assunto_pedido LIKE "%'.$assunto.'%"');

				$this->db
					->select("*")
					->from("pedido_peca")
					->join("fornecedor","pedido_peca.id_fornecedor = fornecedor.id_fornecedor")
					->where($where);
				break;

			case '25':
				$where = ('pedido_peca.id_autorizada = '.$id_autorizada.' AND num_pedido <='.$numero_final.'  AND data_pedido >= "'.$data_inicial.'"
				AND data_pedido <= "'.$data_final.'" AND assunto_pedido LIKE "%'.$assunto.'%" AND pedido_peca.id_fornecedor ='.$fornecedor);

				$this->db
					->select("*")
					->from("pedido_peca")
					->join("fornecedor","pedido_peca.id_fornecedor = fornecedor.id_fornecedor")
					->where($where);
				break;

			case '26':
				$where = ('pedido_peca.id_autorizada = '.$id_autorizada.' AND data_pedido >= "'.$data_inicial.'" AND data_pedido <= "'.$data_final.'"');

				$this->db
					->select("*")
					->from("pedido_peca")
					->join("fornecedor","pedido_peca.id_fornecedor = fornecedor.id_fornecedor")
					->where($where);
				break;

			case '27':
				$where = ('pedido_peca.id_autorizada = '.$id_autorizada.' AND data_pedido >= "'.$data_inicial.'" AND data_pedido <= "'.$data_final.'"
				AND assunto_pedido LIKE "%'.$assunto.'%"');

				$this->db
					->select("*")
					->from("pedido_peca")
					->join("fornecedor","pedido_peca.id_fornecedor = fornecedor.id_fornecedor")
					->where($where);
				break;

			case '28':
				$where = ('pedido_peca.id_autorizada = '.$id_autorizada.' AND data_pedido >= "'.$data_inicial.'" AND data_pedido <= "'.$data_final.'"
				AND assunto_pedido LIKE "%'.$assunto.'%" AND pedido_peca.id_fornecedor = '.$fornecedor);

				$this->db
					->select("*")
					->from("pedido_peca")
					->join("fornecedor","pedido_peca.id_fornecedor = fornecedor.id_fornecedor")
					->where($where);
				break;

			case '29':
				$where = ('pedido_peca.id_autorizada = '.$id_autorizada.' AND data_pedido <= "'.$data_final.'" AND assunto_pedido LIKE "%'.$assunto.'%"');

				$this->db
					->select("*")
					->from("pedido_peca")
					->join("fornecedor","pedido_peca.id_fornecedor = fornecedor.id_fornecedor")
					->where($where);
				break;

			case '30':
				$where = ('pedido_peca.id_autorizada = '.$id_autorizada.' AND data_pedido <= "'.$data_final.'" AND assunto_pedido LIKE "%'.$assunto.'%"
				AND pedido_peca.id_fornecedor = '.$id_fornecedor);

				$this->db
					->select("*")
					->from("pedido_peca")
					->join("fornecedor","pedido_peca.id_fornecedor = fornecedor.id_fornecedor")
					->where($where);
				break;

			case '31':
				$where = ('pedido_peca.id_autorizada = '.$id_autorizada.' AND assunto_pedido LIKE "%'.$assunto.'%" AND pedido_peca.id_fornecedor = '.$fornecedor);

				$this->db
					->select("*")
					->from("pedido_peca")
					->join("fornecedor","pedido_peca.id_fornecedor = fornecedor.id_fornecedor")
					->where($where);
				break;

			case '32':
				$where = ('pedido_peca.id_autorizada = '.$id_autorizada.' AND num_pedido >='.$numero_inicial.' AND data_pedido <= "'.$data_final.'"');

				$this->db
					->select("*")
					->from("pedido_peca")
					->join("fornecedor","pedido_peca.id_fornecedor = fornecedor.id_fornecedor")
					->where($where);
				break;

			case '33':
				$where = ('pedido_peca.id_autorizada = '.$id_autorizada.' AND num_pedido >='.$numero_inicial.' AND assunto_pedido LIKE "%'.$assunto.'%"');

				$this->db
					->select("*")
					->from("pedido_peca")
					->join("fornecedor","pedido_peca.id_fornecedor = fornecedor.id_fornecedor")
					->where($where);
				break;

			case '34':
				$where = ('pedido_peca.id_autorizada = '.$id_autorizada.' AND num_pedido >='.$numero_inicial.' AND pedido_peca.id_fornecedor ='.$fornecedor);

				$this->db
					->select("*")
					->from("pedido_peca")
					->join("fornecedor","pedido_peca.id_fornecedor = fornecedor.id_fornecedor")
					->where($where);
				break;

			case '35':
				$where = ('pedido_peca.id_autorizada = '.$id_autorizada.' AND num_pedido <='.$numero_final.' AND data_pedido <= "'.$data_final.'"');

				$this->db
					->select("*")
					->from("pedido_peca")
					->join("fornecedor","pedido_peca.id_fornecedor = fornecedor.id_fornecedor")
					->where($where);
				break;

			case '36':
				$where = ('pedido_peca.id_autorizada = '.$id_autorizada.' AND num_pedido <='.$numero_final.' AND assunto_pedido LIKE "%'.$assunto.'%"');

				$this->db
					->select("*")
					->from("pedido_peca")
					->join("fornecedor","pedido_peca.id_fornecedor = fornecedor.id_fornecedor")
					->where($where);
				break;

			case '37':
				$where = ('pedido_peca.id_autorizada = '.$id_autorizada.' AND num_pedido <='.$numero_final.' AND pedido_peca.id_fornecedor ='.$fornecedor);

				$this->db
					->select("*")
					->from("pedido_peca")
					->join("fornecedor","pedido_peca.id_fornecedor = fornecedor.id_fornecedor")
					->where($where);
				break;

			case '38':
				$where = ('pedido_peca.id_autorizada = '.$id_autorizada.' AND data_pedido >= "'.$data_inicial.'" AND assunto_pedido LIKE "%'.$assunto.'%"');

				$this->db
					->select("*")
					->from("pedido_peca")
					->join("fornecedor","pedido_peca.id_fornecedor = fornecedor.id_fornecedor")
					->where($where);
				break;

			case '39':
				$where = ('pedido_peca.id_autorizada = '.$id_autorizada.' AND data_pedido >= "'.$data_inicial.'" AND pedido_peca.id_fornecedor ='.$fornecedor);

				$this->db
					->select("*")
					->from("pedido_peca")
					->join("fornecedor","pedido_peca.id_fornecedor = fornecedor.id_fornecedor")
					->where($where);
				break;

			case '40':
				$where = ('pedido_peca.id_autorizada = '.$id_autorizada.' AND data_pedido <= "'.$data_final.'" AND pedido_peca.id_fornecedor ='.$fornecedor);

				$this->db
					->select("*")
					->from("pedido_peca")
					->join("fornecedor","pedido_peca.id_fornecedor = fornecedor.id_fornecedor")
					->where($where);
				break;

			default:
				$this->db
					->select("*")
					->from("pedido_peca")
					->join("fornecedor","pedido_peca.id_fornecedor = fornecedor.id_fornecedor")
					->where("id_status", 1);
				break;

		}

		$result = $this->db->get()->result_array();


		return $result;

	}

	public function filtro_estoque($option,$descricao,$codigo,$quantidade,$valor,$id_autorizada) {

		switch ($option) {
			case '1':
				$where = ('id_autorizada = '.$id_autorizada.' AND descricao_peca LIKE "%'.$descricao.'%"');

				$this->db
					->select("*")
					->from("peca")
					->where($where);
				break;

			case '2':
				$where = ('id_autorizada = '.$id_autorizada.' AND codigo_peca LIKE "%'.$codigo.'%"');

				$this->db
					->select("*")
					->from("peca")
					->where($where);
				break;

			case '3':
				$where = ('id_autorizada = '.$id_autorizada.' AND quantidade_peca ='.$quantidade);

				$this->db
					->select("*")
					->from("peca")
					->where($where);
				break;

			case '4':
				$where = ('id_autorizada = '.$id_autorizada.' AND valor_peca_unidade ='.$valor);

				$this->db
					->select("*")
					->from("peca")
					->where($where);
				break;

			case '5':
				$where = ('id_autorizada = '.$id_autorizada.' AND descricao_peca LIKE "%'.$descricao.'%" AND codigo_peca LIKE "%'.$codigo.'%"');

				$this->db
					->select("*")
					->from("peca")
					->where($where);
				break;

			case '6':
				$where = ('id_autorizada = '.$id_autorizada.' AND descricao_peca LIKE "%'.$descricao.'%" AND quantidade_peca ='.$quantidade);

				$this->db
					->select("*")
					->from("peca")
					->where($where);
				break;

			case '7':
				$where = ('id_autorizada = '.$id_autorizada.' AND descricao_peca LIKE "%'.$descricao.'%" AND valor_peca_unidade ='.$valor);

				$this->db
					->select("*")
					->from("peca")
					->where($where);
				break;

			case '8':
				$where = ('id_autorizada = '.$id_autorizada.' AND codigo_peca LIKE "%'.$codigo.'%" AND quantidade_peca ='.$quantidade);

				$this->db
					->select("*")
					->from("peca")
					->where($where);
				break;

			case '9':
				$where = ('id_autorizada = '.$id_autorizada.' AND codigo_peca LIKE "%'.$codigo.'%" AND valor_peca_unidade ='.$valor);

				$this->db
					->select("*")
					->from("peca")
					->where($where);
				break;

			case '10':
				$where = ('id_autorizada = '.$id_autorizada.' AND quantidade_peca ='.$quantidade.' AND valor_peca_unidade ='.$valor);

				$this->db
					->select("*")
					->from("peca")
					->where($where);
				break;

			case '11':
				$where = ('id_autorizada = '.$id_autorizada.' AND descricao_peca LIKE "%'.$descricao.'%" AND codigo_peca LIKE "%'.$codigo.'%" AND quantidade_peca ='.$quantidade.' AND valor_peca_unidade ='.$valor);

				$this->db
					->select("*")
					->from("peca")
					->where($where);
				break;

			default:
				$this->db
					->select("*")
					->from("peca")
					->where("id_autorizada", $id_autorizada);
				break;

		}

		$result = $this->db->get()->result_array();


		return $result;


	}

}

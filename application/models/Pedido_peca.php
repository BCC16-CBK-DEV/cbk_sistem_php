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

	public function adicionar_pedido($assunto,$data,$fornecedor,$array,$id_autorizada) {
		$numero_pedido = (int)$this->UltimoPedido($id_autorizada);
		$numero_pedido++;

		$data = array(
			'num_pedido'=>$numero_pedido,
			'assunto_pedido'=>$assunto,
			'data_pedido'=>$data,
			'id_fornecedor'=>$fornecedor,
			'id_autorizada'=>$id_autorizada
		);

		$this->db->insert('pedido_peca',$data);

		for($i = 0; $i < count($array); $i++) {
			$query = $this->db->query('INSERT INTO pedido_peca_item (id_peca,id_pedido,qtd_peca_pedido) VALUES (
			'.$array[$i][0].',(SELECT MAX(id_pedido_peca) FROM pedido_peca),'.$array[$i][1].');');

			//return $query;
		}
	}

	public function pedidos ($id_autorizada) {

		$this->db
			->select('*')
			->from('pedido_peca')
			->join('fornecedor','pedido_peca.id_fornecedor = fornecedor.id_fornecedor')
			->where('pedido_peca.id_autorizada',$id_autorizada);

		return $this->db->get()->result_array();

	}


	public function pecas_pedido ($id_pedido) {
		$this->db
			->select('*')
			->from('pedido_peca_item')
			->join('peca','pedido_peca_item.id_peca = peca.id_peca')
			->where('id_pedido',$id_pedido);

		return $this->db->get()->result_array();

	}

	public function carregar_pedido ($id_pedido) {
		$this->db
			->select('*')
			->from('pedido_peca')
			->join('status_pedido','status_pedido.id_status_pedido = pedido_peca.id_status_pedido')
			->where('id_pedido_peca',$id_pedido);

		return $this->db->get();

	}

	public function updatePedido($id_pedido,$assunto,$data,$id_fornecedor) {

		$data = array(
			'assunto_pedido'=>$assunto,
			'data_pedido' => $data,
			'id_fornecedor' => $id_fornecedor
		);

		$this->db->where('id_pedido_peca', $id_pedido);
		$this->db->update('pedido_peca', $data);

	}

	public function insertPecaPedido($id_pedido,$id_peca,$quantidade) {

		$data = array(
			'id_pedido'=>$id_pedido,
			'id_peca'=>$id_peca,
			'qtd_peca_pedido'=>$quantidade,
		);

		$this->db->insert('pedido_peca_item',$data);

	}

	public function deletePecaPedido($id_peca_item) {

		$this->db->where('id_peca_item',$id_peca_item);
		$this->db->delete('pedido_peca_item');

	}

	public function deletePedido($id_pedido) {

		$this->db->where('id_pedido_peca',$id_pedido);
		$this->db->delete('pedido_peca');

	}



}

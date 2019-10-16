<?php


class PedidoPeca extends  CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->library("session");
	}

	public function index()
	{

		$this->load->view('inicio_pedidopeca');

	}

	public function estoque()
	{

		$this->load->model('pedido_peca');
		$data = array(
			'scripts'=>array(
				//'util.js',
				'pedidoPeca.js'
			),
			'pecas'=>$this->pedido_peca->pecas()
		);
		$this->load->view('estoque',$data);

	}

	public function adicionarPeca () {
		$json = array();
		$json["status"] = 1;
		$json["error_list"] = array();

		$descricao = $this->input->post('descricao_peca');
		$codigo = $this->input->post('codigo_peca');
		$valor_peca = $this->input->post('valor_peca');
		$quantidade = $this->input->post('quantidade_peca');

		if (empty($descricao)) {
			$json["status"] = 0;
			$json["error_list"]["#descricao_peca"] = "Vazio!";
		} else {
			$this->load->model('pedido_peca');
			$result = $this->pedido_peca->nova_peca($descricao,$codigo,$valor_peca,$quantidade);
			if ($result) {
				//echo '<script type="javascript">alert("Cadastrado com sucesso!!");</script>';
			} else {
				$json["status"] = 0;
			}
		}

		echo json_encode($json);

	}

	public function carregarPeca() {
		$json = array();
		$json["status"] = 1;
		$json["error_list"] = array();

		$id_peca = $this->input->post('id_peca');

		$this->load->model("pedido_peca");
		$result = $this->pedido_peca->carregar_peca($id_peca)->result_array()[0];
		$json['input']['id_peca_alterar'] = $result['id_peca'];
		$json['input']['descricao_peca_alterar'] = $result['descricao_peca'];
		$json['input']['codigo_peca_alterar'] = $result['codigo_peca'];
		$json['input']['valor_peca_alterar'] = $result['valor_peca_unidade'];
		$json['input']['quantidade_peca_alterar'] = $result['quantidade_peca'];

		echo json_encode($json);
	}

	public function atualizarPeca () {
		$json = array();
		$json["status"] = 1;
		$json["error_list"] = array();

		$id_peca = $this->input->post('id_peca_alterar');
		$descricao = $this->input->post('descricao_peca_alterar');
		$codigo = $this->input->post('codigo_peca_alterar');
		$valor_peca = $this->input->post('valor_peca_alterar');
		$quantidade = $this->input->post('quantidade_peca_alterar');

		if (empty($descricao)) {
			$json["status"] = 0;
			$json["error_list"]["#descricao_peca_alterar"] = "Vazio!";
		} else {
			$this->load->model('pedido_peca');
			$result = $this->pedido_peca->updatePeca($id_peca,$descricao,$codigo,$valor_peca,$quantidade);
			if ($result) {
				//echo '<script type="javascript">alert("Cadastrado com sucesso!!");</script>';
			} else {
				$json["status"] = 0;
			}
		}

		echo json_encode($json);

	}

	public function excluirPeca() {
		$id_peca = $this->input->post('id_peca');

		$this->load->model('pedido_peca');
		$this->pedido_peca->deletePeca($id_peca);
	}

}

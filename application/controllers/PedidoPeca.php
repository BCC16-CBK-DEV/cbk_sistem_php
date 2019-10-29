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
		$id_autorizada = $this->session->userdata('autorizada');
		$this->load->model('pedido_peca');
		$data = array(
			'scripts'=>array(
				//'util.js',
				'pedidoPeca.js'
			),
			'pecas'=>$this->pedido_peca->pecas($id_autorizada)
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
		$id_autorizada = $this->session->userdata('autorizada');

		if (empty($descricao)) {
			$json["status"] = 0;
			$json["error_list"]["#descricao_peca"] = "Vazio!";
		} else {
			$this->load->model('pedido_peca');
			$result = $this->pedido_peca->nova_peca($descricao,$codigo,$valor_peca,$quantidade,$id_autorizada);
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

	public function novo_pedido() {
		$id_autorizada = $this->session->userdata('autorizada');
		$this->load->model("pedido_peca");
		$data = array(
			'scripts'=>array(
				'pedidoPeca.js'
			),
			"pecas"=>$this->pedido_peca->pecas($id_autorizada),
			"fornecedores"=>$this->pedido_peca->fornecedores($id_autorizada)
		);

		$this->load->view('novo_pedido',$data);
	}

	public function dadosFornecedor () {
		$json = array();
		$json["status"] = 1;
		$json["error_list"] = array();

		$idFornecedor = $this->input->post('fornecedor_select');
		$this->load->model('pedido_peca');

		$result = $this->pedido_peca->info_fornecedor($idFornecedor)->result_array()[0];
		$json['input']['info_fornecedor_nome'] = $result['nome_fornecedor'];
		$json['input']['info_fornecedor_cnpj'] = $result['cnpj_fornecedor'];
		$json['input']['info_fornecedor_email'] = $result['email_fornecedor'];
		$json['input']['info_fornecedor_telefone'] = $result['telefone_fornecedor'];

		echo json_encode($json);

	}

	public function adicionarPedido() {

		$json = array();
		$json["status"] = 1;
		$json["error_list"] = array();

		$assunto = $this->input->post('assunto');
		$fornecedor = $this->input->post('fornecedor');
		$data = $this->input->post('data');
		$array = $this->input->post('array');
		$id_autorizada = $this->session->userdata('autorizada');

		if (empty($assunto)) {
			$json["status"] = 0;
			$json["error_list"]["#assunto_pedido"] = "Vazio!";
		} else {
			$this->load->model('pedido_peca');
			$result = $this->pedido_peca->adicionar_pedido($assunto, $data, $fornecedor, $array,$id_autorizada);
			if ($result) {
				//echo '<script type="javascript">alert("Cadastrado com sucesso!!");</script>';
			} else {
				$json["status"] = 0;
			}
		}

		echo json_encode($json);

	}

	public function pedidos () {
		$id_autorizada = $this->session->userdata('autorizada');

		$this->load->model('pedido_peca');
		$data = array(
			'scripts'=>array('pedidoPeca.js'),
			'pedidos'=>$this->pedido_peca->pedidos($id_autorizada)
		);

		$this->load->view('listagem_pedidos',$data);
	}

	public function alterarPedido() {

		$id_pedido = $this->input->get("id");
		$this->load->model("pedido_peca");
		$data = array(
			'scripts'=>array(
				'pedidoPeca.js'
			),
			"pecas"=>$this->pedido_peca->pecas(),
			"fornecedores"=>$this->pedido_peca->fornecedores(),
			"info_pedido"=>$this->pedido_peca->carregar_pedido($id_pedido)->result_array()[0],
			"pecas_pedido"=>$this->pedido_peca->pecas_pedido($id_pedido)
		);

		$this->load->view('alterar_pedido',$data);

	}

	public function editarPedido() {
		$json = array();
		$json["status"] = 1;
		$json["error_list"] = array();

		$id_pedido = $this->input->post("id_pedido");
		$assunto = $this->input->post('assunto');
		$fornecedor = $this->input->post('fornecedor');
		$data = $this->input->post('data');
		$this->load->model("pedido_peca");

		if (empty($id_pedido)) {
			$json["status"] = 0;
			$json["error_list"]["#id_pedido"] = "Vazio!";
		} else {
			$this->load->model('pedido_peca');
			$result = $this->pedido_peca->updatePedido($id_pedido,$assunto,$data,$fornecedor);
			if ($result) {
				//echo '<script type="javascript">alert("Cadastrado com sucesso!!");</script>';
			} else {
				$json["status"] = 0;
			}
		}

		echo json_encode($json);

	}

	public function editarPedido_peca() {
		$json = array();
		$json["status"] = 1;
		$json["error_list"] = array();

		$id_pedido = $this->input->post("id_pedido");
		$peca = $this->input->post('peca');
		$quantidade = $this->input->post('quantidade');
		$this->load->model("pedido_peca");

		if (empty($id_pedido)) {
			$json["status"] = 0;
			$json["error_list"]["#id_pedido"] = "Vazio!";
		} else {
			$this->load->model('pedido_peca');
			$result = $this->pedido_peca->insertPecaPedido($id_pedido,$peca,$quantidade);
			if ($result) {
				//echo '<script type="javascript">alert("Cadastrado com sucesso!!");</script>';
			} else {
				$json["status"] = 0;
			}
		}

		echo json_encode($json);

	}

	public function excluirPecaItemPedido() {
		$id_peca_item = $this->input->post('id_peca_item');

		$this->load->model('pedido_peca');
		$this->pedido_peca->deletePecaPedido($id_peca_item);
	}

	public function excluirPedido() {
		$id_pedido = $this->input->post('id_pedido');

		$this->load->model('pedido_peca');
		$this->pedido_peca->deletePedido($id_pedido);
	}
}

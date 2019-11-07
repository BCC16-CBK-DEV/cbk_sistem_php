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
			'pedidos'=>$this->pedido_peca->pedidos($id_autorizada),
			'fornecedores'=>$this->pedido_peca->fornecedores($id_autorizada)
		);

		$this->load->view('listagem_pedidos',$data);
	}

	public function alterarPedido() {

		$id_pedido = $this->input->get("id");
		$id_autorizada = $this->session->userdata("autorizada");
		$this->load->model("pedido_peca");
		$data = array(
			"scripts"=>array(
				"pedidoPeca.js"
			),
			"pecas"=>$this->pedido_peca->pecas($id_autorizada),
			"fornecedores"=>$this->pedido_peca->fornecedores($id_autorizada),
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

	public function enviarPedido() {

		$id_pedido = $this->input->post('id_pedido');
		$id_fornecedor = $this->input->post('fornecedor');
		$assunto = $this->input->post('assunto');
		$data_pedido = $this->input->post('data');
		$id_autorizada = $this->session->userdata('autorizada');

		$this->load->model('pedido_peca');
		$fornecedor_info = $this->pedido_peca->info_fornecedor($id_fornecedor)->result_array()[0];
		$data = array(
			'data_pedido'=>$data_pedido,
			'pedido_info'=> $this->pedido_peca->carregar_pedido($id_pedido)->result_array()[0],
			'pecas_pedido'=>$this->pedido_peca->pecas_pedido($id_pedido),
			'autorizada'=>$this->pedido_peca->info_autorizada($id_autorizada)->result_array()[0]);

		$body = $this->load->view('corpo_email',$data,true);

		$this->load->model('configuracoes_model');

		$result = $this->configuracoes_model->autorizada($id_autorizada)->result_array()[0];

		$this->load->library('email');
		$this->email->set_smtp_host($result['smtp_host_autorizada']);
		$this->email->set_smtp_port($result['smtp_porta_autorizada']);
		$this->email->set_protocol($result['protocolo_email_autorizada']);
		$this->email->set_smtp_user($result['email_autorizada']);
		$this->email->set_smtp_pass($result['senha_email_autorizada']);
		$this->email->from($result['email_autorizada']);
		$this->email->to($fornecedor_info['email_fornecedor']);
		$this->email->subject($assunto);
		$this->email->message($body);

		echo $this->email->print_debugger();


		if($this->email->send()){
			$this->pedido_peca->updateSituacaoPedido($id_pedido);
			return true;
		} else {
			return false;
		}

	}

	public function filtroPedido() {

		$numero_inicial = $this->input->post('filtro_numero_inicial');
		$numero_final = $this->input->post('filtro_numero_final');
		$data_inicial = $this->input->post('filtro_data_inicial');
		$data_final = $this->input->post('filtro_data_final');
		$assunto = $this->input->post('filtro_assunto');
		$fornecedor = $this->input->post('fornecedor_pedido');
		$id_autorizada = $this->session->userdata('autorizada');

		if(!empty($numero_inicial) && empty($numero_final) && empty($data_inicial) && empty($data_final)
			&& empty($assunto) && $fornecedor == 0){
			$option = 1;
		} else if (empty($numero_inicial) && !empty($numero_final) && empty($data_inicial) && empty($data_final)
			&& empty($assunto) && $fornecedor == 0) {
			$option = 2;
		} else if (empty($numero_inicial) && empty($numero_final) && !empty($data_inicial) && empty($data_final)
			&& empty($assunto) && $fornecedor == 0) {
			$option = 3;
		} else if (empty($numero_inicial) && empty($numero_final) && empty($data_inicial) && !empty($data_final)
			&& empty($assunto) && $fornecedor == 0) {
			$option = 4;
		} else if (empty($numero_inicial) && empty($numero_final) && empty($data_inicial) && empty($data_final)
			&& !empty($assunto) && $fornecedor == 0) {
			$option = 5;
		} else if (empty($numero_inicial) && empty($numero_final) && empty($data_inicial) && empty($data_final)
			&& empty($assunto) && $fornecedor != 0) {
			$option = 6;
		} else if (!empty($numero_inicial) && !empty($numero_final) && empty($data_inicial) && empty($data_final)
			&& empty($assunto) && $fornecedor == 0) {
			$option = 7;
		} else if (!empty($numero_inicial) && !empty($numero_final) && !empty($data_inicial) && empty($data_final)
			&& empty($assunto) && $fornecedor == 0) {
			$option = 8;
		} else if (!empty($numero_inicial) && !empty($numero_final) && !empty($data_inicial) && !empty($data_final)
			&& empty($assunto) && $fornecedor == 0) {
			$option = 9;
		} else if (!empty($numero_inicial) && !empty($numero_final) && !empty($data_inicial) && !empty($data_final)
			&& !empty($assunto) && $fornecedor == 0) {
			$option = 10;
		} else if (!empty($numero_inicial) && !empty($numero_final) && !empty($data_inicial) && !empty($data_final)
			&& !empty($assunto) && $fornecedor != 0) {
			$option = 11;
		} else if (!empty($numero_inicial) && empty($numero_final) && !empty($data_inicial) && empty($data_final)
			&& empty($assunto) && $fornecedor == 0) {
			$option = 12;
		} else if (!empty($numero_inicial) && empty($numero_final) && !empty($data_inicial) && !empty($data_final)
			&& empty($assunto) && $fornecedor == 0) {
			$option = 13;
		} else if (!empty($numero_inicial) && empty($numero_final) && !empty($data_inicial) && !empty($data_final)
			&& !empty($assunto) && $fornecedor == 0) {
			$option = 14;
		} else if (!empty($numero_inicial) && empty($numero_final) && !empty($data_inicial) && !empty($data_final)
			&& !empty($assunto) && $fornecedor != 0) {
			$option = 15;
		} else if (!empty($numero_inicial) && empty($numero_final) && empty($data_inicial) && !empty($data_final)
			&& empty($assunto) && $fornecedor == 0) {
			$option = 16;
		} else if (!empty($numero_inicial) && empty($numero_final) && empty($data_inicial) && !empty($data_final)
			&& !empty($assunto) && $fornecedor == 0) {
			$option = 17;
		} else if (!empty($numero_inicial) && empty($numero_final) && empty($data_inicial) && !empty($data_final)
			&& !empty($assunto) && $fornecedor != 0) {
			$option = 18;
		} else if (!empty($numero_inicial) && empty($numero_final) && empty($data_inicial) && empty($data_final)
			&& !empty($assunto) && $fornecedor == 0) {
			$option = 19;
		} else if (!empty($numero_inicial) && empty($numero_final) && empty($data_inicial) && empty($data_final)
			&& !empty($assunto) && $fornecedor != 0) {
			$option = 20;
		} else if (!empty($numero_inicial) && empty($numero_final) && empty($data_inicial) && empty($data_final)
			&& empty($assunto) && $fornecedor != 0) {
			$option = 21;
		} else if (empty($numero_inicial) && !empty($numero_final) && !empty($data_inicial) && empty($data_final)
			&& empty($assunto) && $fornecedor == 0) {
			$option = 22;
		} else if (empty($numero_inicial) && !empty($numero_final) && !empty($data_inicial) && !empty($data_final)
			&& empty($assunto) && $fornecedor == 0) {
			$option = 23;
		} else if (empty($numero_inicial) && !empty($numero_final) && !empty($data_inicial) && !empty($data_final)
			&& !empty($assunto) && $fornecedor == 0) {
			$option = 24;
		} else if (empty($numero_inicial) && !empty($numero_final) && !empty($data_inicial) && !empty($data_final)
			&& !empty($assunto) && $fornecedor != 0) {
			$option = 25;
		} else if (empty($numero_inicial) && empty($numero_final) && !empty($data_inicial) && !empty($data_final)
			&& empty($assunto) && $fornecedor == 0) {
			$option = 26;
		} else if (empty($numero_inicial) && empty($numero_final) && !empty($data_inicial) && !empty($data_final)
			&& !empty($assunto) && $fornecedor == 0) {
			$option = 27;
		} else if (empty($numero_inicial) && empty($numero_final) && !empty($data_inicial) && !empty($data_final)
			&& !empty($assunto) && $fornecedor != 0) {
			$option = 28;
		} else if (empty($numero_inicial) && empty($numero_final) && empty($data_inicial) && !empty($data_final)
			&& !empty($assunto) && $fornecedor == 0) {
			$option = 29;
		} else if (empty($numero_inicial) && empty($numero_final) && empty($data_inicial) && empty($data_final)
			&& !empty($assunto) && $fornecedor != 0) {
			$option = 30;
		} else if (!empty($numero_inicial) && empty($numero_final) && !empty($data_inicial) && empty($data_final)
			&& empty($assunto) && $fornecedor == 0) {
			$option = 31;
		} else if (!empty($numero_inicial) && empty($numero_final) && empty($data_inicial) && !empty($data_final)
			&& empty($assunto) && $fornecedor == 0) {
			$option = 32;
		} else if (!empty($numero_inicial) && empty($numero_final) && empty($data_inicial) && empty($data_final)
			&& !empty($assunto) && $fornecedor == 0) {
			$option = 33;
		} else if (!empty($numero_inicial) && empty($numero_final) && empty($data_inicial) && empty($data_final)
			&& empty($assunto) && $fornecedor != 0) {
			$option = 34;
		} else if (empty($numero_inicial) && !empty($numero_final) && empty($data_inicial) && !empty($data_final)
			&& empty($assunto) && $fornecedor == 0) {
			$option = 35;
		} else if (empty($numero_inicial) && !empty($numero_final) && empty($data_inicial) && empty($data_final)
			&& !empty($assunto) && $fornecedor == 0) {
			$option = 36;
		} else if (empty($numero_inicial) && !empty($numero_final) && empty($data_inicial) && empty($data_final)
			&& empty($assunto) && $fornecedor != 0) {
			$option = 37;
		} else if (empty($numero_inicial) && empty($numero_final) && !empty($data_inicial) && empty($data_final)
			&& !empty($assunto) && $fornecedor == 0) {
			$option = 38;
		} else if (empty($numero_inicial) && empty($numero_final) && !empty($data_inicial) && empty($data_final)
			&& empty($assunto) && $fornecedor != 0) {
			$option = 39;
		} else if (empty($numero_inicial) && empty($numero_final) && empty($data_inicial) && !empty($data_final)
			&& empty($assunto) && $fornecedor != 0) {
			$option = 40;
		}


		$this->load->model('pedido_peca');

		$data = array(
			'scripts'=>array(
				'pedidoPeca.js'
			),
			'pedidos'=>$this->pedido_peca->filtro_pedido($option,$numero_inicial,$numero_final,$data_inicial,$data_final,$assunto,
				$fornecedor,$id_autorizada),
			'fornecedores'=>$this->pedido_peca->fornecedores($id_autorizada)
		);

		$this->load->view('listagem_pedidos',$data);

	}

	public function filtroEstoque () {
		$descricao = $this->input->post('filtro_descricao_peca');
		$codigo = $this->input->post('filtro_codigo_peca');
		$quantidade = $this->input->post('filtro_quantidade_peca');
		$valor = $this->input->post('filtro_valor_peca');
		$id_autorizada = $this->session->userdata('autorizada');

		if(!empty($descricao) && empty($codigo) && empty($quantidade) && empty($valor)){
			$option = 1;
		} else if(empty($descricao) && !empty($codigo) && empty($quantidade) && empty($valor)) {
			$option = 2;
		} else if(empty($descricao) && empty($codigo) && !empty($quantidade) && empty($valor)) {
			$option = 3;
		} else if(empty($descricao) && empty($codigo) && empty($quantidade) && !empty($valor)) {
			$option = 4;
		} else if(!empty($descricao) && !empty($codigo) && empty($quantidade) && empty($valor)) {
			$option = 5;
		} else if(!empty($descricao) && empty($codigo) && !empty($quantidade) && empty($valor)) {
			$option = 6;
		} else if(!empty($descricao) && empty($codigo) && empty($quantidade) && !empty($valor)) {
			$option = 7;
		} else if(empty($descricao) && !empty($codigo) && !empty($quantidade) && empty($valor)) {
			$option = 8;
		} else if(empty($descricao) && !empty($codigo) && empty($quantidade) && !empty($valor)) {
			$option = 9;
		} else if(empty($descricao) && empty($codigo) && !empty($quantidade) && !empty($valor)) {
			$option = 10;
		} else if(!empty($descricao) && !empty($codigo) && !empty($quantidade) && !empty($valor)) {
			$option = 11;
		}


		$this->load->model('pedido_peca');

		$data = array(
			'scripts'=>array (
				'pedidoPeca.js'
			),
			'pecas'=>$this->pedido_peca->filtro_estoque($option,$descricao,$codigo,$quantidade,$valor,$id_autorizada)
		);

		$this->load->view('estoque',$data);
	}
}

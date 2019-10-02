<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class OrdemServico extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library('session');
	}

	public function index() {

		$this->load->view('ordem_servico');
	
	}

	public function nova_ordem() {

		$this->load->model('ordem_servico');
		$data = array(
			'clientes'=>$this->ordem_servico->carregarCliente()
		);
		$this->load->view('nova_ordem',$data);
	}

	public function carregarClientes() {




	}

	public function novoCliente() {

		$json = array();
		$json["status"] = 1;
		$json["error_list"] = array();

		$nome = $this->input->post('nome_cliente');
		$cpf = $this->input->post('cpf_cliente');
		$celular = $this->input->post('celular_cliente');

		if (empty($nome)) {
			$json["status"] = 0;
			$json["error_list"]["#nome_cliente"] = "Nome está vazio!";
		} else {
			$this->load->model("ordem_servico");
			$result = $this->ordem_servico->novo_cliente($nome,$cpf,$celular);
			if ($result) {
				//echo '<script type="javascript">alert("Cadastrado com sucesso!!");</script>';
			} else {
				$json["status"] = 0;
			}
		}

		echo json_encode($json);
	}

	public function dadosCliente() {

		$json = array();
		$json["status"] = 1;
		$json["error_list"] = array();

		$id_cliente = $this->input->post('clientes_select');

		$this->load->model("ordem_servico");
		$result = $this->ordem_servico->dados_cliente($id_cliente)->result_array()[0];
		$json['input']['info_cliente_id'] = $result['id_cliente'];
		$json['input']['info_cliente_nome'] = $result['nome_cliente'];
		$json['input']['info_cliente_cpf'] = $result['cpf'];
		$json['input']['info_cliente_rg'] = $result['rg'];
		$json['input']['info_cliente_cep'] = $result['cep'];
		$json['input']['info_cliente_endereco'] = $result['endereco'];
		$json['input']['info_cliente_bairro'] = $result['bairro'];
		$json['input']['info_cliente_numero'] = $result['numero'];
		$json['input']['info_cliente_complemento'] = $result['complemento'];
		$json['input']['info_cliente_email'] = $result['email'];
		$json['input']['info_cliente_telefone'] = $result['telefone'];
		$json['input']['info_cliente_celular'] = $result['celular'];
		$json['input']['info_cliente_cidade'] = $result['cidade'];
		$json['input']['info_cliente_uf'] = $result['uf'];

		echo json_encode($json);
	}

	public function selecionarCliente() {

		$json = array();
		$json["status"] = 1;
		$json["error_list"] = array();

		$id_cliente = $this->input->post('idCliente');

		$this->load->model("ordem_servico");
		$result = $this->ordem_servico->carregarNomeCliente($id_cliente)->result_array()[0];
		$json['input']['os_cliente_id'] = $result['id_cliente'];
		$json['input']['os_cliente_nome'] = $result['nome_cliente'];

		echo json_encode($json);
	}

	public function selecionarUltimoCliente() {

		$json = array();
		$json["status"] = 1;
		$json["error_list"] = array();

		$this->load->model("ordem_servico");
		$result = $this->ordem_servico->carregarNomeUltimoCliente()->result_array()[0];
		$json['input']['os_cliente_id'] = $result['id_cliente'];
		$json['input']['os_cliente_nome'] = $result['nome_cliente'];

		echo json_encode($json);
	}

	public function os_abertas () {

		$this->load->model('ordem_servico');
		$data = array(
			'os_abertas'=>$this->ordem_servico->os_abertas()
		);

		$this->load->view('os_abertas',$data);
	}

	public function os_fechadas () {

		$this->load->model('ordem_servico');
		$data = array(
			'os_fechadas'=>$this->ordem_servico->os_fechadas()
		);

		$this->load->view('os_fechadas',$data);
	}

	public function novaOrdem() {

		$json = array();
		$json["status"] = 1;
		$json["error_list"] = array();

		$data_abertura = $this->input->post('data_abertura_os');
		$nota_fiscal = $this->input->post('nota_fiscal_os');
		$codigo_produto = $this->input->post('codigo_produto_os');
		$data_compra = $this->input->post('data_compra_os');
		$descricao_produto = $this->input->post('descricao_produto_os');
		$numero_serie = $this->input->post('numero_serie_os');
		$voltagem = $this->input->post('voltagem_os');
		$defeito_reclamado = $this->input->post('defeito_reclamado_os');
		$idcliente = $this->input->post('os_cliente_id');

		if (empty($data_abertura)) {
			$json["status"] = 0;
			$json["error_list"]["#nome_cliente"] = "Nome está vazio!";
		} else {
			$this->load->model("ordem_servico");
			$result = $this->ordem_servico->novaOrdem($data_abertura,$nota_fiscal,$codigo_produto,$data_compra,$descricao_produto,$numero_serie,
				$voltagem,$defeito_reclamado,$idcliente);
			if ($result) {
				//echo '<script type="javascript">alert("Cadastrado com sucesso!!");</script>';
			} else {
				$json["status"] = 0;
			}
		}

		echo json_encode($json);
	}


}

?>

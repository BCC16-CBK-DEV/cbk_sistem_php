<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class OrdemServico extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library('session');
		//include_once('Header_Controller/index');
	}

	public function index() {
		$this->load->view('header.php');
		$this->load->view('ordem_servico');
	
	}

	public function nova_ordem() {

		$this->load->model('ordem_servico');
		$data = array(
			'clientes'=>$this->ordem_servico->carregarCliente($this->session->userdata('autorizada')),
			'scripts'=>array(
				'addClienteOrdemServico.js',
				'ordemServico.js'
			)
		);
		$this->load->view('nova_ordem',$data);
	}

	public function novoCliente() {

		$json = array();
		$json["status"] = 1;
		$json["error_list"] = array();

		$nome = $this->input->post('nome_cliente');
		$cpf = $this->input->post('cpf_cliente');
		$celular = $this->input->post('celular_cliente');
		$id_autorizada = $this->session->userdata('autorizada');

		if (empty($nome)) {
			$json["status"] = 0;
			$json["error_list"]["#nome_cliente"] = "Nome está vazio!";
		} else {
			$this->load->model("ordem_servico");
			$result = $this->ordem_servico->novo_cliente($nome,$cpf,$celular,$id_autorizada);
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
			'os_abertas'=>$this->ordem_servico->os_abertas($this->session->userdata('autorizada')),
			"scripts"=>array(
				"util.js"
			)
		);

		$this->load->view('os_abertas',$data);
	}


	public function os_fechadas () {

		$this->load->model('ordem_servico');
		$data = array(
			'os_fechadas'=>$this->ordem_servico->os_fechadas($this->session->userdata('autorizada'))
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
		$id_autorizada = $this->session->userdata('autorizada');

		if (empty($data_abertura)) {
			$json["status"] = 0;
			$json["error_list"]["#nome_cliente"] = "Nome está vazio!";
		} else {
			$this->load->model("ordem_servico");
			$result = $this->ordem_servico->novaOrdem($data_abertura,$nota_fiscal,$codigo_produto,$data_compra,$descricao_produto,$numero_serie,
				$voltagem,$defeito_reclamado,$idcliente,$id_autorizada);
			if ($result) {
				//echo '<script type="javascript">alert("Cadastrado com sucesso!!");</script>';
			} else {
				$json["status"] = 0;
			}
		}

		echo json_encode($json);
	}


	public function filtroOrdem () {

		$numero_inicial = $this->input->post('filtro_numero_inicial');
		$numero_final = $this->input->post('filtro_numero_final');
		$data_inicial = $this->input->post('filtro_data_inicial');
		$data_final = $this->input->post('filtro_data_final');
		$descricao = $this->input->post('filtro_descricao');
		$nota_fiscal = $this->input->post('filtro_nota_fiscal');
		$codigo_produto = $this->input->post('filtro_codigo_produto');
		$id_autorizada = $this->session->userdata('autorizada');

		if(empty($numero_inicial) && !empty($numero_final) && !empty($data_inicial) && !empty($data_final)
			&& !empty($descricao) && !empty($nota_fiscal) && !empty($codigo_produto)){
			$option = 1;
		} else if(!empty($numero_inicial) && empty($numero_final) && !empty($data_inicial) && !empty($data_final)
			&& !empty($descricao) && !empty($nota_fiscal) && !empty($codigo_produto)){
			$option = 2;
		} else if (empty($numero_inicial) && !empty($numero_final) && empty($data_inicial)
			&& !empty($data_final) && !empty($descricao) && !empty($nota_fiscal) && !empty($codigo_produto)){
			$option = 3;
		} else if (!empty($numero_inicial) && empty($numero_final) && !empty($data_inicial)
			&& empty($data_final) && !empty($descricao) && !empty($nota_fiscal) && !empty($codigo_produto)){
			$option = 4;
		} else if (!empty($numero_inicial) && !empty($numero_final) && empty($data_inicial)
			&& !empty($data_final) && !empty($descricao) && !empty($nota_fiscal) && !empty($codigo_produto)) {
			$option = 5;
		} else if (!empty($numero_inicial) && !empty($numero_final) && !empty($data_inicial)
			&& empty($data_final) && !empty($descricao) && !empty($nota_fiscal) && !empty($codigo_produto)){
			$option = 6;
		} else if (empty($numero_inicial) && empty($numero_final) && empty($data_inicial)
			&& empty($data_final) && !empty($descricao) && !empty($nota_fiscal) && !empty($codigo_produto)) {
			$option = 7;
		} else if (!empty($numero_inicial) && !empty($numero_final) && !empty($data_inicial)
			&& !empty($data_final) && empty($descricao) && !empty($nota_fiscal) && !empty($codigo_produto)) {
			$option = 8;
		} else if (!empty($numero_inicial) && !empty($numero_final) && !empty($data_inicial)
			&& !empty($data_final) && empty($descricao) && empty($nota_fiscal) && !empty($codigo_produto)) {
			$option = 9;
		} else if (!empty($numero_inicial) && !empty($numero_final) && !empty($data_inicial)
			&& !empty($data_final) && empty($descricao) && empty($nota_fiscal) && empty($codigo_produto)) {
			$option = 10;
		} else if (!empty($numero_inicial) && empty($numero_final) && empty($data_inicial)
			&& empty($data_final) && !empty($descricao) && empty($nota_fiscal) && empty($codigo_produto)) {
			$option = 11;
		} else if (!empty($numero_inicial) && !empty($numero_final) && empty($data_inicial)
			&& empty($data_final) && !empty($descricao) && empty($nota_fiscal) && empty($codigo_produto)) {
			$option = 12;
		} else if (!empty($numero_inicial) && !empty($numero_final) && !empty($data_inicial)
			&& empty($data_final) && !empty($descricao) && empty($nota_fiscal) && empty($codigo_produto)) {
			$option = 13;
		} else if (!empty($numero_inicial) && !empty($numero_final) && !empty($data_inicial)
			&& !empty($data_final) && !empty($descricao) && empty($nota_fiscal) && empty($codigo_produto)) {
			$option = 14;
		} else if (!empty($numero_inicial) && !empty($numero_final) && !empty($data_inicial)
			&& !empty($data_final) && !empty($descricao) && !empty($nota_fiscal) && empty($codigo_produto)) {
			$option = 15;
		} else if (!empty($numero_inicial) && empty($numero_final) && empty($data_inicial)
			&& empty($data_final) && empty($descricao) && !empty($nota_fiscal) && empty($codigo_produto)) {
			$option = 16;
		} else if (!empty($numero_inicial) && !empty($numero_final) && empty($data_inicial)
			&& empty($data_final) && empty($descricao) && !empty($nota_fiscal) && empty($codigo_produto)) {
			$option = 17;
		} else if (!empty($numero_inicial) && !empty($numero_final) && !empty($data_inicial)
			&& empty($data_final) && empty($descricao) && !empty($nota_fiscal) && empty($codigo_produto)) {
			$option = 18;
		} else if (!empty($numero_inicial) && empty($numero_final) && empty($data_inicial)
			&& empty($data_final) && empty($descricao) && empty($nota_fiscal) && !empty($codigo_produto)) {
			$option = 19;
		} else if (!empty($numero_inicial) && empty($numero_final) && empty($data_inicial)
		&& empty($data_final) && !empty($descricao) && empty($nota_fiscal) && !empty($codigo_produto)) {
			$option = 20;
		} else if (empty($numero_inicial) && empty($numero_final) && empty($data_inicial)
			&& empty($data_final) && !empty($descricao) && empty($nota_fiscal) && empty($codigo_produto)) {
			$option = 21;
		} else if (empty($numero_inicial) && empty($numero_final) && empty($data_inicial)
			&& empty($data_final) && empty($descricao) && !empty($nota_fiscal) && empty($codigo_produto)) {
			$option = 22;
		} else if (empty($numero_inicial) && empty($numero_final) && empty($data_inicial)
			&& empty($data_final) && empty($descricao) && empty($nota_fiscal) && !empty($codigo_produto)) {
			$option = 23;
		} else if (!empty($numero_inicial) && empty($numero_final) && empty($data_inicial)
			&& empty($data_final) && empty($descricao) && empty($nota_fiscal) && empty($codigo_produto)) {
			$option = 24;
		} else if (empty($numero_inicial) && !empty($numero_final) && empty($data_inicial)
			&& empty($data_final) && empty($descricao) && empty($nota_fiscal) && empty($codigo_produto)) {
			$option = 25;
		} else if (empty($numero_inicial) && empty($numero_final) && !empty($data_inicial)
			&& empty($data_final) && empty($descricao) && empty($nota_fiscal) && empty($codigo_produto)) {
			$option = 26;
		} else if (empty($numero_inicial) && empty($numero_final) && empty($data_inicial)
			&& !empty($data_final) && empty($descricao) && empty($nota_fiscal) && empty($codigo_produto)) {
			$option = 27;
		} else if (!empty($numero_inicial) && !empty($numero_final) && empty($data_inicial)
			&& empty($data_final) && empty($descricao) && empty($nota_fiscal) && empty($codigo_produto)) {
			$option = 28;
		} else if (empty($numero_inicial) && empty($numero_final) && !empty($data_inicial)
			&& !empty($data_final) && empty($descricao) && empty($nota_fiscal) && empty($codigo_produto)) {
			$option = 29;
		} else {
			$option = 30;
		}

		$this->load->model('ordem_servico');

		$data = array(
			'os_abertas'=>$this->ordem_servico->filtro_ordem_aberta($option,$numero_inicial,$numero_final,$data_inicial,$data_final,$descricao,
				$nota_fiscal,$codigo_produto,$id_autorizada)
		);

		$this->load->view('os_abertas',$data);

	}

	public function filtroOrdemFechada () {

		$numero_inicial = $this->input->post('filtro_numero_inicial');
		$numero_final = $this->input->post('filtro_numero_final');
		$data_inicial = $this->input->post('filtro_data_inicial');
		$data_final = $this->input->post('filtro_data_final');
		$descricao = $this->input->post('filtro_descricao');
		$nota_fiscal = $this->input->post('filtro_nota_fiscal');
		$codigo_produto = $this->input->post('filtro_codigo_produto');
		$id_autorizada = $this->session->userdata('autorizada');

		if(empty($numero_inicial) && !empty($numero_final) && !empty($data_inicial) && !empty($data_final)
			&& !empty($descricao) && !empty($nota_fiscal) && !empty($codigo_produto)){
			$option = 1;
		} else if(!empty($numero_inicial) && empty($numero_final) && !empty($data_inicial) && !empty($data_final)
			&& !empty($descricao) && !empty($nota_fiscal) && !empty($codigo_produto)){
			$option = 2;
		} else if (empty($numero_inicial) && !empty($numero_final) && empty($data_inicial)
			&& !empty($data_final) && !empty($descricao) && !empty($nota_fiscal) && !empty($codigo_produto)){
			$option = 3;
		} else if (!empty($numero_inicial) && empty($numero_final) && !empty($data_inicial)
			&& empty($data_final) && !empty($descricao) && !empty($nota_fiscal) && !empty($codigo_produto)){
			$option = 4;
		} else if (!empty($numero_inicial) && !empty($numero_final) && empty($data_inicial)
			&& !empty($data_final) && !empty($descricao) && !empty($nota_fiscal) && !empty($codigo_produto)) {
			$option = 5;
		} else if (!empty($numero_inicial) && !empty($numero_final) && !empty($data_inicial)
			&& empty($data_final) && !empty($descricao) && !empty($nota_fiscal) && !empty($codigo_produto)){
			$option = 6;
		} else if (empty($numero_inicial) && empty($numero_final) && empty($data_inicial)
			&& empty($data_final) && !empty($descricao) && !empty($nota_fiscal) && !empty($codigo_produto)) {
			$option = 7;
		} else if (!empty($numero_inicial) && !empty($numero_final) && !empty($data_inicial)
			&& !empty($data_final) && empty($descricao) && !empty($nota_fiscal) && !empty($codigo_produto)) {
			$option = 8;
		} else if (!empty($numero_inicial) && !empty($numero_final) && !empty($data_inicial)
			&& !empty($data_final) && empty($descricao) && empty($nota_fiscal) && !empty($codigo_produto)) {
			$option = 9;
		} else if (!empty($numero_inicial) && !empty($numero_final) && !empty($data_inicial)
			&& !empty($data_final) && empty($descricao) && empty($nota_fiscal) && empty($codigo_produto)) {
			$option = 10;
		} else if (!empty($numero_inicial) && empty($numero_final) && empty($data_inicial)
			&& empty($data_final) && !empty($descricao) && empty($nota_fiscal) && empty($codigo_produto)) {
			$option = 11;
		} else if (!empty($numero_inicial) && !empty($numero_final) && empty($data_inicial)
			&& empty($data_final) && !empty($descricao) && empty($nota_fiscal) && empty($codigo_produto)) {
			$option = 12;
		} else if (!empty($numero_inicial) && !empty($numero_final) && !empty($data_inicial)
			&& empty($data_final) && !empty($descricao) && empty($nota_fiscal) && empty($codigo_produto)) {
			$option = 13;
		} else if (!empty($numero_inicial) && !empty($numero_final) && !empty($data_inicial)
			&& !empty($data_final) && !empty($descricao) && empty($nota_fiscal) && empty($codigo_produto)) {
			$option = 14;
		} else if (!empty($numero_inicial) && !empty($numero_final) && !empty($data_inicial)
			&& !empty($data_final) && !empty($descricao) && !empty($nota_fiscal) && empty($codigo_produto)) {
			$option = 15;
		} else if (!empty($numero_inicial) && empty($numero_final) && empty($data_inicial)
			&& empty($data_final) && empty($descricao) && !empty($nota_fiscal) && empty($codigo_produto)) {
			$option = 16;
		} else if (!empty($numero_inicial) && !empty($numero_final) && empty($data_inicial)
			&& empty($data_final) && empty($descricao) && !empty($nota_fiscal) && empty($codigo_produto)) {
			$option = 17;
		} else if (!empty($numero_inicial) && !empty($numero_final) && !empty($data_inicial)
			&& empty($data_final) && empty($descricao) && !empty($nota_fiscal) && empty($codigo_produto)) {
			$option = 18;
		} else if (!empty($numero_inicial) && empty($numero_final) && empty($data_inicial)
			&& empty($data_final) && empty($descricao) && empty($nota_fiscal) && !empty($codigo_produto)) {
			$option = 19;
		} else if (!empty($numero_inicial) && empty($numero_final) && empty($data_inicial)
			&& empty($data_final) && !empty($descricao) && empty($nota_fiscal) && !empty($codigo_produto)) {
			$option = 20;
		} else if (empty($numero_inicial) && empty($numero_final) && empty($data_inicial)
			&& empty($data_final) && !empty($descricao) && empty($nota_fiscal) && empty($codigo_produto)) {
			$option = 21;
		} else if (empty($numero_inicial) && empty($numero_final) && empty($data_inicial)
			&& empty($data_final) && empty($descricao) && !empty($nota_fiscal) && empty($codigo_produto)) {
			$option = 22;
		} else if (empty($numero_inicial) && empty($numero_final) && empty($data_inicial)
			&& empty($data_final) && empty($descricao) && empty($nota_fiscal) && !empty($codigo_produto)) {
			$option = 23;
		} else if (!empty($numero_inicial) && empty($numero_final) && empty($data_inicial)
			&& empty($data_final) && empty($descricao) && empty($nota_fiscal) && empty($codigo_produto)) {
			$option = 24;
		} else if (empty($numero_inicial) && !empty($numero_final) && empty($data_inicial)
			&& empty($data_final) && empty($descricao) && empty($nota_fiscal) && empty($codigo_produto)) {
			$option = 25;
		} else if (empty($numero_inicial) && empty($numero_final) && !empty($data_inicial)
			&& empty($data_final) && empty($descricao) && empty($nota_fiscal) && empty($codigo_produto)) {
			$option = 26;
		} else if (empty($numero_inicial) && empty($numero_final) && empty($data_inicial)
			&& !empty($data_final) && empty($descricao) && empty($nota_fiscal) && empty($codigo_produto)) {
			$option = 27;
		} else if (!empty($numero_inicial) && !empty($numero_final) && empty($data_inicial)
			&& empty($data_final) && empty($descricao) && empty($nota_fiscal) && empty($codigo_produto)) {
			$option = 28;
		} else if (empty($numero_inicial) && empty($numero_final) && !empty($data_inicial)
			&& !empty($data_final) && empty($descricao) && empty($nota_fiscal) && empty($codigo_produto)) {
			$option = 29;
		} else {
			$option = 30;
		}

		$this->load->model('ordem_servico');

		$data = array(
			'os_abertas'=>$this->ordem_servico->filtro_ordem_fechada($option,$numero_inicial,$numero_final,$data_inicial,$data_final,$descricao,
				$nota_fiscal,$codigo_produto,$id_autorizada)
		);

		$this->load->view('os_fechadas',$data);

	}

	public function alteraOrdem() {

		$json = array();
		$json["status"] = 1;
		$json["error_list"] = array();

		$id_ordem = $this->input->post('idOrdem');

		$this->load->model("ordem_servico");
		$result = $this->ordem_servico->carregarOrdem($id_ordem)->result_array()[0];
		$json['input']['numero_ordem_os'] = $result['numero_ordem'];
		$json['input']['data_abertura_os'] = $result['data_abertura'];
		$json['input']['data_prazo_os'] = $result['prazo_ordem'];
		$json['input']['valor_os'] = $result['valor_ordem'];
		$json['input']['id_status_os'] = $result['id_status'];
		$json['input']['id_tecnico_os'] = $result['id_tecnico'];
		$json['input']['nota_fiscal_os'] = $result['nota_fiscal'];
		$json['input']['codigo_produto_os'] = $result['codigo_produto'];
		$json['input']['data_compra_os'] = $result['data_compra'];
		$json['input']['descricao_produto_os'] = $result['descricao_produto'];
		$json['input']['numero_serie_os'] = $result['numero_serie_produto'];
		$json['input']['voltagem_os'] = $result['voltagem'];
		$json['input']['defeito_reclamado_os'] = $result['defeito_reclamado'];
		$json['input']['os_cliente_id'] = $result['id_cliente'];

		echo json_encode($json);

	}

	public function excluirOrdem() {

		$id_ordem = $this->input->post('idOrdem');
		$this->load->model('ordem_servico');
		$this->ordem_servico->excluir_ordem($id_ordem);

	}

	public function editarOrdem() {
		$this->load->model('ordem_servico');
		$id_ordem = $this->input->get("id");
		$id_autorizada = $this->session->userdata('autorizada');
		$data = array(
			"os"=>$this->ordem_servico->carregarOrdem($id_ordem)->result_array()[0],
			"clientes"=>$this->ordem_servico->carregarCliente($id_autorizada),
			"status"=>$this->ordem_servico->carregarStatus(),
			"tecnicos"=>$this->ordem_servico->carregarTecnicos($id_autorizada),
			"pecas"=>$this->ordem_servico->carregarPecas($id_autorizada),
			"peca_item"=>$this->ordem_servico->carregarPecaItem($id_ordem)
		);

		$this->load->view('alterar_ordem',$data);

	}

	public function inserirPecaOrdem () {
		$json = array();
		$json["status"] = 1;
		$json["error_list"] = array();

		$id_ordem = $this->input->post('idOrdem');
		$id_peca = $this->input->post('idPeca');
		$quantidade = $this->input->post('quantidade');

		if (empty($id_ordem)) {
			$json["status"] = 0;
			$json["error_list"]["#id_ordem"] = "Id Vazio!";
		} else {
			$this->load->model("ordem_servico");
			$result = $this->ordem_servico->insertPecaOrdem($id_ordem,$id_peca,$quantidade);
			$this->ordem_servico->subtraiEstoque($id_peca,$quantidade);
			if ($result) {
				//echo '<script type="javascript">alert("Cadastrado com sucesso!!");</script>';
			} else {
				$json["status"] = 0;
			}
		}

		echo json_encode($json);

	}


	public function atualizarOrdem() {

		$json = array();
		$json["status"] = 1;
		$json["error_list"] = array();

		$id_ordem = $this->input->post('id_ordem');
		$data_abertura = $this->input->post('data_abertura_os');
		$nota_fiscal = $this->input->post('nota_fiscal_os');
		$codigo_produto = $this->input->post('codigo_produto_os');
		$data_compra = $this->input->post('data_compra_os');
		$descricao_produto = $this->input->post('descricao_produto_os');
		$numero_serie = $this->input->post('numero_serie_os');
		$voltagem = $this->input->post('voltagem_os');
		$defeito_reclamado = $this->input->post('defeito_reclamado_os');
		$idcliente = $this->input->post('os_cliente_id');
		$observacao = $this->input->post('observacaoTecnico');
		$tecnico= $this->input->post('tecnico_os');
		$id_status = $this->input->post('status_os');
		$data_prazo = $this->input->post('data_prazo_os');
		$valor_os = $this->input->post('valor_os');
		$numero_ordem = $this->input->post('numero_ordem_os');

		if (empty($id_ordem)) {
			$json["status"] = 0;
			$json["error_list"]["#id_ordem"] = "Id Vazio!";
		} else {
			$this->load->model("ordem_servico");
			$result = $this->ordem_servico->updateOrdem($id_ordem,$numero_ordem,$data_abertura,$nota_fiscal,$codigo_produto,$data_compra,$descricao_produto,$numero_serie,
				$voltagem,$defeito_reclamado,$idcliente,$valor_os,$data_prazo,$tecnico,$id_status,$observacao);
			if ($result) {
				//echo '<script type="javascript">alert("Cadastrado com sucesso!!");</script>';
			} else {
				$json["status"] = 0;
			}
		}

		echo json_encode($json);
	}

	public function excluirItemPecaOrdem () {
		$id_peca_ordem = $this->input->post('idPecaOrdem');
		$quantidade = $this->input->post('quantidadePecaOrdem');
		$id_peca = $this->input->post('idpeca');

		$this->load->model('ordem_servico');
		$this->ordem_servico->excluir_peca_ordem($id_peca_ordem,$id_peca,$quantidade);
	}

}

?>

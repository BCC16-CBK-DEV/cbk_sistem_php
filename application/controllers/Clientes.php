<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Clientes extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
	}

	public function index()
	{

		$this->load->view('cliente');

	}

	public function novo_cliente() {

		$this->load->view('novo_cliente');
	}

	public function adicionarCliente(){

		$json = array();
		$json["status"] = 1;
		$json["error_list"] = array();

		$nome = $this->input->post('cliente_nome');
		$cpf = $this->input->post('cliente_cpf');
		$rg = $this->input->post('cliente_rg');
		$cep = $this->input->post('cliente_cep');
		$endereco = $this->input->post('cliente_endereco');
		$bairro = $this->input->post('cliente_bairro');
		$numero = $this->input->post('cliente_numero');
		$cidade = $this->input->post('cliente_cidade');
		$email = $this->input->post('cliente_email');
		$uf = $this->input->post('cliente_uf');
		$complemento = $this->input->post('cliente_complemento');
		$telefone = $this->input->post('cliente_telefone');
		$celular = $this->input->post('cliente_celular');
		$id_autorizada = $this->session->userdata('autorizada');

		if (empty($nome)) {
			$json["status"] = 0;
			$json["error_list"]["#nome_cliente"] = "Nome está vazio!";
		} else {
			$this->load->model("cliente");
			$result = $this->cliente->NovoCliente($nome,$cpf,$rg,$cep,$endereco,$bairro,$numero,$cidade,$email,
			$uf,$complemento,$telefone,$celular,$id_autorizada);
			if ($result) {
				//echo '<script type="javascript">alert("Cadastrado com sucesso!!");</script>';
			} else {
				$json["status"] = 0;
			}
		}

		echo json_encode($json);

	}

	public function listagem() {

		$id_autorizada = $this->session->userdata('autorizada');

		$this->load->model('cliente');

		$data = array(
			'clientes'=>$this->cliente->listaClientes($id_autorizada)
		);

		$this->load->view('listagem_clientes', $data);
	}

	public function alterarCliente() {

		$id_cliente = $this->input->get('id');
		$this->load->model('cliente');
		$data = array(
			'cliente'=>$this->cliente->carregarCliente($id_cliente)->result_array()[0]
		);

		$this->load->view('alterar_cliente',$data);

	}

	public function editarCliente() {
		$json = array();
		$json["status"] = 1;
		$json["error_list"] = array();

		$id_cliente = $this->input->post("id_cliente");
		$nome = $this->input->post('cliente_nome');
		$cpf = $this->input->post('cliente_cpf');
		$rg = $this->input->post('cliente_rg');
		$cep = $this->input->post('cliente_cep');
		$endereco = $this->input->post('cliente_endereco');
		$bairro = $this->input->post('cliente_bairro');
		$numero = $this->input->post('cliente_numero');
		$cidade = $this->input->post('cliente_cidade');
		$email = $this->input->post('cliente_email');
		$uf = $this->input->post('cliente_uf');
		$complemento = $this->input->post('cliente_complemento');
		$telefone = $this->input->post('cliente_telefone');
		$celular = $this->input->post('cliente_celular');

		if (empty($id_cliente)) {
			$json["status"] = 0;
			$json["error_list"]["#id_cliente"] = "Vazio!";
		} else {
			$this->load->model('cliente');
			$result = $this->cliente->updateCliente($id_cliente,$nome,$cpf,$rg,$cep,$endereco,$bairro,$numero,$cidade,$email,
				$uf,$complemento,$telefone,$celular);
			if ($result) {
				//echo '<script type="javascript">alert("Cadastrado com sucesso!!");</script>';
			} else {
				$json["status"] = 0;
			}
		}

		echo json_encode($json);

	}

	public function excluirCliente() {
		$id_cliente = $this->input->post('id_cliente');

		$this->load->model('cliente');
		$this->cliente->deleteCliente($id_cliente);
	}

	public function filtroCliente() {

		$nome = $this->input->post('filtro_cliente_nome');
		$cpf = $this->input->post('filtro_cliente_cpf');
		$email = $this->input->post('filtro_cliente_email');
		$celular = $this->input->post('filtro_cliente_celular');
		$id_autorizada = $this->session->userdata('autorizada');

		if(!empty($nome) && empty($cpf) && empty($email) && empty($celular)){
			$option = 1;
		} else if (empty($nome) && !empty($cpf) && empty($email) && empty($celular)) {
			$option = 2;
		} else if (empty($nome) && empty($cpf) && !empty($email) && empty($celular)) {
			$option = 3;
		} else if (empty($nome) && empty($cpf) && empty($email) && !empty($celular)) {
			$option = 4;
		} else if (!empty($nome) && !empty($cpf) && empty($email) && empty($celular)) {
			$option = 5;
		} else if (!empty($nome) && empty($cpf) && !empty($email) && empty($celular)) {
			$option = 6;
		} else if (!empty($nome) && empty($cpf) && empty($email) && !empty($celular)) {
			$option = 7;
		} else if (!empty($nome) && !empty($cpf) && !empty($email) && empty($celular)) {
			$option = 8;
		} else if (!empty($nome) && !empty($cpf) && empty($email) && !empty($celular)) {
			$option = 9;
		} else if (!empty($nome) && !empty($cpf) && !empty($email) && !empty($celular)) {
			$option = 10;
		} else if (empty($nome) && !empty($cpf) && !empty($email) && empty($celular)) {
			$option = 11;
		} else if (empty($nome) && !empty($cpf) && empty($email) && !empty($celular)) {
			$option = 12;
		} else if (empty($nome) && !empty($cpf) && !empty($email) && !empty($celular)) {
			$option = 13;
		}

		$this->load->model('cliente');
		$data = array(
			'clientes'=>$this->cliente->filtro_cliente($option,$id_autorizada,$nome,$cpf,$email,$celular)
		);

		$this->load->view('listagem_clientes',$data);

	}
}
?>

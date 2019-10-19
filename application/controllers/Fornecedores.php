<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fornecedores extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->library("session");
	}

	public function index(){
		$this->load->view('fornecedores');
	}

	public function novo_fornecedor(){
		$data = array(
			'scripts'=> array(
				'fornecedor.js'
			)
		);

		$this->load->view('novo_fornecedor',$data);
	}

	public function adicionarFornecedor (){

		$json = array();
		$json["status"] = 1;
		$json["error_list"] = array();

		$nome = $this->input->post('nome_fornecedor');
		$cnpj = $this->input->post('cnpj_fornecedor');
		$email = $this->input->post('email_fornecedor');
		$telefone = $this->input->post('telefone_fornecedor');

		if (empty($nome)) {
			$json["status"] = 0;
			$json["error_list"]["#nome_fornecedor"] = "Nome está vazio!";
		} else {
			$this->load->model("fornecedor");
			$result = $this->fornecedor->adicionar_fornecedor($nome,$cnpj,$email,$telefone);
			if ($result) {
				//echo '<script type="javascript">alert("Cadastrado com sucesso!!");</script>';
			} else {
				$json["status"] = 0;
			}
		}

		echo json_encode($json);

	}

	public function listagem() {

		$this->load->model('fornecedor');
		$data = array(
			'scripts'=>array(
				'fornecedor.js'
			),
			'fornecedores'=>$this->fornecedor->lista_fornecedores()
		);

		$this->load->view('listagem_fornecedores',$data);

	}

	public function editarFornecedor() {
		$this->load->model('fornecedor');
		$id_fornecedor = $this->input->get("id");
		$data = array(
			"fornecedor"=>$this->fornecedor->carregarFornecedor($id_fornecedor)->result_array()[0],
			'scripts'=>array(
				'fornecedor.js'
			)
		);

		$this->load->view('alterar_fornecedor',$data);

	}

	public function alterarFornecedor (){

		$json = array();
		$json["status"] = 1;
		$json["error_list"] = array();

		$id = $this->input->post('id_fornecedor_alterar');
		$nome = $this->input->post('nome_fornecedor_alterar');
		$cnpj = $this->input->post('cnpj_fornecedor_alterar');
		$email = $this->input->post('email_fornecedor_alterar');
		$telefone = $this->input->post('telefone_fornecedor_alterar');

		if (empty($nome)) {
			$json["status"] = 0;
			$json["error_list"]["#id_fornecedor_alterar"] = "ID está vazio!";
		} else {
			$this->load->model("fornecedor");
			$result = $this->fornecedor->alterar_fornecedor($id,$nome,$cnpj,$email,$telefone);
			if ($result) {
				//echo '<script type="javascript">alert("Cadastrado com sucesso!!");</script>';
			} else {
				$json["status"] = 0;
			}
		}

		echo json_encode($json);

	}

	public function excluirFornecedor() {

		$id = $this->input->post('idFornecedor');
		$this->load->model('fornecedor');
		$this->fornecedor->excluir_fornecedor($id);

	}

}

?>

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
		$this->load->view('header.php');
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
		$id_autorizada = $this->session->userdata('autorizada');

		if (empty($nome)) {
			$json["status"] = 0;
			$json["error_list"]["#nome_fornecedor"] = "Nome está vazio!";
		} else {
			$this->load->model("fornecedor");
			$result = $this->fornecedor->adicionar_fornecedor($nome,$cnpj,$email,$telefone,$id_autorizada);
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

		$this->load->model('fornecedor');
		$data = array(
			'scripts'=>array(
				'fornecedor.js'
			),
			'fornecedores'=>$this->fornecedor->lista_fornecedores($id_autorizada)
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

	public function filtroFornecedor() {

		$nome = $this->input->post('filtro_fornecedor_nome');
		$cnpj = $this->input->post('filtro_fornecedor_cnpj');
		$email = $this->input->post('filtro_fornecedor_email');
		$telefone = $this->input->post('filtro_fornecedor_telefone');
		$id_autorizada = $this->session->userdata('autorizada');

		if(!empty($nome) && empty($cnpj) && empty($email) && empty($telefone)){
			$option = 1;
		} else if (empty($nome) && !empty($cnpj) && empty($email) && empty($telefone)) {
			$option = 2;
		} else if (empty($nome) && empty($cnpj) && !empty($email) && empty($telefone)) {
			$option = 3;
		} else if (empty($nome) && empty($cnpj) && empty($email) && !empty($telefone)) {
			$option = 4;
		} else if (!empty($nome) && !empty($cnpj) && empty($email) && empty($telefone)) {
			$option = 5;
		} else if (!empty($nome) && empty($cnpj) && !empty($email) && empty($telefone)) {
			$option = 6;
		} else if (!empty($nome) && empty($cnpj) && empty($email) && !empty($telefone)) {
			$option = 7;
		} else if (!empty($nome) && !empty($cnpj) && !empty($email) && empty($telefone)) {
			$option = 8;
		} else if (!empty($nome) && !empty($cnpj) && empty($email) && !empty($telefone)) {
			$option = 9;
		} else if (!empty($nome) && !empty($cnpj) && !empty($email) && !empty($telefone)) {
			$option = 10;
		} else if (empty($nome) && !empty($cnpj) && !empty($email) && empty($telefone)) {
			$option = 11;
		} else if (empty($nome) && !empty($cnpj) && empty($email) && !empty($telefone)) {
			$option = 12;
		} else if (empty($nome) && !empty($cnpj) && !empty($email) && !empty($telefone)) {
			$option = 13;
		}

		$this->load->model('fornecedor');
		$data = array(
			'fornecedores'=>$this->fornecedor->filtro_fornecedor($option,$id_autorizada,$nome,$cnpj,$email,$telefone)
		);

		$this->load->view('listagem_fornecedores',$data);

	}

	public function relatorio_fornecedor() {

		$nome = $this->input->get('nome');
		$cnpj = $this->input->get('cnpj');
		$email = $this->input->get('email');
		$telefone = $this->input->get('telefone');
		$id_autorizada = $this->session->userdata('autorizada');

		if(!empty($nome) && empty($cnpj) && empty($email) && empty($telefone)){
			$option = 1;
		} else if (empty($nome) && !empty($cnpj) && empty($email) && empty($telefone)) {
			$option = 2;
		} else if (empty($nome) && empty($cnpj) && !empty($email) && empty($telefone)) {
			$option = 3;
		} else if (empty($nome) && empty($cnpj) && empty($email) && !empty($telefone)) {
			$option = 4;
		} else if (!empty($nome) && !empty($cnpj) && empty($email) && empty($telefone)) {
			$option = 5;
		} else if (!empty($nome) && empty($cnpj) && !empty($email) && empty($telefone)) {
			$option = 6;
		} else if (!empty($nome) && empty($cnpj) && empty($email) && !empty($telefone)) {
			$option = 7;
		} else if (!empty($nome) && !empty($cnpj) && !empty($email) && empty($telefone)) {
			$option = 8;
		} else if (!empty($nome) && !empty($cnpj) && empty($email) && !empty($telefone)) {
			$option = 9;
		} else if (!empty($nome) && !empty($cnpj) && !empty($email) && !empty($telefone)) {
			$option = 10;
		} else if (empty($nome) && !empty($cnpj) && !empty($email) && empty($telefone)) {
			$option = 11;
		} else if (empty($nome) && !empty($cnpj) && empty($email) && !empty($telefone)) {
			$option = 12;
		} else if (empty($nome) && !empty($cnpj) && !empty($email) && !empty($telefone)) {
			$option = 13;
		} else  {
			$option = 0;
		}

		$this->load->model('fornecedor');
		if ($option == 0) {
			$data = array(
				'scripts'=>array(
					'fornecedor.js'
				),
				'fornecedores'=>$this->fornecedor->lista_fornecedores($id_autorizada)
			);
		} else {
			$data = array(
				'scripts'=>array(
					'fornecedor.js'
				),
				'fornecedores' => $this->fornecedor->filtro_fornecedor($option, $id_autorizada, $nome, $cnpj, $email, $telefone)
			);
		}

		$html = $this->load->view('relatorio_fornecedor', $data, true);
		$mpdf = new \Mpdf\Mpdf();
		$stylesheet = file_get_contents(base_url().'public/css/estilos.css');
		$mpdf->WriteHTML($stylesheet,1);
		$mpdf->WriteHTML($html,2);
		$mpdf->Output('example1.pdf', 'I');
	}

}

?>

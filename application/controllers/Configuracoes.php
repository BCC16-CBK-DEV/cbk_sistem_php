<?php


class Configuracoes extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->library("session");
	}

	public function index() {

		$this->load->view('configuracao');

	}

	public function info_autorizada() {

		$id_autorizada = $this->session->userdata('autorizada');
		$this->load->model('configuracoes_model');
		$data = array(
			'scripts'=>array(
				'configuracao.js'
			),
			'info_autorizada'=>$this->configuracoes_model->autorizada($id_autorizada)->result_array()[0]
		);

		$this->load->view('configuracao_autorizada',$data);
	}

	public function alterarAutorizada() {

		$json = array();
		$json["status"] = 1;
		$json["error_list"] = array();

		$id_autorizada = $this->input->post('id_autorizada');
		$nome = $this->input->post('nome_autorizada');
		$email = $this->input->post('email_autorizada');
		$senha = $this->input->post('senha_email_autorizada');
		$host = $this->input->post('smtp_host_autorizada');
		$porta = $this->input->post('smtp_porta_autorizada');
		$protocolo = $this->input->post('protocolo_email_autorizada');

		if(empty($senha)) {
			$opcao = 1;
		} else {
			$opcao = 2;
		}

		if (empty($nome)) {
			$json["status"] = 0;
			$json["error_list"]["#nome_autorizada"] = "Nome está vazio!";
		} else {
			$this->load->model("configuracoes_model");
			$result = $this->configuracoes_model->alterar_autorizada($nome,$email,$senha,$host,$porta,$protocolo,$id_autorizada,$opcao);
			if ($result) {
				$json["status"] = 1;
			} else {
				$json["status"] = 0;
			}
		}

		echo json_encode($json);

	}

	public function usuarios() {

		$this->load->model('configuracoes_model');
		$id_autorizada = $this->session->userdata('autorizada');

		$data = array(
			'scripts'=>array(
				'configuracao.js'
			),
			'usuarios'=>$this->configuracoes_model->usuarios($id_autorizada),
			'departamento'=>$this->configuracoes_model->departamento()
		);

		$this->load->view('configuracoes_usuarios',$data);

	}

	public function novoUsuario() {

		$json = array();
		$json["status"] = 1;
		$json["error_list"] = array();

		$username = $this->input->post("username");
		$nome_completo = $this->input->post("nome_completo");
		$senha = password_hash($this->input->post("senha"));
		$departamento = $this->input->post("departamento");
		$id_autorizada = $this->session->userdata('autorizada');

		if (empty($username)) {
			$json["status"] = 0;
			$json["error_list"]["#username"] = "Usuário não pode ser vazio!";
		} else {
			$this->load->model("configuracoes_model");
			$result = $this->configuracoes_model->novo_usuario($username,$nome_completo,$senha,$departamento,$id_autorizada);
			if ($result) {
				$json["status"] = 1;
			} else {
				$json["status"] = 0;
			}
		}

		echo json_encode($json);

	}

	public function carregarUsuario() {
		$json = array();
		$json["status"] = 1;
		$json["error_list"] = array();

		$id_usuario = $this->input->post('id_usuario');

		$this->load->model("configuracoes_model");
		$result = $this->configuracoes_model->carregar_usuario($id_usuario)->result_array()[0];
		$json['input']['id_usuario_alterar'] = $result['id_usuario'];
		$json['input']['nome_completo_alterar'] = $result['nome_completo'];
		$json['input']['nome_usuario_alterar'] = $result['nome_usuario'];
		$json['input']['departamento_usuario_alterar'] = $result['id_departamento'];

		echo json_encode($json);
	}

	public function atualizaUsuario() {

		$json = array();
		$json["status"] = 1;
		$json["error_list"] = array();

		$id_usuario = $this->input->post('id_usuario_alterar');
		$username = $this->input->post("nome_usuario_alterar");
		$nome_completo = $this->input->post("nome_completo_alterar");
		$senha = $this->input->post("senha_alterar");
		$departamento = $this->input->post("departamento_usuario_alterar");

		if(empty($senha)){
			$opcao = 1;
		} else {
			$opcao = 2;
		}

		if (empty($username)) {
			$json["status"] = 0;
			$json["error_list"]["#username"] = "Usuário não pode ser vazio!";
		} else {
			$this->load->model("configuracoes_model");
			$result = $this->configuracoes_model->alterar_usuario($id_usuario,$username,$nome_completo,$senha,$departamento,$opcao);
			if ($result) {
				$json["status"] = 1;
			} else {
				$json["status"] = 0;
			}
		}

		echo json_encode($json);

	}

	public function excluirUsuario() {

		$id_usuario = $this->input->post('id_usuario');
		$this->load->model('configuracoes_model');

		$this->configuracoes_model->delete_usuario($id_usuario);

	}

	public function filtroUsuario() {

		$id_autorizada = $this->session->userdata('autorizada');
		$nome_completo = $this->input->post('filtro_nome_completo');
		$nome_usuario = $this->input->post('filtro_nome_usuario');
		$departamento = $this->input->post('filtro_departamento_usuario');

		if(!empty($nome_completo) && empty($nome_usuario) && $departamento == 0){
			$opcao = 1;
		} else if(empty($nome_completo) && !empty($nome_usuario) && $departamento == 0){
			$opcao = 2;
		} else if(empty($nome_completo) && empty($nome_usuario) && $departamento != 0){
			$opcao = 3;
		} else if(!empty($nome_completo) && !empty($nome_usuario) && $departamento == 0){
			$opcao = 4;
		} else if(!empty($nome_completo) && empty($nome_usuario) && $departamento != 0){
			$opcao = 5;
		} else if(!empty($nome_completo) && !empty($nome_usuario) && $departamento != 0){
			$opcao = 6;
		} else if(empty($nome_completo) && !empty($nome_usuario) && $departamento != 0){
			$opcao = 7;
		}

		$this->load->model('configuracoes_model');

		$data = array(
			'scripts'=>array(
				'configuracao.js'
			),
			'usuarios'=>$this->configuracoes_model->filtro_usuarios($id_autorizada,$nome_completo,$nome_usuario,$departamento,$opcao),
			'departamento'=>$this->configuracoes_model->departamento()
		);

		$this->load->view('configuracoes_usuarios',$data);

	}


}

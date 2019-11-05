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

}

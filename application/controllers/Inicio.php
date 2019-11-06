<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inicio extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library('session');
		$this->load->model("login_model");
		$autorizada = $this->login_model->info_autorizada($this->session->userdata('autorizada'))->result_array()[0];

		$this->session->set_userdata("nome_autorizada", $autorizada['nome_autorizada']);

		// index();	
	}


	public function index(){

		$this->load->model('pagina_inicial');

		$id_autorizada = $this->session->userdata('autorizada');
		$id_usuario = $this->session->userdata('id_usuario');

		$data = array(
			'os_aberta'=>$this->pagina_inicial->get_os_abertas($id_autorizada),
			'os_fechadas_ano'=>$this->pagina_inicial->get_os_fechadas_ano($id_autorizada),
			'prazos'=>$this->pagina_inicial->get_prazos($id_autorizada,$id_usuario),
			'pecasEstoqueMinima'=>$this->pagina_inicial->peçasEstoqueQtd($id_autorizada)
		);
		$this->load->view('header.php');
		$this->load->view('principal', $data);
	}

}

?>

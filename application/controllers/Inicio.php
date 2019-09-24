<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inicio extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library('session');

		// index();	
	}


	public function index(){

		$this->load->model('pagina_inicial');
		$data = array(
			'os_aberta'=>$this->pagina_inicial->get_os_abertas(),
			'os_fechadas_ano'=>$this->pagina_inicial->get_os_fechadas_ano(),
			'prazos'=>$this->pagina_inicial->get_prazos()
		);

		$this->load->view('principal', $data);
	}

}

?>
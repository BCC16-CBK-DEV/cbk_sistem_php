<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Estatisticas extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->library("session");
	}

	public function index()
	{

		$this->load->view('estatisticas');

	}

	public function qtdOs_ano() {

		$id_autorizada = $this->session->userdata('autorizada');
		$this->load->model('estatistica_model');

		$data = array(
			'qtdos_ano'=>$this->estatistica_model->est_qtdano($id_autorizada)->result_array()[0]
		);

		$this->load->view('est_qtdosano',$data);
	}

	public function lucroAnualOS() {

		$id_autorizada = $this->session->userdata('autorizada');

		$this->load->model('estatistica_model');

		$data = array(
			'lucro_ano'=>$this->estatistica_model->lucro_ano($id_autorizada)->result_array()[0]
		);

		$this->load->view('est_lucroAnualOs',$data);
	}

}?>

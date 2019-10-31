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

		$data = array(
			'scripts'=>array(
				'estatisticas.js'
			)
		);

		$this->load->view('estatisticas',$data);

	}

	public function graficos() {

		$id_autorizada = $this->session->userdata('autorizada');
		$id_grafico = $this->input->get('id');
		$this->load->model('estatistica_model');

		$data = array(
			'grafico'=>$this->estatistica_model->graficos_link($id_autorizada,$id_grafico)->result_array()[0]
		);

		$this->load->view('est_graficos',$data);
	}


}?>

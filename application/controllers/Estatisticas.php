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
		$this->load->view('est_qtdosano');
	}
}?>

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
		$this->load->view('novo_fornecedor');
	}

}

?>

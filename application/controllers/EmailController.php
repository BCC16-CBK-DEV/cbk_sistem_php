<?php


class EmailController extends CI_Controller
{
	public function __construct() {
		parent:: __construct();
		$this->load->helper('url');
	}

	public function send() {
		$this->load->config('email');
		$this->load->library('email');

		$this->email->set_newline("\r\n");
		$this->email->from('igor492@gmail.com');
		$this->email->to('igorcasconi@gmail.com');
		$this->email->subject('Teste');
		$this->email->message('Teste');
		//$this->email->send();

	}
}

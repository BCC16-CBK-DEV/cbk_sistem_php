<?php defined('BASEPATH') OR exit('No direct script access allowed');
//$this->load->library('email');
$config = array();
$config['protocol'] = 'smtp';
$config['charset'] = 'utf-8';
$config['smtp_host'] = 'ssl://smtp.gmail.com';
$config['smtp_user'] = 'igor492@gmail.com';
$config['smtp_pass'] = 'casconi12';
$config['smtp_port'] = 465;
$this->email->initialize($config);
$this->email->set_newline("\r\n");


?>

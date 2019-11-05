<?php


class Configuracoes_model extends CI_Model
{

	public function __construct() {
		parent:: __construct();
	}

	public function autorizada($id_autorizada){

		$this->db
			->select('*')
			->from('autorizada')
			->where('id_autorizada',$id_autorizada);

		return $this->db->get();
	}

	public function alterar_autorizada($nome,$email,$senha,$host,$porta,$protocolo,$id_autorizada,$opcao) {

		if($opcao == 1) {
			$data = array(
				'nome_autorizada' => $nome,
				'email_autorizada' => $email,
				'smtp_host_autorizada' => $host,
				'smtp_porta_autorizada' => $porta,
				'protocolo_email_autorizada' => $protocolo
			);

			$this->db->where('id_autorizada', $id_autorizada);
			$this->db->update('autorizada', $data);
		} else {

			$data = array(
				'nome_autorizada'=>$nome,
				'email_autorizada'=>$email,
				'senha_email_autorizada'=>$senha,
				'smtp_host_autorizada'=>$host,
				'smtp_porta_autorizada'=>$porta,
				'protocolo_email_autorizada'=>$protocolo
			);

			$this->db->where('id_autorizada',$id_autorizada);
			$this->db->update('autorizada',$data);

		}

	}

}

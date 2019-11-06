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

	public function usuarios($id_autorizada) {

		$this->db
			->select('*')
			->from('usuario')
			->join('departamento', 'usuario.id_departamento = departamento.id_departamento')
			->where('id_autorizada',$id_autorizada);

		return $this->db->get()->result_array();

	}

	public function departamento() {

		$this->db
			->select('*')
			->from('departamento');

		return $this->db->get()->result_array();

	}

	public function novo_usuario($username,$nome_completo,$senha,$departamento,$id_autorizada) {

		$data = array(
			'nome_usuario'=>$username,
			'nome_completo'=>$nome_completo,
			'senha'=>$senha,
			'id_departamento'=>$departamento,
			'id_autorizada'=>$id_autorizada
		);

		$this->db->insert('usuario',$data);

	}

	public function alterar_usuario($id_usuario,$username,$nome_completo,$senha,$departamento,$opcao) {

		if($opcao == 2) {
			$data = array(
				'nome_usuario' => $username,
				'nome_completo' => $nome_completo,
				'senha' => password_hash($senha,PASSWORD_DEFAULT),
				'id_departamento' => $departamento
			);

			$this->db->where('id_usuario', $id_usuario);
			$this->db->update('usuario', $data);

		} else {
			$data = array(
				'nome_usuario' => $username,
				'nome_completo' => $nome_completo,
				'id_departamento' => $departamento
			);

			$this->db->where('id_usuario', $id_usuario);
			$this->db->update('usuario', $data);
		}
	}

	public function carregar_usuario($id_usuario) {

		$this->db
			->select('*')
			->from('usuario')
			->where('id_usuario',$id_usuario);

		return $this->db->get();

	}

	public function delete_usuario($id_usuario){

		$this->db->where('id_usuario',$id_usuario);
		$this->db->delete('usuario');

	}

	public function filtro_usuarios($id_autorizada,$nome_completo,$nome_usuario,$departamento,$opcao) {

		switch ($opcao) {
			case 1:
				$where = ('id_autorizada ='.$id_autorizada.' AND nome_completo LIKE "%'.$nome_completo.'%"');

				$this->db
					->select('*')
					->from('usuario')
					->join('departamento', 'usuario.id_departamento = departamento.id_departamento')
					->where($where);

				$result = $this->db->get()->result_array();
				break;

			case 2:
				$where = ('id_autorizada ='.$id_autorizada.' AND nome_usuario LIKE "%'.$nome_usuario.'%"');

				$this->db
					->select('*')
					->from('usuario')
					->join('departamento', 'usuario.id_departamento = departamento.id_departamento')
					->where($where);

				$result = $this->db->get()->result_array();
				break;

			case 3:
				$where = ('id_autorizada ='.$id_autorizada.' AND usuario.id_departamento = '.$departamento);

				$this->db
					->select('*')
					->from('usuario')
					->join('departamento', 'usuario.id_departamento = departamento.id_departamento')
					->where($where);

				$result = $this->db->get()->result_array();
				break;

			case 4:
				$where = ('id_autorizada ='.$id_autorizada.' AND nome_completo LIKE "%'.$nome_completo.'%" AND 
				nome_usuario LIKE "%'.$nome_usuario.'%"');

				$this->db
					->select('*')
					->from('usuario')
					->join('departamento', 'usuario.id_departamento = departamento.id_departamento')
					->where($where);

				$result = $this->db->get()->result_array();
				break;

			case 5:
				$where = ('id_autorizada ='.$id_autorizada.' AND nome_completo LIKE "%'.$nome_completo.'%" AND 
				usuario.id_departamento = '.$departamento);

				$this->db
					->select('*')
					->from('usuario')
					->join('departamento', 'usuario.id_departamento = departamento.id_departamento')
					->where($where);

				$result = $this->db->get()->result_array();
				break;

			case 6:
				$where = ('id_autorizada ='.$id_autorizada.' AND nome_completo LIKE "%'.$nome_completo.'%" AND 
				nome_usuario LIKE "%'.$nome_usuario.'%" AND usuario.id_departamento = '.$departamento);

				$this->db
					->select('*')
					->from('usuario')
					->join('departamento', 'usuario.id_departamento = departamento.id_departamento')
					->where($where);

				$result = $this->db->get()->result_array();
				break;

			case 7:
				$where = ('id_autorizada ='.$id_autorizada.' AND nome_usuario LIKE "%'.$nome_usuario.'%" 
				AND usuario.id_departamento = '.$departamento);

				$this->db
					->select('*')
					->from('usuario')
					->join('departamento', 'usuario.id_departamento = departamento.id_departamento')
					->where($where);

				$result = $this->db->get()->result_array();
				break;

			default:
				$this->db
					->select('*')
					->from('usuario')
					->join('departamento', 'usuario.id_departamento = departamento.id_departamento')
					->where('id_autorizada',$id_autorizada);

				$result = $this->db->get()->result_array();
				break;
		}

		return $result;

	}

}

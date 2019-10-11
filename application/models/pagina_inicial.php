<?php

class Pagina_Inicial extends CI_Model
{
	
	public function __construct() {
		parent::__construct();
	}

	public function get_os_abertas() {

		$this->db
			->select("count(*)")
			->from("ordem_servico")
			->where("id_status", 1);

		$result_count_aberta = $this->db->get();

		if ($result_count_aberta->num_rows() > 0) {
			return $result_count_aberta->row();
		} else {
			return NULL;
		}
	}

	public function get_os_fechadas_ano() {

		$this->db
			->select("count(*)")
			->from("ordem_servico")
			->where("YEAR(data_abertura)", DATE('Y'))
			->where("id_status", 2);

		$result_count_fechadas = $this->db->get();

		if ($result_count_fechadas->num_rows() > 0) {
			return $result_count_fechadas->row();
		} else {
			return NULL;
		}
	}

	public function get_prazos() {
		$this->db
			->select('*')
			->from('ordem_servico')
			->join('cliente','ordem_servico.id_cliente = cliente.id_cliente')
			->where('ordem_servico.prazo_ordem > NOW()')
			->where('ordem_servico.prazo_ordem <> "0000-00-00"')
			->where('ordem_servico.prazo_ordem <> ""')
			->where('ordem_servico.id_status', 1)
			->order_by('prazo_ordem ASC')
			->limit(5);

		return $this->db->get()->result_array();

	}
}

?>

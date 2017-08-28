<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once APPPATH . 'core/MY_Model.php';

class Voto_model extends MY_Model{
	
	function get_many_by($id_articulo){
		$this->db->where('id_articulo', $id_articulo);
		$query = $this->db->get('votos');
		return $query->result();
	}

	function comprobar_voto($id_articulo, $ip){
		$this->db->where('id_articulo', $id_articulo);
		$this->db->where('ip', $ip);
		$votos = $this->Voto_model->get_all_votos();
		if(count($votos) == 0){
			return TRUE;
		} else {
			return FALSE;
		}
	}

	function insertVoto($voto_data){
		$this->db->insert('votos', $voto_data);
	}

	function get_all_votos(){
		$query=$this->db->get('votos');
		return $query->result();
	}
}

?>
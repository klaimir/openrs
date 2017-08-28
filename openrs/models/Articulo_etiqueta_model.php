<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once APPPATH . 'core/MY_Model.php';

class Articulo_etiqueta_model extends MY_Model{
	
	function insertArtEtiqueta($art_etiqueta_data){
		$query=$this->db->insert('articulo_etiquetas', $art_etiqueta_data);
		if($query){
			return $this->db->insert_id();
		}else{
			return -1;
		}
	}
}
?>
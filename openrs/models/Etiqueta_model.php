<?php defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'core/MY_Model.php';

class Etiqueta_model extends MY_Model{
	
	function get_etiquetas_articulo($id_articulo, $idioma){
		$this->db->join('articulo_etiquetas', 'articulo_etiquetas.id_etiqueta = etiquetas.id');
		$this->db->where('etiquetas.id_idioma', $idioma);
		$this->db->where('id_articulo', $id_articulo);
		$query=$this->db->get('etiquetas');
		return $query->result();
	}
	
	function insertEtiqueta($etiqueta_data){
		$query=$this->db->insert('etiquetas', $etiqueta_data);
		if($query){
			return $this->db->insert_id();
		}else{
			return -1;
		}
	}	
	
	function get_all_etiqueta($idioma){
		$this->db->where('id_idioma', $idioma);
		return $this->db->get('etiquetas')->result();
	}
	
	function etiquetas_favoritas($idioma){
		$this->db->select('*');
		$this->db->select('count(*) as repeticiones');
		$this->db->join('articulo_etiquetas', 'etiquetas.id = articulo_etiquetas.id_etiqueta');
		$this->db->join('articulos', 'articulos.id = articulo_etiquetas.id_articulo');
		$this->db->where('etiquetas.id_idioma', $idioma);
		$this->db->where('id_estado = 1');
		$this->db->group_by('id_etiqueta');
		$this->db->order_by('count(*)', 'DESC');
		$this->db->limit(10);
		$query=$this->db->get('etiquetas');
		return $query->result();
	}
	
	function borrar_etiquetas_articulo($id_articulo){
		$this->db->where('id_articulo', $id_articulo);
		$this->db->delete('articulo_etiquetas');
	}
	
// 	function etiquetas_sitemap(){
// 		$this->db->join('articulo_etiquetas', 'etiquetas.id = articulo_etiquetas.id_etiqueta');
// 		$this->db->join('articulos', 'articulos.id = articulo_etiquetas.id_articulo');
// 		$this->db->where('id_estado = 1');
// 		$this->db->group_by('id_etiqueta');
// 		$query=$this->db->get('etiquetas');
// 		return $query->result();;
// 	}
// 	function update($id_etiqueta,$etiqueta_data){
// 		$this->db->where('id',$id_etiqueta);
// 		$this->db->update('etiquetas', $etiqueta_data);
// 	}
}

?>
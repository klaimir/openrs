<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once APPPATH . 'core/MY_Model.php';

class Comentario_model extends MY_Model{
	function get_comentarios($id_articulo){
		$this->db->where('visible', 1);
		$this->db->where('id_articulo', $id_articulo);
		$this->db->order_by('num_mensaje_articulo', 'DESC');		
		$query=$this->db->get('comentarios_blog');
		return $query->result();
	}
	
	function max_num_mensaje_articulo($id_articulo){
		$this->db->where('id_articulo', $id_articulo);
		$query=$this->db->get('comentarios_blog');
		return count($query->result());
	}
	
	function insertar_comentario($datos){
		$this->db->insert('comentarios_blog',$datos);
	}
	
	function comentarios_articulo($id_articulo){
		$this->db->where('id_articulo',$id_articulo);
		$this->db->where('creado','desc');
		return $this->db->get('comentarios_blog')->result();
	}
	
	function get_comentario($id_comentario){
		$this->db->where('id', $id_comentario);
		return $this->db->get('comentarios_blog')->row();
	}
	
	function update_comentario($id_comentario, $datos){
		$this->db->where('id', $id_comentario);
		return $this->db->update('comentarios_blog', $datos);
	}
	
}

?>
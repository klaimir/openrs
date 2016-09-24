<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once APPPATH . '/core/MY_Model.php';

class Bloque_model extends MY_Model {
	
	public function get_bloques($estado,$idioma, $seccion=null){
		$this->db->join('bloque_idiomas', 'bloque_idiomas.id_bloque = bloque.id_bloque');
		$this->db->where('bloque_idiomas.id_idioma', $idioma);
		$this->db->where('id_estado',$estado);
		if($seccion!=null){
			$this->db->where('id_seccion',$seccion);
		}
		$this->db->order_by('prioridad', 'asc');
		$bloques = $this->db->get('bloque');
		return $bloques->result();
	}
	
	//Obtiene el contenido del bloque, ya sea carrusel, texto...
	public function get_contenido($bloque,$tipo_contenido, $idioma){		
		if($tipo_contenido=='texto'){
			$this->db->where('texto.id_bloque',$bloque);
			$this->db->join('texto_idiomas', 'texto_idiomas.id_texto = texto.id');
			$this->db->where('texto_idiomas.id_idioma', $idioma);
			$contenido = $this->db->get('texto');			
		}elseif($tipo_contenido=='carrusel'){
			$this->db->where('carrusel.id_bloque',$bloque);
			$contenido = $this->db->get('carrusel');
		}
		return $contenido->row();
	}
}
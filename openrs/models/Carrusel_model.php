<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once APPPATH . 'core/MY_Model.php';

class Carrusel_model extends MY_Model {

	function get_carrusel($id_carrusel){
		$this->db->where('id',$id_carrusel);
		$query=$this->db->get('carrusel');
		return $query->row();
	}

	function get_imagenes_carrusel($idioma, $id_carrusel,$limit=null){
		$this->db->join('bloque','bloque.id_bloque=carrusel.id_bloque');
		$this->db->join('bloque_idiomas', 'bloque_idiomas.id_bloque = bloque.id_bloque');
		$this->db->where('bloque_idiomas.id_idioma', $idioma);
		$this->db->join('imagen_carrusel','carrusel.id = imagen_carrusel.id_carrusel');
		$this->db->where('imagen_carrusel.id_carrusel', $id_carrusel);
		$this->db->join('imagen_carrusel_idiomas', 'imagen_carrusel_idiomas.id_imagen_carrusel = imagen_carrusel.id_imagen_carrusel');
		$this->db->where('imagen_carrusel_idiomas.id_idioma', $idioma);
		$this->db->order_by('imagen_carrusel.prioridad');
		$query = $this->db->get('carrusel');
		return $query->result();
	}
	
	function get_categorias_carrusel($idioma, $id_carrusel){
		if($idioma){
			$this->db->join('categoria_carrusel_idiomas', 'categoria_carrusel_idiomas.id_categoria_carrusel = categoria_carrusel.id');
			$this->db->where('categoria_carrusel_idiomas.id_idioma', $idioma);
		}
		$this->db->where('categoria_carrusel.id_carrusel', $id_carrusel);
		$this->db->order_by('categoria_carrusel.prioridad');
		$query = $this->db->get('categoria_carrusel');
		return $query->result();
	}
	
	function get_imagen_carrusel($idioma, $id_imagen_carrusel){
		$this->db->join('imagen_carrusel', 'imagen_carrusel.id_imagen_carrusel = imagen_carrusel_idiomas.id_imagen_carrusel');
		$this->db->where('id_idioma', $idioma);
		$this->db->where('imagen_carrusel_idiomas.id_imagen_carrusel', $id_imagen_carrusel);
		return $this->db->get('imagen_carrusel_idiomas')->row();
	}
	
	function get_imagenes($idioma, $id_carrusel){
		$this->db->where('imagen_carrusel.id_carrusel', $id_carrusel);
		if($idioma){
			$this->db->join('imagen_carrusel_idiomas', 'imagen_carrusel_idiomas.id_imagen_carrusel = imagen_carrusel.id_imagen_carrusel');
			$this->db->where('imagen_carrusel_idiomas.id_idioma', $idioma);		
		}
		$this->db->order_by('prioridad');
		$query = $this->db->get('imagen_carrusel');
		return $query->result();
	}

	function get_categoria_carrusel($idioma, $id_categoria_carrusel){
		$this->db->join('categoria_carrusel_idiomas', 'categoria_carrusel_idiomas.id_categoria_carrusel = categoria_carrusel.id');
		$this->db->where('categoria_carrusel_idiomas.id_idioma', $idioma);		
		$this->db->where('id',$id_categoria_carrusel);
		$query = $this->db->get('categoria_carrusel');
		return $query->row();
	}
	
// 	function get_imagenes_bloque($id_bloque){
// 		$this->db->join('bloque','bloque.id_bloque=carrusel.id_bloque');
// 		$this->db->join('imagen_carrusel','carrusel.id=imagen_carrusel.id_carrusel');
// 		$this->db->where('carrusel.id_bloque', $id_bloque);
// 		$this->db->order_by('imagen_carrusel.prioridad');
// 		$query = $this->db->get('carrusel');
// 		return $query->result();
// 	}
	
// 	function get_imagen_carrusel($id_imagen_carrusel){
// 		$this->db->where('id_imagen_carrusel',$id_imagen_carrusel);
// 		$query = $this->db->get('imagen_carrusel');
// 		return $query->row();
// 	}
	function get_imagen_carrusel_seo($idioma, $titulo_seo){
		$this->db->join('imagen_carrusel_idiomas', 'imagen_carrusel_idiomas.id_imagen_carrusel = imagen_carrusel.id_imagen_carrusel');
		$this->db->where('imagen_carrusel_idiomas.id_idioma', $idioma);
		$this->db->where('imagen_carrusel_idiomas.titulo_seo',$titulo_seo);
		$query = $this->db->get('imagen_carrusel');
		return $query->result();
	}
	
// 	function get_tipo_carrusel(){
// 		$query=$this->db->get('tipo_carrusel');
// 		return $query->result();
// 	}
// 	//Borrar
// 	public function delete_carrusel($id_carrusel){
// 		$this->db->where('id',$id_carrusel);
// 		$this->db->delete('carrusel');
// 	}
// 	public function delete_imagen($id_imagen_carrusel){
// 		$this->db->where('id_imagen_carrusel',$id_imagen_carrusel);
// 		$this->db->delete('imagen_carrusel');
// 	}
// 	public function delete_categoria($id_categoria){
// 		$this->db->where('id',$id_categoria);
// 		$this->db->delete('categoria_carrusel');
// 	}
// 	/* Funciones antiguas del carrusel */
// 	function insertar_imagen_carrusel($id_imagen_carrusel, $prioridad, $titulo =NULL, $texto=NULL){

// 		return $this->db->insert('carrusel', array('imagen' => $id_imagen_carrusel, 'prioridad' => $prioridad, 'titulo_carrusel' => $titulo, 'texto_carrusel' => $texto));
// 	}
	
// 	function cargar_imagenes_carrusel(){
// 		$this->db->order_by('prioridad', 'asc');
// 		return $this->db->get('carrusel')->result();
// 	}
	
// 	function borrar_imagen_carrusel($id_imagen_carrusel){
// 		return $this->db->delete('carrusel', array('id_imagen_carrusel' => $id_imagen_carrusel));
// 	}
	
// 	function extraer_imagen_carrusel($id_imagen_carrusel){
// 		$this->db->where('id_imagen_carrusel', $id_imagen_carrusel);
// 		return $this->db->get('carrusel')->row();
// 	}
	
// 	public function max_prioridad_carrusel($id_carrusel){
// 		$this->db->select('max(prioridad) as prioridad');
// 		$this->db->from('imagen_carrusel');
// 		$this->db->where('id_carrusel',$id_carrusel);
// 		$query = $this->db->get();
// 		$datos = $query->row();
// 		if($datos)
// 			return $datos->prioridad;
// 		else
// 			return 0;
// 	}
	
// 	public function cambiar_prioridad_carrusel($id_imagen_carrusel, $prioridad){
// 		$datos = array('prioridad' => $prioridad);
// 		$this->db->where('id_imagen_carrusel', $id_imagen_carrusel);
// 		$this->db->update('carrusel', $datos);
// 	}
	
// 	public function buscar_carrusel_prioridad($prioridad){
// 		$this->db->where('prioridad', $prioridad);
// 		$query = $this->db->get('carrusel');
// 		return $query->row();
// 	}
	
// 	public function editar_imagen_carrusel($id_imagen_carrusel, $titulo, $texto){
// 		$this->db->where('id_imagen_carrusel', $id_imagen_carrusel);
// 		return $this->db->update('carrusel', array('titulo_carrusel' => $titulo, 'texto_carrusel' => $texto));
// 	}

}

?>
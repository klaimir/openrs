<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once APPPATH . 'core/MY_Model.php';

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
        
        //Para el carrusel: Obtiene las imágenes del carrusel dada la id del carrusel
	public function get_carrusel($carrusel,$idioma, $limit=null){
		$this->db->where('id_carrusel',$carrusel);
		$this->db->join('imagen_carrusel_idiomas', 'imagen_carrusel_idiomas.id_imagen_carrusel = imagen_carrusel.id_imagen_carrusel');
		$this->db->where('imagen_carrusel_idiomas.id_idioma', $idioma);
		$this->db->order_by('prioridad');
		if($limit!=null && $limit!=0){
			$this->db->limit($limit);
		}
		$query = $this->db->get('imagen_carrusel');
		return $query->result();
	}
	
	public function update_carrusel($id_imagen_carrusel, $idioma, $datos){
		$this->db->where('id_imagen_carrusel',$id_imagen_carrusel);
		$this->db->where('id_idioma',$idioma);
		return $this->db->update('imagen_carrusel_idiomas', $datos);
	}
        
        public function getBloqueInmuebles($id_bloque){
            $this->db->where('idbloque_inmuebles',$id_bloque);
            return $this->db->get('bloque_inmuebles')->row();
        }
        
        public function updateBloqueInmuebles($idbloque_inmuebles, $datos){
            $this->db->where('idbloque_inmuebles',$idbloque_inmuebles);
            $this->db->update('bloque_inmuebles',$datos);
        }
        
        public function getBloqueFrontend($id_bloque){
            $this->db->where('id_bloque',$id_bloque);
            return $this->db->get('bloque_inmuebles')->row();
        }
        
        public function getInmueblesBloque($tipo, $limit, $idioma){
            $this->db->select('inmuebles.*, inmuebles.id as idinmueble, inmuebles_idiomas.*,inmuebles_imagenes.*, tipos_inmueble_idiomas.nombre as tipo_inmueble');
            $this->db->from('inmuebles');
            $this->db->join('inmuebles_idiomas', 'inmuebles.id=inmuebles_idiomas.inmueble_id');
            $this->db->join('inmuebles_imagenes', 'inmuebles_idiomas.inmueble_id=inmuebles_imagenes.inmueble_id');
            $this->db->join('tipos_inmueble_idiomas', 'inmuebles.tipo_id=tipos_inmueble_idiomas.tipo_inmueble_id');
            $this->db->where('inmuebles_idiomas.idioma_id', $idioma);
            $this->db->where('tipos_inmueble_idiomas.idioma_id', $idioma);
            if ($tipo == 1) {
                $this->db->where('inmuebles.destacado', 1);
            } elseif ($tipo == 2) {
                $this->db->where('inmuebles.oportunidad', 1);
            }
            $this->db->where('inmuebles.publicado', 1);
            $this->db->where('inmuebles_imagenes.portada',1);
            $this->db->limit($limit);
            return $this->db->get()->result();
        }
}
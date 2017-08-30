<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once APPPATH . 'core/MY_Model.php';

class Seccion_model extends MY_Model {
	
	public function get_secciones_header($idioma, $visible = 1){
		$this->db->join('seccion_idiomas', 'seccion.id = seccion_idiomas.id_seccion');
		$this->db->where('seccion_idiomas.id_idioma', $idioma);
		$this->db->where('menu',$visible);
		$this->db->order_by('prioridad', 'asc');
		return $this->db->get('seccion')->result();
	}
	
	public function get_super_secciones($idioma, $visible = 1){
		$this->db->join('super_seccion_idiomas', 'super_seccion.id = super_seccion_idiomas.id_super_seccion');
		$this->db->where('super_seccion_idiomas.id_idioma', $idioma);
		$this->db->where('footer',$visible);
		$this->db->order_by('prioridad', 'asc');
		return $this->db->get('super_seccion')->result();
	}
	
	public function get_secciones($idioma, $super_seccion=null){
		if($super_seccion!=null){
			$this->db->where('id_super_seccion',$super_seccion);
		}
		$this->db->join('seccion_idiomas', 'seccion.id = seccion_idiomas.id_seccion');
		$this->db->where('seccion_idiomas.id_idioma', $idioma);
		$this->db->order_by('prioridad', 'asc');
		return $this->db->get('seccion')->result();
	}
	
	public function get_secciones_footer($idioma){
		$this->db->from('seccion');
		$this->db->join('seccion_idiomas', 'seccion.id = seccion_idiomas.id_seccion');
		$this->db->where('seccion_idiomas.id_idioma', $idioma);
		$this->db->where('seccion.footer',1);
		$this->db->order_by('prioridad', 'asc');
		return $this->db->get('')->result();
	}

	public function get_subsecciones_header($idioma){
		$this->db->join('seccion_idiomas', 'seccion.id = seccion_idiomas.id_seccion');
		$this->db->where('seccion_idiomas.id_idioma', $idioma);
		$this->db->where('desplegable',1);
		$this->db->order_by('prioridad', 'asc');
		return $this->db->get('seccion')->result();
	}
	
	public function get_seccion_nombre($idioma, $seccion){
		$this->db->join('seccion_idiomas', 'seccion.id = seccion_idiomas.id_seccion');
		$this->db->where('seccion_idiomas.id_idioma', $idioma);
		//$this->db->where('id_estado',1);
		$this->db->where('url_seo',$seccion);
		$query=$this->db->get('seccion');
		return $query->row();
	}

	public function get_seccion($idioma, $id_seccion){
		$this->db->join('seccion_idiomas', 'seccion.id = seccion_idiomas.id_seccion');
		$this->db->where('seccion_idiomas.id_idioma', $idioma);
		$this->db->where('id',$id_seccion);
		return $this->db->get('seccion')->row();
	}
	
	public function listar_secciones($idioma, $id_super_seccion=null){
		$this->db->join('seccion_idiomas', 'seccion.id = seccion_idiomas.id_seccion');
		$this->db->where('seccion_idiomas.id_idioma', $idioma);
		if($id_super_seccion!=null)
			$this->db->where('id_super_seccion',$id_super_seccion);
		return $this->db->get('seccion')->result();
	}
	
	public function get_lista_super_secciones($idioma){
		$this->db->join('super_seccion_idiomas', 'super_seccion.id = super_seccion_idiomas.id_super_seccion');
		$this->db->where('super_seccion_idiomas.id_idioma', $idioma);
	 	$this->db->order_by('prioridad', 'asc');
		return $this->db->get('super_seccion')->result();
	}
	
	public function get_super_seccion($idioma, $id_super_seccion){
		$this->db->join('super_seccion_idiomas', 'super_seccion.id = super_seccion_idiomas.id_super_seccion');
		$this->db->where('super_seccion_idiomas.id_idioma', $idioma);
		$this->db->where('id',$id_super_seccion);
		return $this->db->get('super_seccion')->row();
	}
	
	public function get_seccion_bloque($idioma, $id_bloque){
		$this->db->distinct('url_seo');
		$this->db->join('seccion_idiomas', 'seccion.id = seccion_idiomas.id_seccion');
		$this->db->where('seccion_idiomas.id_idioma', $idioma);
		$this->db->join('bloque','bloque.id_seccion=seccion.id');
		$this->db->where('id_bloque',$id_bloque);
		return $this->db->get('seccion')->row();
	}
	//Bloques
	public function listar_bloques($idioma, $url_seccion, $mostrar_todos = 1){
		if($mostrar_todos)
			$this->db->select('bloque.id_estado as estado, bloque.id_bloque, bloque_idiomas.titulo_bloque as titulo, bloque.prioridad as prioridad, seccion_idiomas.url_seo as url_seo');
		else
			$this->db->select('bloque.id_estado as estado, bloque.id_bloque, bloque.prioridad as prioridad, seccion_idiomas.url_seo as url_seo');
		$this->db->join('seccion','seccion.id = bloque.id_seccion');
		$this->db->join('seccion_idiomas', 'seccion.id = seccion_idiomas.id_seccion');
		if($mostrar_todos){
			$this->db->join('bloque_idiomas', 'bloque.id_bloque = bloque_idiomas.id_bloque');
			$this->db->where('bloque_idiomas.id_idioma', $idioma);
		}
		$this->db->where('seccion_idiomas.id_idioma', $idioma);
		$this->db->where('seccion_idiomas.url_seo',$url_seccion);
		$this->db->order_by('prioridad','asc');
		return $this->db->get('bloque')->result();
	}
	
	public function get_bloque($idioma, $id_bloque){
		if($idioma){
			$this->db->join('bloque_idiomas', 'bloque.id_bloque = bloque_idiomas.id_bloque');
			$this->db->where('bloque_idiomas.id_idioma', $idioma);
		}
		$this->db->where('bloque.id_bloque',$id_bloque);
		return $this->db->get('bloque')->row();
	}
	
	//Al crear el bloque creamos el bloque y su relación con el contenido
	public function crear_bloque($tabla,$data_bloque, $tipo_bloque, $idiomas){
		$this->db->insert($tabla,$data_bloque);
		$id_bloque = $this->db->insert_id();
		if($tipo_bloque=='1' || $tipo_bloque=='3' || $tipo_bloque=='4' || $tipo_bloque=='6' || $tipo_bloque=='7'){ //texto
			$this->db->insert('texto',array('id_bloque'=>$id_bloque));
			$id_texto = $this->db->insert_id();
			foreach($idiomas as $idioma){
				$this->db->insert('texto_idiomas',array('id_bloque'=>$id_bloque, 'id_texto'=>$id_texto, 'id_idioma' => $idioma->id_idioma));
			}
		}else if($tipo_bloque=='2'){ //carrusel
			$this->db->insert('carrusel',array('id_bloque'=>$id_bloque));
                }elseif($tipo_bloque=='5'){ //productos
                    $this->db->insert('bloque_inmuebles',array('id_bloque'=>$id_bloque));
                }
		return $id_bloque;
	}
	
	public function get_bloque_txt($idioma, $id_bloque){
		if($idioma){
			$this->db->join('texto_idiomas', 'texto.id = texto_idiomas.id_texto');
			$this->db->where('texto_idiomas.id_idioma', $idioma);
		}
		$this->db->where('texto.id_bloque',$id_bloque);
		return $this->db->get('texto')->row();
	}
	
	//Bloque de texto
	public function get_bloque_texto($idioma, $id_texto){
		//$this->db->join('bloque','bloque.id_bloque = texto.id_bloque');
		$this->db->join('texto_idiomas', 'texto.id = texto_idiomas.id_texto');
		$this->db->where('texto_idiomas.id_idioma', $idioma);
		$this->db->where('id',$id_texto);
		return $this->db->get('texto')->row();
	}
        
        public function get_bloque_carrusel($id_bloque){
		$this->db->where('id_bloque',$id_bloque);
		return $this->db->get('carrusel')->row();
	}
        
        public function get_bloque_inmuebles($id_bloque){
            $this->db->where('id_bloque',$id_bloque);
            return $this->db->get('bloque_inmuebles')->row();
        }
        
        public function update_bloque($id, $datos){
            $this->db->where('id_bloque',$id);
            $this->db->update('bloque', $datos);
        }

        public function update_bloque_idiomas($id, $datos, $idioma){
            $this->db->where('id_bloque',$id);
            $this->db->where('id_idioma',$idioma);
            $this->db->update('bloque_idiomas', $datos);
        }
}
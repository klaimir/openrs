<?php defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'core/MY_Model.php';

class Articulo_model extends MY_Model{
	
	function get_articulos($id_usuario, $id_estado = NULL, $idioma = NULL){
		$this->db->select('*');
		$this->db->select('articulos.id as id_articulo');
		$this->db->join('articulos_idiomas', 'articulos.id = articulos_idiomas.id_articulo');
		$this->db->where('articulos_idiomas.id_idioma', $idioma);
		if($id_estado != NULL)
			$this->db->where('id_estado', $id_estado);
		/*$this->db->where('id_autor', $id_usuario);*/
		$this->db->order_by('creado','desc');
		$query=$this->db->get('articulos');
		return $query->result();
	}
	
	function get_categorias($idioma){
		$this->db->select('*');
		$this->db->from('categoria_blog');
		$this->db->join('categoria_blog_idiomas','categoria_blog.id=categoria_blog_idiomas.id_categoria');
		$this->db->where('categoria_blog_idiomas.id_idioma', $idioma);
		$this->db->order_by('categoria_blog.creada','desc');
		return $this->db->get()->result();
	}
	
	function get_categorias_articulo($id_articulo, $idioma){
		$this->db->from('articulo_categorias');
		$this->db->join('categoria_blog_idiomas', 'articulo_categorias.id_categoria = categoria_blog_idiomas.id_categoria');
		$this->db->where('categoria_blog_idiomas.id_idioma', $idioma);
		$this->db->where('articulo_categorias.id_articulo', $id_articulo);
		return $this->db->get()->result();
	}
	
	function existe_url_seo_categorias($url_seo){
		$this->db->where('url_seo_categoria_blog', $url_seo);
		return count($this->db->get('categoria_blog_idiomas')->result());
	}
	
	function insert_categoria($categoria_data){
		$query=$this->db->insert('categoria_blog', $categoria_data);
		if($query){
			return $this->db->insert_id();
		}else{
			return -1;
		}
	}
	
	function insertar_idioma_categoria($datos){
		$this->db->insert('categoria_blog_idiomas', $datos);
	}
	
	function insert_categoria_articulo($datos){
		$this->db->insert('articulo_categorias', $datos);
	}
	
	function borrar_categorias_articulo($id_articulo){
		$this->db->where('id_articulo',$id_articulo);
		$this->db->delete('articulo_categorias');
	}
	
	function getc($id_categoria, $idioma = NULL){
		$this->db->join('categoria_blog_idiomas', 'categoria_blog.id = categoria_blog_idiomas.id_categoria');
		if($idioma)
			$this->db->where('id_idioma', $idioma);
		$this->db->where('id', $id_categoria);
		return $this->db->get('categoria_blog')->row();
	}
	
	function update_categoria($id_categoria, $categoria_data){
		$this->db->where('id',$id_categoria);
		$this->db->update('categoria_blog', $categoria_data);
	}
	
	function update_categoria_idioma($id_categoria, $id_idioma, $categoria_data){
		$this->db->where('id_idioma', $id_idioma);
		$this->db->where('id_categoria',$id_categoria);
		$query=$this->db->get('categoria_blog_idiomas');
		if($query->num_rows() > 0){
			$this->db->where('id_idioma', $id_idioma);
			$this->db->where('id_categoria',$id_categoria);
			$this->db->update('categoria_blog_idiomas', $categoria_data);
		}else{
			$categoria_data=array('id_categoria'=>$id_categoria,'id_idioma'=>$id_idioma);
			$this->db->insert('categoria_blog_idiomas', $categoria_data);
		}
			
	}
	
	function eliminar_categoria($id_categoria){
		$this->db->where('id',$id_categoria);
		$this->db->delete('categoria_blog');
		$this->db->where('id_categoria',$id_categoria);
		$this->db->delete('categoria_blog_idiomas');
		$this->db->where('id_categoria',$id_categoria);
		$this->db->delete('articulo_categorias');
	}
	
	function categoria_asignada($id_categoria, $id_articulo){
		$this->db->where('id_categoria',$id_categoria);
		$this->db->where('id_articulo', $id_articulo);
		$query=$this->db->get('articulo_categorias');
		if($query->num_rows() == 1){
			return true;
		}else{
			return false;
		}
	}
	
	function insertArticulo($articulo_data){
		$query=$this->db->insert('articulos', $articulo_data);
		if($query){
			return $this->db->insert_id();
		}else{
			return -1;
		}
	}	
	
	function existe_url_seo($url_seo, $id_articulo = NULL){
		if($id_articulo)
			$this->db->where('id_articulo != '.$id_articulo);
		$this->db->where('url_seo_articulo', $url_seo);
		return count($this->db->get('articulos_idiomas')->result());
	}
	
	function updateById($id_articulo,$articulo_data){
		$this->db->where('id',$id_articulo);
		$this->db->update('articulos', $articulo_data);
	}
	
	function getById($id_articulo, $idioma = NULL){
		$this->db->join('articulos_idiomas', 'articulos.id = articulos_idiomas.id_articulo');
		if($idioma)
			$this->db->where('id_idioma', $idioma);
		$this->db->where('id', $id_articulo);
		return $this->db->get('articulos')->row();
	}

	//Obtiene el artículo con estado "publicado" anterior al artículo seleccionado
	function articulo_anterior($id_articulo, $idioma, $id_autor = NULL){
		$this->db->join('articulos_idiomas', 'articulos.id = articulos_idiomas.id_articulo');
		$this->db->where('id_idioma', $idioma);
		$this->db->where('id < '.$id_articulo);
		$this->db->where('id_estado','1');
		if($id_autor)
			$this->db->where('id_autor', $id_usuario);
		$this->db->order_by('id', 'DESC');
		$this->db->limit(1);
		return $this->db->get('articulos')->result();
	}
	
	//Obtiene el artículo con estado "publicado" siguiente al artículo seleccionado
	function articulo_siguiente($id_articulo, $idioma, $id_autor = NULL){
		$this->db->join('articulos_idiomas', 'articulos.id = articulos_idiomas.id_articulo');
		$this->db->where('id_idioma', $idioma);
		$this->db->where('id > '.$id_articulo);
		$this->db->where('id_estado','1');
		if($id_autor)
			$this->db->where('id_autor', $id_usuario);
		$this->db->order_by('id', 'ASC');
		$this->db->limit(1);
		return $this->db->get('articulos')->result();
	}
	
	//Articulos relacionados con un articulo dado mediante etiquetas
	function get_articulos_relacionados($id_articulo, $idioma, $etiquetas= NULL, $id_autor = NULL){
		//Preparo el contenido del where
		$where='';
		if($etiquetas != NULL){
			$where = $where.'(';
			$primero = TRUE;
			foreach($etiquetas as $etiq){
				if($primero == TRUE)
					$where = $where.' id_etiqueta = '.$etiq->id_etiqueta;
				else
					$where = $where.' OR id_etiqueta = '.$etiq->id_etiqueta;
				$primero = FALSE;
			}
			$where = $where.') ';
			$this->db->where($where);
		}	
		$this->db->select('*');
		$this->db->select('count(*)');
		$this->db->join('articulo_etiquetas', 'articulos.id = articulo_etiquetas.id_articulo');
		$this->db->join('articulos_idiomas', 'articulos.id = articulos_idiomas.id_articulo');
		$this->db->join('etiquetas', 'etiquetas.id = articulo_etiquetas.id_etiqueta');
		$this->db->where('id_estado', 1);
		$this->db->where('articulos.id <>'. $id_articulo);
		$this->db->where('etiquetas.id_idioma', $idioma);
		$this->db->where('articulos_idiomas.id_idioma', $idioma);
		if($id_autor)
			$this->db->where('id_autor', $id_autor);
		$this->db->group_by('articulo_etiquetas.id_articulo');
		$this->db->order_by('count(*)', 'DESC');
		$this->db->limit(4);
		return $this->db->get('articulos')->result();
	}	
	
	//Artículos ordenados por visitas
	function articulos_populares($idioma, $id_autor = NULL){
		$this->db->join('articulos_idiomas', 'articulos.id = articulos_idiomas.id_articulo');
		$this->db->where('id_estado', 1);
		if($id_autor)
			$this->db->where('id_autor', $id_autor);
		$this->db->where('articulos_idiomas.id_idioma', $idioma);
		$this->db->limit(6);
		$this->db->order_by('visitas', 'DESC');
		$query=$this->db->get('articulos');
		return $query->result();
	}
	
	function articulos_votados($idioma, $id_autor = NULL){
		$this->db->select('*');
		$this->db->select('count(*)');
		$this->db->join('votos', 'votos.id_articulo = articulos.id');
		$this->db->join('articulos_idiomas', 'articulos.id = articulos_idiomas.id_articulo');
		$this->db->where('articulos_idiomas.id_idioma', $idioma);
		if($id_autor)
			$this->db->where('id_autor', $id_autor);
		$this->db->where('id_estado = 1');
		$this->db->group_by('votos.id_articulo');
		$this->db->order_by('count(*)', 'DESC');
		$this->db->limit(6);
		$query=$this->db->get('articulos');
		return $query->result();
	}
	
//Listado de artículos publicados. Preparado para paginación
	function articulos_publicados($idioma, $limit = NULL, $desde = NULL, $etiqueta = NULL){
		$this->db->select('*');
		$this->db->select('articulos.id as id_articulo');
		
		if($etiqueta != NULL){
			$this->db->join('articulo_etiquetas', 'articulos.id = articulo_etiquetas.id_articulo');
			$this->db->join('etiquetas', 'etiquetas.id = articulo_etiquetas.id_etiqueta');
			$this->db->where('etiquetas.id', $etiqueta);
			$this->db->where('etiquetas.id_idioma', $idioma);
		}
		$this->db->join('articulos_idiomas', 'articulos_idiomas.id_articulo = articulos.id');
		$this->db->where('articulos_idiomas.id_idioma', $idioma);
		$this->db->where('id_estado', 1);
		if($limit != NULL && $desde != NULL){
			$this->db->limit($limit, $desde);
		}
		$this->db->order_by('creado', 'DESC');
		$articulos= $this->db->get('articulos');
		return $articulos->result();
	}
	
	function articulos_publicados_x_categoria($idioma, $limit = NULL, $desde = NULL, $categoria = NULL){
		$this->db->select('*');
		$this->db->select('articulos.id as id_articulo');
	
		if($categoria != NULL){
			$this->db->join('articulo_categorias', 'articulos.id = articulo_categorias.id_articulo');
			$this->db->join('categoria_blog_idiomas', 'categoria_blog_idiomas.id_categoria = articulo_categorias.id_categoria');
			$this->db->where('categoria_blog_idiomas.id_categoria', $categoria);
			$this->db->where('categoria_blog_idiomas.id_idioma', $idioma);
		}
		$this->db->join('articulos_idiomas', 'articulos_idiomas.id_articulo = articulos.id');
		$this->db->where('articulos_idiomas.id_idioma', $idioma);
		$this->db->where('id_estado', 1);
		if($limit != NULL && $desde != NULL){
			$this->db->limit($limit, $desde);
		}
		$this->db->order_by('creado', 'DESC');
		$articulos= $this->db->get('articulos');
		return $articulos->result();
	}
	
//Listado de artículos publicados. Preparado para paginación
	function articulos_publicados_etiqueta($etiqueta = NULL){
		$this->db->select('*');
		$this->db->select('articulos.id as id_articulo');
	
		if($etiqueta != NULL){
			$this->db->join('articulo_etiquetas', 'articulos.id = articulo_etiquetas.id_articulo');
			$this->db->join('etiquetas', 'etiquetas.id = articulo_etiquetas.id_etiqueta');
			$this->db->where('etiquetas.id', $etiqueta);
		}
		$this->db->where('id_estado', 1);
		$this->db->order_by('creado', 'DESC');
		$articulos= $this->db->get('articulos');
		return $articulos->result();
	}
	
	function articulos_publicados_categoria($categoria = NULL){
		$this->db->select('*');
		$this->db->select('articulos.id as id_articulo');
	
		if($categoria != NULL){
			$this->db->join('articulo_categorias', 'articulos.id = articulo_categorias.id_articulo');
			$this->db->join('categoria_blog_idiomas', 'categoria_blog_idiomas.id_categoria = articulo_categorias.id_categoria');
			$this->db->where('categoria_blog_idiomas.id_categoria', $categoria);
		}
		$this->db->where('id_estado', 1);
		$this->db->order_by('creado', 'DESC');
		$articulos= $this->db->get('articulos');
		return $articulos->result();
	}
	
	function insertar_idioma($datos){
		$this->db->insert('articulos_idiomas', $datos);
	}
	
	function update_idioma($id_articulo,$id_idioma, $articulo_data){
		$this->db->where('id_idioma', $id_idioma);
		$this->db->where('id_articulo',$id_articulo);
		$this->db->update('articulos_idiomas', $articulo_data);
	}
	
	function ultimos_articulos($idioma, $limit){
		$this->db->select('*');
		$this->db->select('articulos.id as id_articulo');
		$this->db->join('articulos_idiomas', 'articulos_idiomas.id_articulo = articulos.id');
		$this->db->where('articulos_idiomas.id_idioma', $idioma);
		$this->db->where('id_estado', 1);
		$this->db->limit($limit);
		$this->db->order_by('creado', 'DESC');
		$articulos= $this->db->get('articulos');
		return $articulos->result();
	}
// 	function articulos_portada(){
// 		$this->db->where('id_estado', 1);
// 		$this->db->limit(3);
// 		$this->db->order_by('creado', 'DESC');
// 		$query=$this->db->get('articulos');
// 		return $query->result();
// 	}
}

?>
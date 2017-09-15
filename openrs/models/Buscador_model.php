<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once APPPATH . 'core/MY_Model.php';

class Buscador_model extends MY_Model {
    
        public function getInmuebleBuscador($idioma, $filtros=NULL, $total=NULL){
        	$this->db->select('v_inmuebles.*, v_inmuebles.id as idinmueble, inmuebles_idiomas.*,inmuebles_imagenes.*');
        	$this->db->from('v_inmuebles');
        	$this->db->join('inmuebles_idiomas','v_inmuebles.id=inmuebles_idiomas.inmueble_id');
        	$this->db->join('inmuebles_imagenes','inmuebles_idiomas.inmueble_id=inmuebles_imagenes.inmueble_id');
        	$this->db->where('inmuebles_idiomas.idioma_id',$idioma);
        	if (isset($filtros['tipo_id']) && $filtros['tipo_id'] > 0)
                {
                    $this->db->where('v_inmuebles.tipo_id', $filtros['tipo_id']);
                }
                // Filtro Provincia
                if (isset($filtros['provincia_id']) && !empty($filtros['provincia_id']) && $filtros['provincia_id'] >= 0)
                {
                    $this->db->where('v_inmuebles.provincia_id', $filtros['provincia_id']);
                }
                // Filtro Población
                if (isset($filtros['poblacion_id']) && !empty($filtros['poblacion_id']) && $filtros['provincia_id'] >= 0)
                {
                    $this->db->where('v_inmuebles.poblacion_id', $filtros['poblacion_id']);
                }
                // Filtro Zona
                if (isset($filtros['zona_id']) && !empty($filtros['zona_id']))
                {
                    $this->db->where('v_inmuebles.zona_id', $filtros['zona_id']);
                }
        	if(isset($filtros['oferta_id']) && $filtros['oferta_id'] > 0){
                    // Ofertas        
                    switch ($filtros['oferta_id'])
                    {
                        case 1:
                            $this->db->where('v_inmuebles.precio_compra > 0');
                            break;
                        case 2:
                            $this->db->where('v_inmuebles.precio_alquiler > 0');
                            break;
                        case 3:
                            $this->db->where('v_inmuebles.precio_compra > 0');
                            $this->db->where('v_inmuebles.precio_alquiler > 0');
                            break;
                        default:
                            break;
                    }
        	}
        	if (isset($filtros['precios_desde']) && $filtros['precios_desde'] != '')
                {
                    $precio_desde=$filtros['precios_desde'];
                    $this->db->where("((precio_compra <> 0 AND precio_compra >= '$precio_desde') OR (precio_alquiler <> 0 AND precio_alquiler >= '$precio_desde'))");
                }
                if (isset($filtros['precios_hasta']) && $filtros['precios_hasta']  != '')
                {
                    $precio_hasta=$filtros['precios_hasta'];
                    $this->db->where("((precio_compra <> 0 AND precio_compra <= '$precio_hasta') OR (precio_alquiler <> 0 AND precio_alquiler <= '$precio_hasta'))");
                }
        	if (isset($filtros['habitaciones_desde']) && $filtros['habitaciones_desde'] >0)
                {
                    $this->db->where('v_inmuebles.habitaciones >=', $filtros['habitaciones_desde']);
                }
        	if (isset($filtros['banios_desde']) && $filtros['banios_desde'] >0)
                {
                    $this->db->where('v_inmuebles.banios >=', $filtros['banios_desde']);
                }
                if (isset($filtros['metros_desde']) && $filtros['metros_desde'] >0)
                {
                    $this->db->where('v_inmuebles.metros >=', $filtros['metros_desde']);
                }
                $this->db->where('v_inmuebles.publicado', 1);
		$this->db->where('inmuebles_imagenes.portada',1);
                $this->db->where('v_inmuebles.idioma_id',$idioma);
                if($total){
                    return $this->db->get()->num_rows();
                }else{
                    $this->db->limit(12, $filtros['start']);
                    return $this->db->get()->result();
                }
        }
        
        public function getInmuebleById($idioma, $id, $publicado=NULL){
        	$this->db->from('v_inmuebles');
        	$this->db->join('inmuebles_idiomas', 'inmuebles_idiomas.inmueble_id = v_inmuebles.id');
			$this->db->where('v_inmuebles.id',$id);
                        $this->db->where('inmuebles_idiomas.idioma_id',$idioma);
			$this->db->where('v_inmuebles.idioma_id',$idioma);
            if($publicado){
                $this->db->where('v_inmuebles.publicado',$publicado);
            }
			return $this->db->get()->row();
		}
        
        public function getImagenesInmueble($id){
            $this->db->where('inmueble_id',$id);
            $this->db->where('publicada',1);
            return $this->db->get('inmuebles_imagenes')->result();
        }
        
        public function getExtrasInmueble($idioma, $id){
            $this->db->select('opciones_extras_idiomas.nombre');
            $this->db->from('inmuebles_opciones_extras');
            $this->db->join('opciones_extras_idiomas','inmuebles_opciones_extras.opcion_extra_id=opciones_extras_idiomas.opcion_extra_id');
            $this->db->where('inmuebles_opciones_extras.inmueble_id',$id);
            $this->db->where('opciones_extras_idiomas.idioma_id',$idioma);
            return $this->db->get()->result();
        }
        
        public function getLugaresInmueble($idioma, $id){
            $this->db->select('lugares_interes_idiomas.nombre');
            $this->db->from('lugares_interes_idiomas');
            $this->db->join('inmuebles_lugares_interes','inmuebles_lugares_interes.lugar_interes_id=lugares_interes_idiomas.lugar_interes_id');
            $this->db->where('inmuebles_lugares_interes.inmueble_id',$id);
            $this->db->where('lugares_interes_idiomas.idioma_id',$idioma);
            return $this->db->get()->result();
        }
        
        public function getVideoInmueble($id){
            $this->db->select('titulo, url');
            $this->db->where('inmueble_id',$id);
            $this->db->where('publicado',1);
            $this->db->where('youtube',1);
            $this->db->limit(1);
            return $this->db->get('inmuebles_enlaces')->row();
        }
        
        public function getEnlacesInmueble($id){
            $this->db->select('titulo, url');
            $this->db->where('inmueble_id',$id);
            $this->db->where('publicado',1);
            $this->db->where('youtube',0);
            return $this->db->get('inmuebles_enlaces')->result();
        }
        
        public function getCEInmueble($id){
            $this->db->select('tipos_certificacion_energetica.id, tipos_certificacion_energetica.nombre, inmuebles.kwh_m2_anio');
            $this->db->from('tipos_certificacion_energetica');
            $this->db->join('inmuebles','inmuebles.certificacion_energetica_id = tipos_certificacion_energetica.id');
            $this->db->where('inmuebles.id',$id);
            return $this->db->get()->row();
        }
        
        public function getInmuebleByReferencia($idioma, $referencia){
            $this->db->select('inmuebles.id, inmuebles_idiomas.url_seo');
            $this->db->from('inmuebles');
            $this->db->join('inmuebles_idiomas','inmuebles.id=inmuebles_idiomas.inmueble_id');
            $this->db->where('inmuebles_idiomas.idioma_id',$idioma);
            $this->db->where('inmuebles.referencia',$referencia);
            return $this->db->get()->row();
        }
}


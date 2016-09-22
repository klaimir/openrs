<?php defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . '/core/MY_Model.php';

class Idioma_model extends MY_Model
{

    public function __construct()
    {        
        parent::__construct();
    }
    
    public function get_idiomas_subidos_activos(){
    	$this->db->where('subido', 1);
    	$this->db->where('activo', 1);
    	return $this->db->get('idiomas')->result();
    }
    
    function get_usuario_idioma($id_usuario){
    	$this->db->select('idiomas.nombre, idiomas.id_idioma, idiomas.nombre_seo2');
    	$this->db->from('users');
    	$this->db->join('idiomas', 'users.id_idioma = idiomas.id_idioma');
    	$this->db->where('id', $id_usuario);
    	return $this->db->get()->row();
    }
    
    public function get_idioma($id){
    	$this->db->where('id_idioma', $id);
    	return $this->db->get('idiomas')->row();
    }
    
    public function get_id_idioma_by_nombre($nombre_seo2){
    	$this->db->where('nombre_seo2', $nombre_seo2);
    	return $this->db->get('idiomas')->row();
    }
}

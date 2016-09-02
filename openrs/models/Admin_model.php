<?php defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . '/core/MY_Model.php';

class Admin_model extends MY_Model
{

    public function __construct()
    {        
        parent::__construct();
    }
    
    /************************************************/
    /* Recibe: id usuario                           */
    /* Devuelve: row datos configuración de usuario */
    /************************************************/
    public function datos_config($user){
    	$this->db->where('user_id',$user);
    	return $this->db->get('config')->row();
    }
    
    /***********************************************************************/
    /* Recibe: id usuario y array de datos                                 */
    /* Devuelve: nada (actualiza datos de la tabla config según parámetros)*/
    /***********************************************************************/
    public function actualizar_configuracion($id_user, $datos){
    	$this->db->where('user_id', $id_user);
    	$this->db->update('config', $datos);
    }
    
    /******************************************/
    /* Recibe: nada                           */
    /* Devuelve: result con opciones para pie */
    /******************************************/
    public function get_footer_opciones(){
    	return $this->db->get('footer_opciones')->result();
    }
    
    /**********************************************************************/
    /* Recibe: id usuario y numero columna pie                            */
    /* Devuelve: row con la opción de pie para esa columna y su contenido */
    /**********************************************************************/
    public function get_footer_cliente($iduser, $col){
    	$this->db->select('*');
    	$this->db->from('footer_opciones');
    	$this->db->join('footer_opciones_cliente', 'footer_opciones.id_opc = footer_opciones_cliente.id_opc');
    	$this->db->where('footer_opciones_cliente.iduser', $iduser);
    	$this->db->where('columna', $col);
    	return $this->db->get('')->row();
    }
    
    /***********************************************************************/
    /* Recibe: id usuario y numero columna pie                             */
    /* Devuelve: nada. (borra el contenido de esa columna para el usuario) */
    /***********************************************************************/
    function borrar_columna_pie($id_user, $col){
    	$this->db->delete('footer_opciones_cliente', array('iduser'=>$id_user, 'columna'=>$col));
    }
    
    /***********************************************************************/
    /* Recibe: id opción                                                   */
    /* Devuelve: nada. (borra el contenido según id opción)                */
    /***********************************************************************/
    function borrar_texto_columna($id){
    	$this->db->delete('footer_texto_idiomas', array('id_opc_cliente'=>$id));
    }
    
    function actualizar_pie_cliente($iduser, $columna, $opc, $num_art=NULL){
    	$this->db->where('iduser',$iduser);
    	$this->db->where('columna',$columna);
    	$query=$this->db->get('footer_opciones_cliente');
    	if($query->num_rows()== 1){
    		$this->db->where('iduser',$iduser);
    		$this->db->where('columna',$columna);
    		if($num_art != NULL)
    			$this->db->update('footer_opciones_cliente', array('id_opc'=>$opc, 'num_articulos'=>$num_art));
    		else
    			$this->db->update('footer_opciones_cliente', array('id_opc'=>$opc));
    	}else{
    		if($num_art != NULL)
    			$this->db->insert('footer_opciones_cliente', array('iduser'=>$iduser, 'id_opc'=>$opc, 'columna'=>$columna, 'num_articulos'=>$num_art));
    		else
    			$this->db->insert('footer_opciones_cliente', array('iduser'=>$iduser, 'id_opc'=>$opc, 'columna'=>$columna));
    	}
    }
    
    function actualizar_red_social($id_user, $datos){
    	$this->db->where('user_id', $id_user);
    	$this->db->update('config', $datos);
    }
    function limpiar_red_social($id_user, $red){
    	$this->db->where('user_id', $id_user);
    	if($red == 'facebook')
    		$this->db->update('config', array('facebook'=>NULL));
    	elseif($red == 'twitter')
    	$this->db->update('config', array('twitter'=>NULL));
    	elseif($red == 'google')
    	$this->db->update('config', array('google'=>NULL));
    	elseif($red == 'linkedin')
    	$this->db->update('config', array('linkedin'=>NULL));
    	elseif($red == 'vimeo')
    	$this->db->update('config', array('vimeo'=>NULL));
    }
}

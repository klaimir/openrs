<?php defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . '/core/MY_Model.php';

class Usuario_model extends MY_Model
{

    public function __construct()
    {        
        parent::__construct();
        $this->load->model('Idioma_model');
    }
    
    /************************* SECURITY *************************/
    
    public function check_access_conditions($datos)
    {
        return TRUE;
    }

    function check_delete($id)
    {
        // Comprobación Borrado de datos relacionados
        if ($id !== 1)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    function delete_usuario($id)
    {
        return $this->ion_auth_model->delete_user($id);
    }

    /**
     * Determina si un determinado usuario es agente inmobiliario
     *
     * @param [id]			Identificador del usuario
     *
     * @return valor formateado
     */
    public function is_agente($id = false)
    {
        $agente_group = $this->config->item('agente_group', 'ion_auth');
        return $this->ion_auth->in_group($agente_group, $id);
    }

    /**
     * Determina si un determinado usuario es administrador
     *
     * @param [id]			Identificador del usuario
     *
     * @return valor formateado
     */
    public function is_admin($id = false)
    {
        return $this->ion_auth->is_admin($id);
    }
    
    function modificar_idioma_usuario($id, $id_idioma){
    	$this->db->where('id', $id);
    	return $this->db->update('users', array('id_idioma' => $id_idioma));
    }
    
    function get_usuario_idioma($id_usuario){
    	$this->db->select('idiomas.nombre, idiomas.id_idioma, idiomas.nombre_seo2');
    	$this->db->from('users');
    	$this->db->join('idiomas', 'users.id_idioma = idiomas.id_idioma');
    	$this->db->where('id', $id_usuario);
    	return $this->db->get()->row();
    }
    
    function get_columnas_pie(){
    	$this->db->where('iduser', 1);
    	$this->db->where('id_opc > 0');
    	$this->db->order_by('columna', 'asc');
    	return $this->db->get('footer_opciones_cliente')->result();
    }
    
    function get_codigo_pie($id, $idioma){
    	$this->db->where('id_opc_cliente',$id);
    	$this->db->where('id_idioma',$idioma);
    	return $this->db->get('footer_texto_idiomas')->row()->contenido;
    }
    
    function get_lang($id_usuario){
    	$idioma_usuario=$this->get_usuario_idioma($id_usuario);
        $idioma=$this->Idioma_model->get_idioma($idioma_usuario->id_idioma);
        return $idioma->carpeta_idioma;
    }

}

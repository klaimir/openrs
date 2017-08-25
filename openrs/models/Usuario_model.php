<?php defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'core/MY_Model.php';

class Usuario_model extends MY_Model
{

    public function __construct()
    {        
        parent::__construct();
        
        $this->table = 'users';
        $this->primary_key = 'id';
        
        $this->has_many['inmuebles'] = array('local_key'=>'id', 'foreign_key'=>'captador_id', 'foreign_model'=>'Inmueble_model'); 
        $this->has_many['clientes'] = array('local_key'=>'id', 'foreign_key'=>'agente_asignado_id', 'foreign_model'=>'Cliente_model');
        $this->has_many['demandas'] = array('local_key'=>'id', 'foreign_key'=>'agente_asignado_id', 'foreign_model'=>'Demanda_model');
        $this->has_many['inmuebles_fichas'] = array('local_key'=>'id', 'foreign_key'=>'agente_id', 'foreign_model'=>'Inmueble_ficha_model'); 
        $this->has_many['inmuebles_carteles'] = array('local_key'=>'id', 'foreign_key'=>'agente_id', 'foreign_model'=>'Inmueble_cartel_model'); 
        $this->has_many['clientes_fichas'] = array('local_key'=>'id', 'foreign_key'=>'agente_id', 'foreign_model'=>'Cliente_ficha_model');
        $this->has_many['demandas_fichas'] = array('local_key'=>'id', 'foreign_key'=>'agente_id', 'foreign_model'=>'Demanda_ficha_model');
        $this->has_many['backups'] = array('local_key'=>'id', 'foreign_key'=>'admin_id', 'foreign_model'=>'Backup_model');
        
        $this->load->model('Idioma_model');
    }
    
    /************************* SECURITY *************************/
    
    public function check_access_conditions($datos)
    {
        return TRUE;
    }
    
    /**
     * Devuelve el número de administradores del sistema sin contar el indicado
     *
     * @return int
     */
    
    function get_num_admins($user_id)
    {
        // Array de agentes
        return $this->db->select('id')
                                ->where($this->ion_auth_model->tables['users_groups'].'.group_id',1)
                                ->where($this->ion_auth_model->tables['users_groups'].'.user_id <>',$user_id)
		                ->get($this->ion_auth_model->tables['users_groups'])
                                ->num_rows();
    }
    
    /**
     * Comprueba que el usuario especificado puede almacenarse con los permisos establecidos
     *
     * @param [id]			Identificador del usuario
     * @param [groups]                  Grupos de usuario
     *
     * @return TRUE OR FALSE
     */
    function check_user($id, $groups)
    {
        if($this->check_unique_admin($id, $groups) && $this->check_user_datas($id, $groups))
        {
            return TRUE;
        }
        
        return FALSE;
    }
    
    /**
     * Comprueba que el usuario especificado no tiene datos relacionados que afecten al rol de agente
     *
     * @param [id]			Identificador del usuario
     * @param [groups]                  Grupos de usuario
     *
     * @return TRUE OR FALSE
     */
    function check_user_datas($id, $groups)
    {      
        // Se comprueba que no se puede eliminar el agente al estar relacionado
        if(!in_array(2, $groups))
        {
            $info=$this->with_clientes()->with_inmuebles()->with_demandas()->get($id);
            // Si es admin y es el único del sistema
            if (count($info->clientes) || count($info->inmuebles) || count($info->demandas))
            {
                $this->set_error("No se puede quitar el permiso de agente ya que está asignado a algún inmueble, demanda o cliente");
                return FALSE;
            }
        }
        
        return TRUE;
    }
    
    /**
     * Comprueba que el usuario especificado no se le puede quitar el permiso de administrador por ser el único
     *
     * @param [id]			Identificador del usuario
     * @param [groups]                  Grupos de usuario
     *
     * @return TRUE OR FALSE
     */
    function check_unique_admin($id, $groups)
    {        
        // Si es admin y es el único del sistema
        if($this->is_admin($id) && $this->get_num_admins($id)==0)
        {
            // Se comprueba que no se puede eliminar el permiso de admin ya que debe haber al menos un admin
            if(!in_array(1, $groups))
            {
                $this->set_error("No se puede quitar permiso de administrador al único administrador del sistema");
                return FALSE;
            }
        }
        
        return TRUE;
    }

    function check_delete($id)
    {
        // Comprobación Borrado de datos relacionados
        if ($id == $this->data['session_user_id'])
        {
            $this->set_error("No se puede eliminar al usuario en curso");
            return FALSE;
        }
        
        // Si es admin y es el único del sistema, no se puede eliminar, debe haber al menos un admin
        if($this->is_admin($id) && $this->get_num_admins($id)==0)
        {
            $this->set_error("No se puede eliminar al único administrador del sistema");
            return FALSE;
        }
        
        $info=$this->with_clientes()->with_inmuebles()->with_demandas()->with_inmuebles_fichas()->with_inmuebles_carteles()->with_clientes_fichas()
                ->with_demandas_fichas()->with_backups()->get($id);
        if (count($info->clientes) || count($info->inmuebles) || count($info->demandas) || count($info->inmuebles_fichas) || count($info->inmuebles_carteles)
            || count($info->clientes_fichas) || count($info->demandas_fichas) || count($info->backups))
        {
            $this->set_error("El usuario seleccionado tiene datos asociados");
            return FALSE;
        }
        
        return TRUE;
    }

    /**
     * Elimina al usuario especificado del sistema
     *
     * @param [id]			Identificador del usuario
     *
     * @return TRUE OR FALSE
     */
    function delete_usuario($id)
    {
        return $this->ion_auth_model->delete_user($id);
    }

    /**
     * Determina si un determinado usuario es agente inmobiliario
     *
     * @param [id]			Identificador del usuario
     *
     * @return TRUE OR FALSE
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
     * @return TRUE OR FALSE
     */
    public function is_admin($id = false)
    {
        return $this->ion_auth->is_admin($id);
    }
        
    /**
     * Devuelve un array de agentes en formato dropdown
     *
     * @return array de agentes en formato dropdown
     */
    
    function get_agentes_dropdown($default_value="", $agentes_sin_asignar=FALSE)
    {
        // Array de agentes
        $agentes=$this->db->select($this->ion_auth_model->tables['users'].'.*')
		                ->join($this->ion_auth_model->tables['users_groups'], $this->ion_auth_model->tables['users_groups'].'.user_id'.'='.$this->ion_auth_model->tables['users'].'.id')
                                ->where($this->ion_auth_model->tables['users_groups'].'.group_id',2)
		                ->get($this->ion_auth_model->tables['users'])
                                ->result();
        // Drop down
        $array_agentes=$this->dropdown($agentes);
        // Selección inicial
        $seleccion[$default_value]="- Seleccione agente -";
        if($agentes_sin_asignar)
        {
            $seleccion[0]="- Sin asignar agente -";
        }
        // Suma de ambos
        return ($seleccion+$array_agentes);
    }  
    
    function dropdown($object_array) {
        // Datos necesarios
        $array_valores=array();        
        // Eliminamos repetidos de objetos
        if($object_array)
        {
            foreach($object_array as $object) {
                    $array_valores[$object->id]=$object->last_name.", ".$object->first_name;
            }
        }
        return $array_valores;
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
        return $this->Idioma_model->get_idioma($idioma_usuario->id_idioma);
    }    

}

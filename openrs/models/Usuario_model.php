<?php defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . '/core/MY_Model.php';

class Usuario_model extends MY_Model
{

    public function __construct()
    {        
        parent::__construct();
        $this->load->model('Idioma_model');
    }

    public function test_names()
    {
        $datas = $this->form_validation->validation_data['validation_datas_test_names'];
        if ($datas['first_name'] == $datas['last_name'])
        {
            return TRUE;
        }
        else
        {
            $this->form_validation->set_message("test_names", "holaaaaaaaaaa");
            return FALSE;
        }
    }
    
    public function set_rules()
    {
        $rules_first_name = array(
                'required',
                array('test_names', array($this->Usuario_model, 'test_names'))
            );
        $this->form_validation->set_rules('first_name', $this->lang->line('create_user_validation_fname_label'), $rules_first_name);
        $this->form_validation->set_rules('last_name', 'Apellidos', 'required');
    }
    
    public function set_rules_datas()
    {
        /*
          $data = array(
          'first_name' => '',
          'last_name' => ''
          ); */
        $data = $this->input->post();
        $data['validation_datas_test_names'] = array('first_name' => $data['first_name'], 'last_name' => $data['last_name']);
        $this->form_validation->set_data($data);
    }
    
    public function _set_datas_html() {
        $data['first_name'] = array(
            'name' => 'first_name',
            'id' => 'first_name',
            'type' => 'text',
            'value' => $this->form_validation->set_value('first_name'),
        );

        $data['last_name'] = array(
            'name' => 'last_name',
            'id' => 'last_name',
            'type' => 'text',
            'value' => $this->form_validation->set_value('last_name'),
        );
        
        return $data;
    }  
    
    public function _get_formatted_datas() {
        $datas=$this->input->post();
        return $datas;
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

    function delete_all($id)
    {
        // Notificaciones
        //$this->deleteNotificaciones($datos_personales->id);
        // Borrado de ficheros físicos de carpeta de usuario
        if (file_exists(FCPATH . "downloads/usuarios/" . $id))
        {
            $this->utilities->full_rmdir(FCPATH . "downloads/usuarios/" . $id);
        }
        // Borrado del usuario final
        return 1; //$this->ion_auth_model->delete_user($id);
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

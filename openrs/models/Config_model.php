<?php defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'core/MY_Model.php';

class Config_model extends MY_Model
{

    public function __construct()
    {
        $this->table = 'config_admin';
        $this->primary_key = 'id';
        
        parent::__construct();
    }
    
    /************************* SECURITY *************************/
    
    public function check_access_conditions($datos)
    {
        return TRUE;
    }
    
    /************************* FORMS *************************/
    
    /**
     * Establece las reglas utilizadas para la validación de datos
     * 
     * @param [id]                  Indentificador del elemento
     *
     * @return void
     */
    
    public function set_rules($id=0)
    {
        $this->form_validation->set_rules('email_contacto', 'Email de contacto', 'xss_clean|max_length[120]|valid_email');
        $this->form_validation->set_rules('api_key', 'API-KEY de google', 'xss_clean|max_length[50]');
        $this->form_validation->set_rules('google_analytics_ID', 'API-KEY de google', 'xss_clean|max_length[20]');
    }
    
    /**
     * Ejecuta las validaciones
     *
     * @return void
     */
    public function validation($id=0)
    {    
        // Rules
        $this->set_rules($id);
        
        // Other functions validations
        
        // Run form validation        
        return $this->form_validation->run();
    }

    /**
     * Establece los datos para su visualización en HTML
     *
     * @param [id]                  Indentificador del elemento
     *
     * @return array con los datos especificados para utilizarlos en los diferentes helpers
     */
    
    public function set_datas_html($datos=NULL)
    {        
        $data['email_contacto'] = array(
            'name' => 'email_contacto',
            'id' => 'email_contacto',
            'type' => 'text',
            'value' => $this->form_validation->set_value('email_contacto',is_object($datos) ? $datos->email_contacto : ""),
        );
        
        $data['google_api_key'] = array(
            'name' => 'google_api_key',
            'id' => 'google_api_key',
            'type' => 'text',
            'value' => $this->form_validation->set_value('google_api_key',is_object($datos) ? $datos->google_api_key : ""),
        );
        
        $data['google_analytics_ID'] = array(
            'name' => 'google_analytics_ID',
            'id' => 'google_analytics_ID',
            'type' => 'text',
            'value' => $this->form_validation->set_value('google_analytics_ID',is_object($datos) ? $datos->google_analytics_ID : ""),
        );

        return $data;
    }

    /**
     * Devuelve los datos formateado de la interfaz
     *
     * @return array con los datos formateado
     */
    
    public function get_formatted_datas()
    {
        $datas['email_contacto'] = $this->input->post('email_contacto');
        $datas['google_api_key'] = $this->input->post('google_api_key');
        $datas['google_analytics_ID'] = $this->input->post('google_analytics_ID');
        return $datas;
    }
    
    /**
     * Formatea los datos introducidos por el usuario y actualiza un registro en la base de datos
     *
     * @param [id]                  Indentificador del elemento
     *
     * @return void
     */
    
    function edit($id)
    {
        // Formatted datas
        $formatted_datas=$this->get_formatted_datas();        
        // Parent update
        return $this->update($formatted_datas,$id);
    }
    
    /**
     * Devuelve configuración del sistema
     *
     * @return void
     */    
    function get_config()
    {
        return $this->get_by_id(1);
    }

}

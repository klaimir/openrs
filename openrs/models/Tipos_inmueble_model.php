<?php defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . '/core/MY_Model.php';

class Tipos_inmueble_model extends MY_Model
{

    public function __construct()
    {
        $this->table = 'tipos_inmueble';
        $this->primary_key = 'id_tipo';                
        $this->has_many['inmuebles'] = array('local_key'=>'id_tipo', 'foreign_key'=>'tipo', 'model'=>'Inmuebles_model');
        
        parent::__construct();
    }
    
    /************************* SECURITY *************************/
    
    public function check_access_conditions()
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
        $this->form_validation->set_rules('nombre_tipo', 'Tipo del inmueble', 'required');
    }

    /**
     * Establece la procedencia de los datos utilizados para la validación, por defecto es el POST pero podría ser un array (por ejemplo validación desde un CSV)
     *
     * @return array con los datos especificados para utilizarlos en los diferentes helpers
     */
    
    public function set_rules_datas()
    {
        $data = $this->input->post();
        $this->form_validation->set_data($data);
    }

    /**
     * Establece los datos para su visualización en HTML
     *
     * @param [id]                  Indentificador del elemento
     *
     * @return array con los datos especificados para utilizarlos en los diferentes helpers
     */
    
    public function set_datas_html($id=0)
    {
        // Caso para diferenciar la edición de la inserción
        /*
        $nombre_tipo_value="";
        if($id)
        {
            $nombre_tipo_value=$this->m_model->datas->nombre_tipo;
        }
         * 
         */
        
        $data['nombre_tipo'] = array(
            'name' => 'nombre_tipo',
            'id' => 'nombre_tipo',
            'type' => 'text',
            'value' => $this->form_validation->set_value('nombre_tipo',isset($this->m_model->datas->nombre_tipo) ? $this->m_model->datas->nombre_tipo : ""),
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
        $datas['nombre_tipo'] = $this->input->post('nombre_tipo');
        return $datas;
    }

    /**
     * Comprueba si semánticamente, es posible eliminar el elemento indicado
     *
     * @param [id]                  Indentificador del elemento
     *
     * @return void
     */
    
    function check_delete($id)
    {        
        if (count($this->with_inmuebles()->get($id)->inmuebles))
        {
            return FALSE;
        }
        else
        {
            return TRUE;
        }
    }

}

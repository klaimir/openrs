<?php defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . '/core/MY_Model.php';

class Tipo_inmueble_model extends MY_Model
{

    public function __construct()
    {
        $this->table = 'tipos_inmueble';
        $this->primary_key = 'id';                
        $this->has_many['inmuebles'] = array('local_key'=>'id', 'foreign_key'=>'tipo_id', 'model'=>'Inmuebles_model');
        
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
        $this->form_validation->set_rules('nombre_tipo', 'Tipo del inmueble', 'required');
    }
    
    /**
     * Ejecuta las validaciones
     *
     * @return void
     */
    public function validation()
    {    
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
        $data['nombre_tipo'] = array(
            'name' => 'nombre_tipo',
            'id' => 'nombre_tipo',
            'type' => 'text',
            'value' => $this->form_validation->set_value('nombre_tipo',isset($datos) ? $datos->nombre : ""),
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
        $datas['nombre'] = $this->input->post('nombre');
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
    
    function create()
    {
        // Formatted datas
        $formatted_datas=$this->get_formatted_datas();                
        // Parent insert
        return $this->insert($formatted_datas);
    }
    
    function edit($id)
    {
        // Formatted datas
        $formatted_datas=$this->get_formatted_datas();        
        // Parent update
        return $this->update($formatted_datas,$id);
    }

}

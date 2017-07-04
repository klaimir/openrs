<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'models/Documento_generado_model.php';

class Demanda_ficha_model extends Documento_generado_model
{

    public function __construct()
    {
        parent::__construct();
        
        $this->table = 'demandas_fichas';
        $this->view = 'v_demandas_fichas';
        $this->primary_key = 'id';
        
        $this->has_one['demanda'] = array('local_key' => 'id', 'foreign_key' => 'demanda_id', 'foreign_model' => 'Demanda_model');

        // Carga de modelos
        $this->load->model('Plantilla_documentacion_model');
    }

    /*     * *********************** SECURITY ************************ */

    public function check_access_conditions($datos)
    {
        return TRUE;
    }

    /*     * *********************** FORMS ************************ */

    /**
     * Establece las reglas utilizadas para la validación de datos
     * 
     * @param [id]                  Indentificador del elemento
     *
     * @return void
     */
    public function set_rules($id = 0)
    {
        if($id)
        {
            $this->form_validation->set_rules('html', 'Contenido de la ficha', 'required');
        }
        else
        {
            $this->form_validation->set_rules('plantilla_id', 'Plantilla', 'required');
        }
    }

    /**
     * Ejecuta las validaciones
     *
     * @return void
     */
    public function validation($id = 0)
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
    public function set_datas_html($datos = NULL)
    {
        if(is_object($datos))
        {            
            $data['html'] = array(
                'name' => 'html',
                'id' => 'html',
                'type' => 'text',
                'value' => $this->form_validation->set_value('html', is_object($datos) ? $this->utilities->process_html($datos->html) : ""),
            );
        }
        else
        {
            // Selector de plantillas
            $data['plantillas'] = $this->Plantilla_documentacion_model->get_dropdown(5);                
            $data['plantilla_id'] = $this->form_validation->set_value('plantilla_id', is_object($datos) ? $datos->plantilla_id : "");
        }

        return $data;
    }

    /**
     * Devuelve los datos formateado de la interfaz
     *
     * @return array con los datos formateado
     */
    public function get_formatted_datas_insert()
    {        
        $datas['plantilla_id'] = $this->input->post('plantilla_id');
        $datas['demanda_id'] = $this->demanda_id;
        $datas['agente_id'] = $this->data['session_user_id'];
        $datas['fecha'] = date("Y-m-d");
        $html=$this->generar_html_ficha($datas['demanda_id'],$datas['plantilla_id'],$datas['agente_id']);
        // Hay que quitar el dominio local
        $datas['html'] = $this->utilities->process_html($html,'input');
        return $datas;
    }
    
    /**
     * Devuelve los datos formateado de la interfaz
     *
     * @return array con los datos formateado
     */
    public function get_formatted_datas_edit()
    {
        $datas['html'] = $this->utilities->process_html($this->input->post('html'),'input');
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
        return TRUE;
    }

    /**
     * Formatea los datos introducidos por el usuario y crea un registro en la base de datos
     *
     * @return void
     */
    
    function create()
    {
        // Borramos antes por concurrencia
        $this->delete(array("demanda_id" => $this->demanda_id));
        // Formatted datas
        $formatted_datas=$this->get_formatted_datas_insert();                
        // Parent insert
        return $this->insert($formatted_datas);
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
        $formatted_datas=$this->get_formatted_datas_edit();        
        // Parent update
        return $this->update($formatted_datas,$id);
    }
    
    /**
     * Devuelve los fichas adjuntos de un determinado demanda
     *
     * @param [demanda_id]                  Indentificador del elemento
     *
     * @return void
     */
    function get_fichas_demanda($demanda_id)
    {
        $this->db->from($this->table);
        $this->db->where('demanda_id', $demanda_id);
        return $this->db->get()->row();
    }    
    
    /**
     * Formatea los datos introducidos por el usuario y crea un registro en la base de datos
     *
     * @return void
     */
    function generar_html_ficha($demanda_id,$plantilla_id,$agente_id)
    {
        // Establecemos los identificadores necesarios para generar el documento
        $this->demanda_id=$demanda_id;
        $this->plantilla_id=$plantilla_id;
        $this->agente_id=$agente_id;
        // Aplicamos datos de la plantilla
        $this->aplicar_plantilla();
        // Devolemos el HTML generado
        return $this->html;
    }
    
    /**
     * Devuelve el ficha correspondiente al demanda
     *
     * @return array de datos de plantilla
     */
    
    function get_by_demanda($demanda_id)
    {
        return $this->get(array("demanda_id" => $demanda_id));
    }
    
    /**
     * Elimina el fichero del sistema de ficheros y de la bd
     *
     * @param [$ficha]        Datos del fichero en la base de datos
     *
     * @return void
     */
    function remove($ficha)
    {
        if($this->delete($ficha->id))
        {
            return TRUE;
        }
        else
        {
            $this->set_error(lang('common_error_delete'));
            return FALSE;
        }
    }

}

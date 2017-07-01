<?php defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'core/MY_Model.php';

class Plantilla_documentacion_model extends MY_Model
{

    public function __construct()
    {
        $this->table = 'plantillas_documentacion';
        $this->primary_key = 'id';
                
        parent::__construct();
        
        // Cargamos modelo de tipos de plantilla
        $this->load->model('Tipo_plantilla_documentacion_model');
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
        $this->form_validation->set_rules('nombre', 'Nombre de la plantilla', 'required|is_unique_global[plantillas_documentacion;' . $id . ';nombre;id]|max_length[100]|xss_clean');
        $this->form_validation->set_rules('descripcion', 'Descripción de la plantilla', 'xss_clean|max_length[255]');
        $this->form_validation->set_rules('tipo_plantilla_id', 'Tipo de plantilla', 'required');
        $this->form_validation->set_rules('html', 'Texto de la plantilla', 'required');
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
        // Plantillas
        $data['tipos_plantillas'] = $this->Tipo_plantilla_documentacion_model->as_dropdown('nombre')->get_all();
                
        // Datos
        $data['nombre'] = array(
            'name' => 'nombre',
            'id' => 'nombre',
            'type' => 'text',
            'value' => $this->form_validation->set_value('nombre',is_object($datos) ? $datos->nombre : ""),
        );
        
        $data['descripcion'] = array(
            'name' => 'descripcion',
            'id' => 'descripcion',
            'type' => 'text',
            'value' => $this->form_validation->set_value('descripcion',is_object($datos) ? $datos->descripcion : ""),
        );
        
        $data['tipo_plantilla_id']=$this->form_validation->set_value('tipo_plantilla_id',is_object($datos) ? $datos->tipo_plantilla_id : "");

        $data['html'] = array(
            'name' => 'html',
            'id' => 'html',
            'type' => 'text',
            'value' => $this->form_validation->set_value('html',is_object($datos) ? $this->utilities->process_html($datos->html) : ""),
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
        $datas['descripcion'] = $this->input->post('descripcion');
        $datas['tipo_plantilla_id'] = $this->input->post('tipo_plantilla_id');
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
        if (count($this->with_documentos_generados()->get($id)->documentos_generados))
        {
            return FALSE;
        }
        else
        {
            return TRUE;
        }
    }
    
    /**
     * Formatea los datos introducidos por el usuario y crea un registro en la base de datos
     *
     * @return void
     */
    
    function create()
    {
        // Formatted datas
        $formatted_datas=$this->get_formatted_datas();                
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
        $formatted_datas=$this->get_formatted_datas();        
        // Parent update
        return $this->update($formatted_datas,$id);
    }
    
    /**
     * Lee todas las plantillas con el tipo formateado
     *
     * @return array de datos de plantilla
     */
    
    function get_all_for_table()
    {
        // Lista de campos
        $fieldslist=$this->utilities->getFieldsTable($this->table); 
        $this->db->select($fieldslist.',tipos_plantilla_documentacion.nombre as nombre_tipo_plantilla');
        $this->db->from($this->table);
        $this->db->join($this->Tipo_plantilla_documentacion_model->table, $this->Tipo_plantilla_documentacion_model->table.'.'.$this->Tipo_plantilla_documentacion_model->primary_key.'='.$this->table.'.tipo_plantilla_id');
        return $this->db->get()->result();
    }
    
    /**
     * Duplica los datos de una plantilla dada
     *
     * @return identificador de la plantilla insertada
     */
    function duplicar($plantilla) {
        // Conversión de Datos
        unset($plantilla->id);
        $plantilla->descripcion = $plantilla->descripcion." - Copia";
        $plantilla->nombre = $plantilla->nombre." - Copia";
        // Crear duplicado
        return $this->insert($plantilla);
    }
    
    /**
     * Devuelve un array de datos en formato dropdown
     *
     * @return array de datos en formato dropdown
     */
    
    function get_dropdown($tipo_plantilla_id,$default_value="")
    {
        // Array de datos
        $datos_dropdown=$this->as_dropdown('nombre')->where( array('tipo_plantilla_id' => $tipo_plantilla_id) )->order_by('nombre')->get_all();
        // Selección inicial
        $seleccion[$default_value]="- Seleccione plantilla -";
        // Suma de ambos
        if($datos_dropdown)
        {
            return ($seleccion+$datos_dropdown);
        }
        else
        {
            return $seleccion;
        }
    }

}

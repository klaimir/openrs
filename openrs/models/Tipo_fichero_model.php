<?php defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'core/MY_Model.php';

class Tipo_fichero_model extends MY_Model
{

    public function __construct()
    {
        parent::__construct();        
        
        $this->table = 'tipos_ficheros';
        $this->view = 'v_tipos_ficheros';
        $this->primary_key = 'id';
        
        $this->has_many['inmuebles_ficheros'] = array('local_key'=>'id', 'foreign_key'=>'tipo_fichero_id', 'foreign_model'=>'Inmueble_fichero_model');
        $this->has_many['clientes_ficheros'] = array('local_key'=>'id', 'foreign_key'=>'tipo_fichero_id', 'foreign_model'=>'Cliente_fichero_model');
        $this->has_many['demandas_ficheros'] = array('local_key'=>'id', 'foreign_key'=>'tipo_fichero_id', 'foreign_model'=>'Demanda_fichero_model');
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
        $this->form_validation->set_rules('nombre', 'Nombre del tipo de fichero adjunto', 'required|is_unique_global[tipos_ficheros;' . $id . ';nombre;id]|max_length[100]|xss_clean');
        $this->form_validation->set_rules('descripcion', 'Descripción del tipo de fichero adjunto', 'xss_clean|max_length[255]');
        if(empty($id))
        {
            $this->form_validation->set_rules('ambito_id', 'Ámbito', 'required');
        }
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
        // Ámbitos
        $data['ambitos'] = $this->get_ambitos_dropdown();        
        
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
        
        if(is_null($datos))
        {
            $data['ambito_id']=$this->form_validation->set_value('ambito_id',is_object($datos) ? $datos->ambito_id : "");
        }

        return $data;
    }

    /**
     * Devuelve los datos formateado de la interfaz
     *
     * @return array con los datos formateado
     */
    
    public function get_formatted_datas($id=0)
    {
        $datas['nombre'] = $this->input->post('nombre');
        $datas['descripcion'] = $this->input->post('descripcion');
        if(empty($id))
        {
            $datas['ambito_id'] = $this->input->post('ambito_id');
        }
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
        $info=$this->with_clientes_ficheros()->with_inmuebles_ficheros()->with_demandas_ficheros()->get($id);
        if (count($info->clientes_ficheros) || count($info->inmuebles_ficheros) || count($info->demandas_ficheros))
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
        $formatted_datas=$this->get_formatted_datas($id);        
        // Parent update
        return $this->update($formatted_datas,$id);
    }
    
    /**
     * Lee todas los tipos de fichero con el ámbito formateado
     *
     * @return array de datos de tipo_fichero
     */
    
    function get_all_for_table()
    {
        // Lista de campos
        $fieldslist=$this->utilities->getFieldsTable($this->view); 
        $this->db->select($fieldslist);
        $this->db->from($this->view);
        return $this->db->get()->result();
    }
    
    /**
     * Devuelve un array de ambitos en formato dropdown
     *
     * @return array de ambitos en formato dropdown
     */
    function get_ambitos_dropdown($default = "")
    {
        $ofertas = array();
        $ofertas[$default] = '- Seleccione ámbito -';
        $ofertas[1] = 'Clientes';
        $ofertas[2] = 'Inmuebles';
        $ofertas[3] = 'Demandas';
        return $ofertas;
    }
    
    /**
     * Devuelve un array de datos en formato dropdown
     * 
     * @param	[ambito_id]            Ambito al que afecta el tipo_fichero
     *
     * @return array de datos en formato dropdown
     */
    
    function get_tipos_ficheros_dropdown($ambito_id,$default_value="")
    {
        // Array de datos
        $datos_dropdown=$this->as_dropdown('nombre')->get_all(array("ambito_id" => $ambito_id));
        // Selección inicial
        $seleccion[$default_value]="- Seleccione tipo -";
        // Suma de ambos
        return ($seleccion+$datos_dropdown);
    }

}

<?php defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'core/MY_Model.php';

class Medio_captacion_model extends MY_Model
{

    public function __construct()
    {
        parent::__construct();        
        
        $this->table = 'medios_captacion';
        $this->primary_key = 'id';
        
        $this->has_many['clientes'] = array('local_key'=>'id', 'foreign_key'=>'medio_captacion_id', 'foreign_model'=>'Cliente_model');
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
        $this->form_validation->set_rules('nombre', 'Nombre del medio de captación', 'required|is_unique_global[medios_captacion;' . $id . ';nombre;id]|max_length[150]|xss_clean');
        $this->form_validation->set_rules('descripcion', 'Descripción del medio de captación', 'xss_clean|max_length[255]');
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
        $info=$this->with_clientes()->get($id);
        if (count($info->clientes))
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
     * Devuelve un array de datos en formato dropdown
     * 
     *
     * @return array de datos en formato dropdown
     */
    
    function get_medios_captacion_dropdown($default_value="")
    {
        // Array de datos
        $datos_dropdown=$this->as_dropdown('nombre')->get_all();
        // Selección inicial
        $seleccion[$default_value]="- Seleccione medio -";
        // Suma de ambos
        return ($seleccion+$datos_dropdown);
    }
    
    /**
     * Devuelve el identificador de un medio_captacion que coincida con el nombre suministrado
     *
     * @param	[nombre_medio_captacion]     Nombre del medio_captacion
     * 
     * @return identificador del medio_captacion
     */
    
    function get_id_by_nombre($nombre_medio_captacion)
    {
        $this->db->select($this->table.'.id');
        $this->db->from($this->table);
        $this->db->where('nombre', $nombre_medio_captacion);
        $query = $this->db->get();
        $row = $query->row();
        if ($row) {
            return $row->id;
        } else {
            return NULL;
        }
    }

}

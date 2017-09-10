<?php defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'core/MY_Model.php';

class Zona_model extends MY_Model
{

    public $poblacion_id=NULL;
    
    public function __construct()
    {
        $this->table = 'poblaciones_zonas';
        $this->primary_key = 'id';
        $this->has_many['inmuebles'] = array('local_key'=>'id', 'foreign_key'=>'zona_id', 'foreign_model'=>'Inmueble_model');
        
        parent::__construct();
        
        // Carga del modelo
        $this->load->model('Poblacion_model');
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
        $this->form_validation->set_rules('nombre', 'Nombre de la zona', 'required|is_unique_global_foreign_key[poblaciones_zonas;'.$id.';nombre;id;poblacion_id;'.$this->poblacion_id.']|max_length[100]|xss_clean');
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
        $datas['poblacion_id'] = $this->poblacion_id;
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
        $datos_asociados=$this->with_inmuebles()->get($id);
        if (count($datos_asociados->inmuebles))
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
     * Devuelve un array de zonas en formato dropdown
     *
     * @return array de zonas en formato dropdown
     */
    
    function get_zonas_dropdown($poblacion_id,$default_value="",$show_default_value=TRUE, $text_value="- Seleccione población -")
    {
        // Selección inicial
        if($show_default_value)
        {
            $seleccion[$default_value]=$text_value;
        }
        else
        {
            $seleccion=array();
        }        
        // Array de zonas
        // Añadimos esto para que no falle cuando no exista poblacion
        if(empty($poblacion_id))
        {
            return $seleccion;
        }
        else
        {
            $zonas=$this->as_dropdown('nombre')->where('poblacion_id',$poblacion_id)->get_all(); 
            // Cuando no hay elementos devueltos hay que convertirlo a un array para poder realizar la suma
            if($zonas)
            {
                // Por tanto devolvemos el operador suma para que mantenga las claves numéricas
                return ($seleccion+$zonas);
            }
            else
            {
                return $seleccion;            
            }
        }
    }
    
    /**
     * Consulta las poblaciones de una poblacion
     *
     * @param [$poblacion_id]                  Indentificador de poblacion
     *
     * @return array de poblaciones
     */

    function get_zonas_poblacion($poblacion_id)
    {
        $this->db->from($this->table);
        $this->db->where('poblacion_id', $poblacion_id);
        $this->db->order_by('nombre');
        return $this->db->get()->result();
    }
    
    /**
     * Consulta las zonas de una población
     *
     * @param [$poblacion_id]                  Indentificador de población
     *
     * @return array de zonas
     */

    function get_zonas_poblacion_in_array($poblacion_id, $ids_zonas)
    {
        // Consulta
        $this->db->from($this->table);
        $this->db->where('poblacion_id', $poblacion_id);
        if(count($ids_zonas))
        {
            $this->db->where_in($this->primary_key, $ids_zonas);
        }
        else
        {
            $this->db->where($this->primary_key, 0);
        }
        $this->db->order_by('nombre');
        return $this->db->get()->result();
    }
    
    /**
     * Devuelve el identificador de un zona que coincida con el nombre suministrado
     *
     * @param	[nombre_zona]   Nombre del zona
     * @param	[poblacion_id]   Identificador de la poblacion
     * 
     * @return identificador del zona
     */
    
    function get_id_by_nombre($nombre_zona,$poblacion_id)
    {
        $this->db->select($this->table.'.id');
        $this->db->from($this->table);
        $this->db->where('nombre', $nombre_zona);
        $this->db->where('poblacion_id', $poblacion_id);
        $query = $this->db->get();
        $row = $query->row();
        if ($row) {
            return $row->id;
        } else {
            return NULL;
        }
    }
}

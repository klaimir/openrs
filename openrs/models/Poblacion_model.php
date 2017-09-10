<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'core/MY_Model.php';

class Poblacion_model extends MY_Model
{

    public $provincia_id = NULL;

    public function __construct()
    {
        $this->table = 'poblaciones';
        $this->primary_key = 'id';
        $this->has_one['provincia'] = array('local_key' => 'id', 'foreign_key' => 'provincia_id', 'foreign_model' => 'Provincia_model');
        $this->has_many['clientes'] = array('local_key' => 'id', 'foreign_key' => 'poblacion_id', 'foreign_model' => 'Cliente_model');
        $this->has_many['inmuebles'] = array('local_key' => 'id', 'foreign_key' => 'poblacion_id', 'foreign_model' => 'Inmueble_model');
        $this->has_many['zonas'] = array('local_key' => 'id', 'foreign_key' => 'poblacion_id', 'foreign_model' => 'Zona_model');

        parent::__construct();

        // Carga del modelo
        $this->load->model('Provincia_model');
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
        $this->form_validation->set_rules('poblacion', 'Nombre de la población', 'required|is_unique_global_foreign_key[poblaciones;' . $id . ';poblacion;id;provincia_id;' . $this->provincia_id . ']|max_length[100]|xss_clean');
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
        $data['poblacion'] = array(
            'name' => 'poblacion',
            'id' => 'poblacion',
            'type' => 'text',
            'value' => $this->form_validation->set_value('poblacion', is_object($datos) ? $datos->poblacion : ""),
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
        $datas['poblacion'] = $this->input->post('poblacion');
        $datas['provincia_id'] = $this->provincia_id;
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
        $datos_asociados = $this->with_inmuebles()->with_clientes()->get($id);
        if (count($datos_asociados->inmuebles) || count($datos_asociados->clientes))
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
        $formatted_datas = $this->get_formatted_datas();
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
        $formatted_datas = $this->get_formatted_datas();
        // Parent update
        return $this->update($formatted_datas, $id);
    }
    
    /**
     * Consulta las poblaciones de una provincia
     *
     * @param [$provincia_id]                  Indentificador de provincia
     *
     * @return array de poblaciones
     */

    function get_poblaciones_provincia_in_array($provincia_id, $ids_poblaciones)
    {
        // Consulta
        $this->db->from($this->table);
        $this->db->where('provincia_id', $provincia_id);
        if(count($ids_poblaciones))
        {
            $this->db->where_in($this->primary_key, $ids_poblaciones);
        }
        else
        {
            $this->db->where($this->primary_key, 0);
        }
        $this->db->order_by('poblacion');
        return $this->db->get()->result();
    }
    
    /**
     * Consulta las poblaciones de una provincia
     *
     * @param [$provincia_id]                  Indentificador de provincia
     *
     * @return array de poblaciones
     */

    function get_poblaciones_provincia($provincia_id)
    {
        $this->db->from($this->table);
        $this->db->where('provincia_id', $provincia_id);
        $this->db->order_by('poblacion');
        return $this->db->get()->result();
    }
    
    /**
     * Devuelve un array de poblaciones en formato dropdown
     *
     * @return array de poblaciones en formato dropdown
     */
    
    function get_poblaciones_dropdown($provincia_id,$default_value="", $text_value="- Seleccione población -")
    {
        // Array de poblaciones
        // Añadimos esto para que no falle cuando no exista provincia
        if(empty($provincia_id))
        {
            $poblaciones=array();
        }
        else
        {
            $poblaciones=$this->as_dropdown('poblacion')->where('provincia_id',$provincia_id)->get_all();
        }
        // Selección inicial
        $seleccion[$default_value]=$text_value;
        // Por tanto devolvemos el operador suma para que mantenga las claves numéricas
        return ($seleccion+$poblaciones);
    }
    
    /**
     * Devuelve el identificador de un poblacion que coincida con el nombre suministrado
     *
     * @param	[nombre_poblacion]   Nombre del poblacion
     * @param	[provincia_id]   Identificador de la provincia
     * 
     * @return identificador del poblacion
     */
    
    function get_id_by_nombre($nombre_poblacion,$provincia_id)
    {
        $this->db->select($this->table.'.id');
        $this->db->from($this->table);
        $this->db->where('poblacion', $nombre_poblacion);
        $this->db->where('provincia_id', $provincia_id);
        $query = $this->db->get();
        $row = $query->row();
        if ($row) {
            return $row->id;
        } else {
            return NULL;
        }
    }

}
